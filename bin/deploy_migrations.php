<?php
/**
 * Apply numbered SQL migrations from a deployment archive.
 *
 * Usage: php bin/deploy_migrations.php --directory=/path/to/sql/migrations
 */

if (PHP_SAPI !== 'cli') {
    fwrite(STDERR, "This migration runner can only be run from the command line.\n");
    exit(1);
}
if (!extension_loaded('mysqli')) {
    fwrite(STDERR, "The PHP CLI must have the mysqli extension enabled.\n");
    exit(1);
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function migration_fail($message)
{
    throw new RuntimeException($message);
}

function open_deployment_database($projectRoot)
{
    $basePath = rtrim($projectRoot, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR;
    $applicationPath = rtrim($projectRoot, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR;

    if (!is_file($applicationPath . 'config' . DIRECTORY_SEPARATOR . 'database.php')) {
        migration_fail('CodeIgniter database configuration was not found in ' . $projectRoot);
    }

    if (!defined('BASEPATH')) {
        define('BASEPATH', $basePath);
    }
    if (!defined('APPPATH')) {
        define('APPPATH', $applicationPath);
    }
    if (!defined('ENVIRONMENT')) {
        define('ENVIRONMENT', 'production');
    }

    $db = array();
    $active_group = 'default';
    $query_builder = TRUE;
    require $applicationPath . 'config' . DIRECTORY_SEPARATOR . 'database.php';

    if (!isset($db[$active_group]) || !is_array($db[$active_group])) {
        migration_fail('Database group "' . $active_group . '" is not configured.');
    }

    $config = $db[$active_group];
    foreach (array('hostname', 'username', 'password', 'database') as $key) {
        if (!isset($config[$key]) || ($key !== 'password' && $config[$key] === '')) {
            migration_fail('Database setting "' . $key . '" is empty; configure the PTJARCOM_DB_* environment variables.');
        }
    }

    $port = isset($config['port']) ? (int) $config['port'] : 3306;
    $connection = new mysqli($config['hostname'], $config['username'], $config['password'], $config['database'], $port);
    $connection->set_charset(isset($config['char_set']) ? $config['char_set'] : 'utf8mb4');

    return $connection;
}

function list_sql_migrations($directory)
{
    if (!is_dir($directory)) {
        migration_fail('Migration directory was not found: ' . $directory);
    }

    $paths = glob(rtrim($directory, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . '*.sql');
    if ($paths === FALSE) {
        migration_fail('Could not read migration directory: ' . $directory);
    }

    $migrations = array();
    foreach ($paths as $path) {
        $filename = basename($path);
        if (!preg_match('/^(\d{3})_(\d{4}-\d{2}-\d{2})_([a-z0-9_]+)\.sql$/', $filename, $matches)) {
            migration_fail('Invalid migration filename: ' . $filename . '. Expected NNN_YYYY-MM-DD_description.sql.');
        }
        if (strlen($filename) > 191) {
            migration_fail('Migration filename is longer than 191 characters: ' . $filename);
        }
        $number = (int) $matches[1];
        if (!checkdate((int) substr($matches[2], 5, 2), (int) substr($matches[2], 8, 2), (int) substr($matches[2], 0, 4))) {
            migration_fail('Invalid date in migration filename: ' . $filename);
        }
        if (isset($migrations[$number])) {
            migration_fail('Duplicate migration number ' . $matches[1] . ' in ' . $migrations[$number] . ' and ' . $filename . '.');
        }
        $migrations[$number] = $filename;
    }

    ksort($migrations, SORT_NUMERIC);
    $expected = 1;
    foreach ($migrations as $number => $filename) {
        if ((int) $number !== $expected) {
            migration_fail('Migration sequence gap: expected ' . sprintf('%03d', $expected) . ' before ' . $filename . '.');
        }
        $expected++;
    }

    return $migrations;
}

function get_migration_record($connection, $migrationId)
{
    $statement = $connection->prepare('SELECT checksum, status FROM ptjarcom_deploy_migrations WHERE migration_id = ?');
    $statement->bind_param('s', $migrationId);
    $statement->execute();
    $statement->bind_result($checksum, $status);
    $record = $statement->fetch() ? array('checksum' => $checksum, 'status' => $status) : NULL;
    $statement->close();

    return $record;
}

function set_migration_status($connection, $migrationId, $checksum, $status, $errorMessage = NULL)
{
    $statement = $connection->prepare('UPDATE ptjarcom_deploy_migrations SET checksum = ?, status = ?, error_message = ?, finished_at = IF(? = \'success\', CURRENT_TIMESTAMP, NULL) WHERE migration_id = ?');
    $statement->bind_param('sssss', $checksum, $status, $errorMessage, $status, $migrationId);
    $statement->execute();
    $statement->close();
}

function insert_running_migration($connection, $migrationId, $checksum)
{
    $status = 'running';
    $statement = $connection->prepare('INSERT INTO ptjarcom_deploy_migrations (migration_id, checksum, status, started_at) VALUES (?, ?, ?, CURRENT_TIMESTAMP)');
    $statement->bind_param('sss', $migrationId, $checksum, $status);
    $statement->execute();
    $statement->close();
}

function apply_migration_sql($connection, $sql, $migrationId)
{
    if (trim($sql) === '') {
        migration_fail('Migration file is empty: ' . $migrationId);
    }

    $connection->multi_query($sql);
    do {
        $result = $connection->store_result();
        if ($result instanceof mysqli_result) {
            $result->free();
        }
        if (!$connection->more_results()) {
            break;
        }
        $connection->next_result();
    } while (TRUE);

    // Migration SQL may turn autocommit off or leave an explicit transaction open.
    // Commit the completed migration, then restore autocommit before ledger writes.
    $connection->commit();
    $connection->autocommit(TRUE);
}

$options = getopt('', array('directory:'));
$migrationDirectory = isset($options['directory']) ? $options['directory'] : NULL;
$projectRoot = getenv('PTJARCOM_DEPLOY_ROOT');
if (!$migrationDirectory || !$projectRoot) {
    fwrite(STDERR, "Usage: PTJARCOM_DEPLOY_ROOT=/path/to/site php bin/deploy_migrations.php --directory=/path/to/sql/migrations\n");
    exit(2);
}

try {
    $migrations = list_sql_migrations($migrationDirectory);
    $connection = open_deployment_database($projectRoot);
    $connection->query("CREATE TABLE IF NOT EXISTS ptjarcom_deploy_migrations (
        migration_id VARCHAR(191) NOT NULL PRIMARY KEY,
        checksum CHAR(64) NOT NULL,
        status VARCHAR(16) NOT NULL,
        started_at DATETIME NULL,
        finished_at DATETIME NULL,
        error_message TEXT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    $existing = $connection->query('SELECT migration_id, checksum, status FROM ptjarcom_deploy_migrations');
    while ($record = $existing->fetch_assoc()) {
        if (!isset($migrations[(int) substr($record['migration_id'], 0, 3)])
            || $migrations[(int) substr($record['migration_id'], 0, 3)] !== $record['migration_id']) {
            migration_fail('Recorded migration file is missing from the deployment: ' . $record['migration_id']);
        }
        if ($record['status'] === 'success') {
            $path = rtrim($migrationDirectory, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $record['migration_id'];
            $currentChecksum = hash_file('sha256', $path);
            if (!hash_equals($record['checksum'], $currentChecksum)) {
                migration_fail('Applied migration was edited: ' . $record['migration_id'] . '. Add a new migration instead.');
            }
        } elseif ($record['status'] === 'running' || $record['status'] === 'failed') {
            migration_fail('Migration ' . $record['migration_id'] . ' is marked ' . $record['status'] . '; inspect and repair it before deploying again.');
        }
    }
    $existing->free();

    foreach ($migrations as $filename) {
        $path = rtrim($migrationDirectory, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $filename;
        $checksum = hash_file('sha256', $path);
        $record = get_migration_record($connection, $filename);
        if ($record !== NULL) {
            if ($record['status'] !== 'success' || !hash_equals($record['checksum'], $checksum)) {
                migration_fail('Migration record is not eligible to skip: ' . $filename);
            }
            continue;
        }

        insert_running_migration($connection, $filename, $checksum);
        echo 'Menjalankan ' . $filename . PHP_EOL;
        try {
            $sql = file_get_contents($path);
            if ($sql === FALSE) {
                migration_fail('Cannot read migration file: ' . $filename);
            }
            apply_migration_sql($connection, $sql, $filename);
            set_migration_status($connection, $filename, $checksum, 'success');
        } catch (Throwable $migrationError) {
            $errorMessage = substr($migrationError->getMessage(), 0, 5000);
            try {
                $connection->rollback();
            } catch (Throwable $rollbackError) {
                // DDL can implicitly commit, and a failed multi_query may invalidate this connection.
            }
            try {
                $connection->autocommit(TRUE);
            } catch (Throwable $autocommitError) {
                // If the connection is unusable, the durable running marker will block later deploys.
            }
            try {
                set_migration_status($connection, $filename, $checksum, 'failed', $errorMessage);
            } catch (Throwable $statusError) {
                // Leave the running marker in place if the database connection is no longer usable.
            }
            throw new RuntimeException('Migration ' . $filename . ' failed: ' . $errorMessage, 0, $migrationError);
        }
    }

    echo 'Migrasi SQL selesai.' . PHP_EOL;
    $connection->close();
} catch (Throwable $error) {
    if (isset($connection) && $connection instanceof mysqli) {
        $connection->close();
    }
    fwrite(STDERR, 'ERROR: ' . $error->getMessage() . PHP_EOL);
    exit(1);
}
