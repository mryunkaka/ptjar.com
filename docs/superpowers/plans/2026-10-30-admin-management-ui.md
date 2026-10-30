# Admin Management UI Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [x]`) syntax for tracking.

**Goal:** Improve the admin shell and every management screen with reliable active sidebar state, local-only assets, responsive tables/modals, and a shared button size scale.

**Architecture:** Keep CodeIgniter, NiceAdmin, Bootstrap, jQuery, and DataTables. Put shared admin overrides and sidebar state handling in dedicated assets included by the shared main template, then update backend management views to use consistent component classes while preserving their existing routes, data, and JavaScript hooks.

**Tech Stack:** PHP (CodeIgniter views), Bootstrap 5, NiceAdmin CSS/JS, vanilla JavaScript, existing jQuery/DataTables.

**Spec:** `docs/superpowers/specs/2026-10-30-admin-management-ui-design.md`

## Global Constraints

- Preserve existing routes, data operations, and permission behavior.
- Do not change authentication, role permissions, CRUD behavior, validation rules, database schemas, or public-facing pages.
- Do not replace Bootstrap, NiceAdmin, DataTables, or other existing libraries.
- Avoid adding dependencies. Keep changes scoped to the admin shell, admin stylesheet/script, and affected admin views.
- Do not load admin assets from CDNs or external hosts. Use project-local assets or system fonts; do not add large font files when a system font stack is sufficient.
- Preserve existing table columns, modal IDs, form actions, AJAX flows, and plugin behavior.

## Review Focus

- A route under a menu group with several links: only the link matching the current URI is active.
- Internal navigation and page refresh after scrolling the sidebar: scroll position is restored without affecting document scroll.
- Nested management routes such as edit, preview, or form pages: the correct parent menu remains selected.
- Tables with many columns on narrow screens: content remains usable through horizontal overflow and actions remain reachable.
- Modal forms and action buttons at narrow widths: controls remain visible, correctly spaced, and usable at their selected size.

---

### Task 1: Shared shell navigation and asset loading

**Files:**
- Modify: `application/views/backend/template/main/main_header.php`
- Modify: `application/views/backend/template/main/main_sidebar.php`
- Modify: `application/views/backend/template/main/main_footer.php`
- Modify: `application/views/backend/template/auth/auth_header.php`
- Modify: `application/views/backend/template/auth/auth_footer.php`
- Modify: `assets/NiceAdmin/assets/js/main.js`
- Create: `assets/Backend/css/admin-ui.css`
- Create: `assets/Backend/js/admin-ui.js`

**Interfaces:**
- The sidebar uses `$this->uri->uri_string()` (normalized to lowercase, without a trailing slash) to compare the current path against each escaped `vc_url`.
- `admin-ui.js` reads/writes the sidebar's `scrollTop` under a namespaced `sessionStorage` key before internal navigation and on `pagehide`, then restores it on page load.
- `admin-ui.css` is loaded after NiceAdmin's `style.css`; `admin-ui.js` loads after the shared Bootstrap bundle and NiceAdmin `main.js`.

- [x] Replace the submenu-parent active check with a normalized current-URI comparison and set `.active` plus `aria-current="page"` on the matching anchor only. Keep the Dashboard item active only at the dashboard route.
- [x] Add stable `data-admin-sidebar` and `data-admin-link` attributes to the shell elements used by shared JS.
- [x] Create `assets/Backend/js/admin-ui.js` to save sidebar scroll before same-origin navigation initiated by admin sidebar anchors and on `pagehide`, then restore it after DOM readiness. Guard storage access and missing elements.
- [x] Create `assets/Backend/css/admin-ui.css` as a scoped layer for admin shared components; do not edit the vendor NiceAdmin stylesheet.
- [x] Load the stylesheet and script in the shared template with `base_url()` paths. Remove only redundant shell vendor assets after confirming no shared-shell feature depends on them; page-specific plugin assets remain intact.
- [x] Remove Google Fonts/preconnect requests from `main_header.php` and `application/views/backend/template/auth/auth_header.php`; use a system sans-serif stack in admin templates unless an already-local font asset is required.
- [x] Search backend admin templates for remaining external asset URLs and replace asset dependencies with local project files or system fonts. Leave non-asset licensing/template comments alone.
- [ ] Review the rendered shell markup and links for the dashboard and a nested management route.

