#!/usr/bin/env bash
set -o pipefail

REPO_DIR="$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")" && pwd)"
DEPLOY_PATH="${PTJARCOM_DEPLOY_PATH:-$REPO_DIR}"
BRANCH="main"
REMOTE="origin"
HOME_DIR="${HOME:-$(cd -- "$REPO_DIR/.." && pwd)}"
LOG_FILE="${PTJARCOM_DEPLOY_LOG:-$HOME_DIR/ptjarcom-deploy.log}"
LOCK_FILE="${PTJARCOM_DEPLOY_LOCK:-$HOME_DIR/.ptjarcom-deploy.lock}"
DEPLOYED_SHA_FILE="${PTJARCOM_DEPLOYED_SHA_FILE:-$HOME_DIR/.ptjarcom-deployed-sha}"
FAILURE_STATE_FILE="${PTJARCOM_DEPLOY_FAILURE_STATE:-$HOME_DIR/.ptjarcom-deploy-last-failure}"
GIT_BIN="${PTJARCOM_GIT_BIN:-$(command -v git || true)}"
PHP_BIN="${PTJARCOM_PHP_BIN:-$(command -v php || true)}"

log() {
    printf '[%s] %s\n' "$(date '+%Y-%m-%d %H:%M:%S %Z')" "$*" >> "$LOG_FILE"
}

fail() {
    local message="$*"
    local failure_key
    local previous_key=""

    if command -v sha256sum >/dev/null 2>&1; then
        failure_key=$(printf '%s' "$message" | sha256sum | awk '{print $1}')
    else
        failure_key=$(printf '%s' "$message" | cksum | awk '{print $1 ":" $2}')
    fi

    if [[ -f "$FAILURE_STATE_FILE" ]]; then
        IFS= read -r previous_key < "$FAILURE_STATE_FILE" || true
    fi
    if [[ "$failure_key" != "$previous_key" ]]; then
        log "ERROR: $message"
        printf '%s\n' "$failure_key" > "$FAILURE_STATE_FILE"
    fi
    exit 1
}

mkdir -p "$(dirname -- "$LOG_FILE")" "$(dirname -- "$LOCK_FILE")" "$(dirname -- "$DEPLOYED_SHA_FILE")" "$(dirname -- "$FAILURE_STATE_FILE")" || exit 1
if [[ -z "$GIT_BIN" || ! -x "$GIT_BIN" ]]; then
    fail "git executable not found; set PTJARCOM_GIT_BIN if cPanel uses a custom path"
fi
if [[ -z "$PHP_BIN" || ! -x "$PHP_BIN" ]]; then
    fail "PHP CLI executable not found; set PTJARCOM_PHP_BIN if cPanel uses a custom path"
fi
if ! command -v flock >/dev/null 2>&1; then
    fail "flock is required to prevent overlapping cron deployments"
fi

exec 9>"$LOCK_FILE" || fail "cannot open lock file $LOCK_FILE"
if ! flock -n 9; then
    exit 0
fi

if [[ ! -d "$REPO_DIR/.git" ]]; then
    fail "Git checkout not found at $REPO_DIR"
fi
if [[ ! -d "$DEPLOY_PATH" ]]; then
    fail "deployment target does not exist: $DEPLOY_PATH"
