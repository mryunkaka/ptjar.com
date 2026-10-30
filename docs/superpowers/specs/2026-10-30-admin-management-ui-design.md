# Admin Management UI Design

## Intent

Improve the PT JAR admin experience across the dashboard and every management page. Make common assets, navigation, tables, and dialogs feel consistent, easier to use on smaller screens, and easier to maintain. Preserve existing routes, data operations, and permission behavior.

## Goals

- Keep the selected sidebar item visibly active and restore the sidebar's scroll position after navigation or refresh.
- Use the exact current route to select a menu item; do not mark every submenu in a menu group active.
- Centralize admin-only visual overrides and load only the shared assets needed by the admin shell.
- Load admin styles, scripts, icons, and other page assets from the project; do not request assets from CDNs or other external hosts. Use local assets or the system font stack to reduce network requests and page weight.
- Give management tables a consistent responsive wrapper, spacing, typography, and action-column treatment without changing their data contracts.
- Make horizontally scrollable table regions reachable by keyboard and give them accessible names, including tables rendered inside modals.
- Give management modals consistent sizing, spacing, labels, and responsive behavior while preserving their existing forms and AJAX flows.
- Define a consistent admin button size scale for compact, standard, large, and extra-large controls, with matching icon spacing and touch-friendly sizing where appropriate.
- Apply these improvements to all pages using the admin shell, including dashboard, user, category, permission, media, financial, reporting, and corporate-action management pages.

## Out of scope

- Changing authentication, role permissions, CRUD behavior, validation rules, database schemas, or public-facing pages.
- Replacing Bootstrap, NiceAdmin, DataTables, or other existing libraries.
- Redesigning page-specific workflows or changing the fields shown in forms.

## Constraints

- The admin is a CodeIgniter/PHP application using the NiceAdmin Bootstrap template and separately included page scripts.
- Admin page assets must be local. Do not add CDN URLs or third-party hosted font requests; prefer existing local files and system fonts over adding large font files.
- Many management screens render tables and modals in PHP views; the three `application/views/backend/management/*` list pages and the views under `application/views/backend/main/` share the same shell.
- Existing pages depend on jQuery and DataTables. Preserve their initialization and response formats.
- Avoid adding dependencies. Keep changes scoped to the admin shell, admin stylesheet/script, and affected admin views.

## Approaches

1. **Dashboard-only polish:** quickest and lowest scope, but leaves management pages with inconsistent assets, modal/table styling, and the same sidebar behavior.
2. **Shared admin system across management pages (selected):** fix active menu and scroll persistence in the shared shell; introduce shared admin styling and normalize repeated table/modal presentation across all admin views. This directly addresses the request and avoids separate one-off fixes.

## Design decisions

- Retain NiceAdmin and Bootstrap, with a dedicated admin override stylesheet loaded after the vendor/template CSS.
- Remove external font preconnect and Google Fonts requests from admin shell and auth templates; use a local font file only if one already exists and is needed, otherwise use a system sans-serif stack.
- Remove redundant vendor assets from the global shell only when no page in the admin scope uses them; otherwise keep them and avoid introducing duplicate loads.
- Resolve the active sidebar link from the current CodeIgniter route/URI, accounting for query-free route matching and index methods. Add semantic active state and `aria-current` to only the matching link.
- Save sidebar scroll position in session storage before internal admin navigation and on page hide, then restore it after page load or refresh. Keep the browser's normal page scrolling separate from the sidebar scroll container.
- Standardize table overflow, toolbar spacing, header/body density, and action alignment through shared CSS/classes, retaining each table's existing columns and plugin behavior.
- Keep table action controls on one aligned row, label action columns consistently, and give long cell content predictable wrapping inside the responsive table frame.
- Use one consistent card surface and spacing scale across admin screens; nested cards inside table cards become quiet inset panels rather than competing elevated surfaces.
- Scale desktop typography and shell dimensions fluidly with viewport width, use tablet and phone font scales that remain readable, and keep the layout usable at the browser's normal zoom level.
- Standardize modal header/body/footer spacing, responsive width, and form control spacing through shared CSS/classes, retaining each modal's IDs, form actions, and JavaScript hooks.
- Add shared button size utilities for XS/SM/MD/LG/XL presentation (using existing Bootstrap button classes where available and admin-only classes for missing sizes), and apply them consistently to table actions, page toolbars, and modal actions.
- Use the current PT JAR brand palette and existing icon/font system; avoid a new visual identity or external asset service.

## Implementation left to the builder

The builder will inspect all routes and views that include `main_sidebar`, identify duplicate/missing vendor references and any external asset requests in admin templates, and implement the smallest common layer that covers the whole admin scope. They will ensure template changes do not break page-specific scripts, keep DataTables' existing rendering behavior, use only local assets/system fonts, and manually inspect representative dashboard, list, and form/modal pages at desktop and narrow widths. No automated tests are required by this design.