### Task 2: Shared admin tables, modals, and button scale

**Files:**
- Modify: `assets/Backend/css/admin-ui.css`

**Interfaces:**
- Button classes: `.btn-admin-xs`, `.btn-admin-sm`, `.btn-admin-md`, `.btn-admin-lg`, `.btn-admin-xl`; retain Bootstrap `.btn` color classes and standard focus/disabled behavior.
- Shared wrappers/classes: `.admin-table-card`, `.admin-table-toolbar`, `.admin-table-wrap`, and `.admin-modal`, with Bootstrap's modal header/body/footer elements styled inside `.admin-modal`.

- [x] Add common card/table toolbar and responsive overflow styles, including readable table header/body spacing and aligned action cells.
- [x] Add the five button size utilities with clear padding, font size, line height, and minimum target sizing; keep `.btn-admin-md` the default standard size and do not override Bootstrap color variants.
- [x] Add shared modal sizing and header/body/footer spacing, form-control spacing, narrow-screen width rules, and visible focus states.
- [x] Keep all selectors under admin shell/component classes so public pages remain unaffected.
- [x] Review CSS against existing Bootstrap/NiceAdmin styles to avoid selector collisions and ensure all five size classes have distinct intended dimensions.
- [x] Normalize table action columns to a consistent label, width, spacing, and single-row alignment.
- [x] Unify card spacing and soften nested card surfaces across management screens.
- [x] Make every horizontally scrollable table region keyboard-focusable and accessibly named, including dynamically rendered modal tables.
- [x] Add fluid laptop/desktop typography and shell sizing plus readable tablet/mobile base sizes without requiring browser zoom changes.

### Task 3: Apply shared presentation across management views

**Files:**
- Modify: `application/views/backend/main/dashboard/dashboard.php`
- Modify: `application/views/backend/management/management_user/user_list.php`
- Modify: `application/views/backend/management/management_category/category_list.php`
- Modify: `application/views/backend/management/management_permission/permission_list.php`
- Modify list/form/edit/preview views under `application/views/backend/main/` that are rendered with `main_sidebar` by management controllers, including berita, siaran pers, informasi produksi/keuangan, laporan tahunan/bulanan/keuangan, RUPS, tindakan korporasi, and rilis perusahaan.

**Interfaces:**
- Views consume the CSS classes defined in Task 2.
- Existing IDs, input names, URLs, data attributes, and JavaScript selectors remain unchanged.

- [x] Inventory every view paired with `main_sidebar` from management controllers and tag each existing table/card/modal/button region with the shared classes where appropriate.
- [x] Move page-level DataTables CSS references into consistent view placement without duplicating shared vendor loads; keep their current JS plugin initialization and table IDs.
- [x] Apply `.btn-admin-*` classes to page toolbar, row actions, and modal actions consistently: compact row actions use XS/SM; normal toolbar/modal actions use MD; use LG/XL only for prominent page actions where the available width supports them.
- [x] Standardize modal section classes while preserving form nesting, modal IDs, labels, validation hooks, and AJAX hooks.
- [ ] Review all changed views for malformed nesting and confirm no visible workflow or submitted field was removed.
- [ ] Manually inspect representative dashboard, table list, and modal/form pages at desktop and narrow widths; confirm route-specific sidebar active state and scroll restoration.

### Task 4: Asset and scope review

**Files:**
- Review all files changed in Tasks 1–3.

- [x] Check admin template references to verify asset paths resolve from nested routes and that no page loads the same vendor library twice through the shared shell.
- [x] Confirm admin runtime templates make no requests to external CDNs/font hosts and all runtime CSS/JS/image/font URLs point to project-local assets.
- [x] Check that changed files are limited to the admin shell/assets and its backend views.
- [x] Summarize the visual and navigation changes, plus any screens that could not be inspected manually.