fi
if [[ "$DEPLOY_PATH" != /* || "$DEPLOY_PATH" == "/" ]]; then
    fail "PTJARCOM_DEPLOY_PATH must be an absolute path other than /"
fi
if [[ ! -f "$DEPLOY_PATH/application/config/database.php" ]]; then
    fail "CodeIgniter database configuration is missing from deployment target $DEPLOY_PATH"
fi

CURRENT_SHA=$("$GIT_BIN" -C "$REPO_DIR" rev-parse HEAD 2>&1) || fail "cannot read current commit: $CURRENT_SHA"
FETCH_OUTPUT=$(GIT_TERMINAL_PROMPT=0 "$GIT_BIN" -C "$REPO_DIR" fetch --prune "$REMOTE" "$BRANCH" 2>&1) || fail "git fetch failed: $FETCH_OUTPUT"
REMOTE_SHA=$("$GIT_BIN" -C "$REPO_DIR" rev-parse "FETCH_HEAD" 2>&1) || fail "cannot read fetched commit: $REMOTE_SHA"
DEPLOYED_SHA=""
DEPLOYED_TARGET=""
if [[ -f "$DEPLOYED_SHA_FILE" ]]; then
    {
        IFS= read -r DEPLOYED_SHA || true
        IFS= read -r DEPLOYED_TARGET || true
    } < "$DEPLOYED_SHA_FILE"
fi

if [[ "$DEPLOYED_SHA" == "$REMOTE_SHA" && "$DEPLOYED_TARGET" == "$DEPLOY_PATH" ]]; then
    if [[ "$CURRENT_SHA" != "$REMOTE_SHA" ]]; then
        RESET_OUTPUT=$("$GIT_BIN" -C "$REPO_DIR" reset --hard "$REMOTE_SHA" 2>&1) || fail "git reset failed while syncing checkout: $RESET_OUTPUT"
        CHECKOUT_OUTPUT=$("$GIT_BIN" -C "$REPO_DIR" checkout -B "$BRANCH" "$REMOTE_SHA" 2>&1) || fail "git checkout failed while syncing checkout: $CHECKOUT_OUTPUT"
        log "Application is already deployed at $REMOTE_SHA; cPanel checkout synchronized. $RESET_OUTPUT $CHECKOUT_OUTPUT"
        rm -f -- "$FAILURE_STATE_FILE"
        exit 0
    fi
    rm -f -- "$FAILURE_STATE_FILE"
    exit 0
fi

log "Preparing deployment $CURRENT_SHA -> $REMOTE_SHA."
STAGE_DIR=$(mktemp -d "$HOME_DIR/.ptjarcom-deploy.XXXXXX") || fail "cannot create migration staging directory"
cleanup() {
    case "$STAGE_DIR" in
        "$HOME_DIR"/.ptjarcom-deploy.*) rm -rf -- "$STAGE_DIR" ;;
        *) log "WARNING: skipped cleanup for unexpected staging path $STAGE_DIR" ;;
    esac
}
trap cleanup EXIT

if ! "$GIT_BIN" -C "$REPO_DIR" archive "$REMOTE_SHA" sql/migrations bin/deploy_migrations.php | tar -xf - -C "$STAGE_DIR"; then
    fail "cannot stage SQL migrations and migration runner from $REMOTE_SHA"
fi
if [[ ! -f "$STAGE_DIR/bin/deploy_migrations.php" || ! -d "$STAGE_DIR/sql/migrations" ]]; then
    fail "migration runner or sql/migrations directory is missing from $REMOTE_SHA"
fi

MIGRATION_OUTPUT=$(PTJARCOM_DEPLOY_ROOT="$DEPLOY_PATH" "$PHP_BIN" "$STAGE_DIR/bin/deploy_migrations.php" "--directory=$STAGE_DIR/sql/migrations" 2>&1)
MIGRATION_STATUS=$?
if [[ $MIGRATION_STATUS -ne 0 ]]; then
    while IFS= read -r line; do
        log "$line"
    done <<< "$MIGRATION_OUTPUT"
    fail "SQL migration failed; application code remains at $CURRENT_SHA"
fi
if [[ -n "$MIGRATION_OUTPUT" ]]; then
    while IFS= read -r line; do
        log "$line"
    done <<< "$MIGRATION_OUTPUT"
fi

mkdir -p "$STAGE_DIR/application-files" || fail "cannot create application staging directory"
if ! "$GIT_BIN" -C "$REPO_DIR" archive "$REMOTE_SHA" | tar --exclude='.env' --exclude='docs' --exclude='sql' --exclude='bin' --exclude='tests' --exclude='deploy.sh' -xf - -C "$STAGE_DIR/application-files"; then
    fail "cannot stage application files from $REMOTE_SHA"
fi
if ! tar -cf - -C "$STAGE_DIR/application-files" . | tar -xf - -C "$DEPLOY_PATH"; then
    fail "cannot extract application files to $DEPLOY_PATH after migrations"
fi

RESET_OUTPUT=$("$GIT_BIN" -C "$REPO_DIR" reset --hard "$REMOTE_SHA" 2>&1) || fail "git reset failed after application files were copied: $RESET_OUTPUT"
CHECKOUT_OUTPUT=$("$GIT_BIN" -C "$REPO_DIR" checkout -B "$BRANCH" "$REMOTE_SHA" 2>&1) || fail "git checkout failed after application files were copied: $CHECKOUT_OUTPUT"
MARKER_TEMP="${DEPLOYED_SHA_FILE}.tmp.$$"
printf '%s\n%s\n' "$REMOTE_SHA" "$DEPLOY_PATH" > "$MARKER_TEMP" || fail "cannot write deployment marker $MARKER_TEMP"
mv -f -- "$MARKER_TEMP" "$DEPLOYED_SHA_FILE" || fail "cannot update deployment marker $DEPLOYED_SHA_FILE"
log "Deployment complete: $REMOTE_SHA copied to $DEPLOY_PATH. $RESET_OUTPUT $CHECKOUT_OUTPUT"
rm -f -- "$FAILURE_STATE_FILE"
