<?php
$normalizeAdminPath = function ($path) {
    $path = strtolower(trim((string) $path, '/'));
    $path = preg_replace('#^index\.php/?#', '', $path);
    if ($path === 'index') {
        return '';
    }
    return preg_replace('#/index$#', '', $path);
};
$currentAdminUri = $normalizeAdminPath($this->uri->uri_string());
$isDashboardRoute = in_array($currentAdminUri, array('dashboard', 'dashboard/index'), true);
?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar" data-admin-sidebar>
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item<?= $isDashboardRoute ? ' active' : ''; ?>">
            <a class="nav-link<?= $isDashboardRoute ? ' active' : ''; ?>" href="<?= html_escape(base_url('dashboard')); ?>" data-admin-link<?= $isDashboardRoute ? ' aria-current="page"' : ''; ?>>
                <i class="bi bi-bar-chart" aria-hidden="true"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <?php
        $role_id = $this->session->userdata('role');
        $queryMenu = "SELECT `a`.`vc_id_menu`, `b`.`vc_menu_name`
            FROM tr_role_menu a
            JOIN mst_menu b ON `a`.`vc_id_menu` = `b`.`nu_id`
            WHERE `a`.`vc_id_role` = ?
            ORDER BY `b`.`nu_id` ASC";
        $menu = $this->db->query($queryMenu, array((int) $role_id))->result_array();
        ?>

        <?php foreach ($menu as $m) : ?>
            <?php
            $menuId = $m['vc_id_menu'];
            $querySubMenu = "SELECT *
                FROM `mst_sub_menu`
                JOIN `mst_menu` ON `mst_sub_menu`.`vc_id_menu` = `mst_menu`.`nu_id`
                WHERE `mst_sub_menu`.`vc_id_menu` = ?
                AND `mst_sub_menu`.`is_active` = 1";
            $subMenu = $this->db->query($querySubMenu, array((int) $menuId))->result_array();
            $activeSubMenuPath = '';

            foreach ($subMenu as $candidate) {
                $candidatePath = $normalizeAdminPath(parse_url((string) $candidate['vc_url'], PHP_URL_PATH));
                if ($candidatePath === '') {
                    continue;
                }

                $matchesRoute = $currentAdminUri === $candidatePath
                    || strpos($currentAdminUri, $candidatePath . '/') === 0;
                if ($matchesRoute && strlen($candidatePath) > strlen($activeSubMenuPath)) {
                    $activeSubMenuPath = $candidatePath;
                }
            }
            ?>

            <li class="nav-heading"><?= html_escape($m['vc_menu_name']); ?></li>

            <?php foreach ($subMenu as $sm) : ?>
                <?php
                $submenuPath = $normalizeAdminPath(parse_url((string) $sm['vc_url'], PHP_URL_PATH));
                $isActive = $activeSubMenuPath !== '' && $submenuPath === $activeSubMenuPath;
                ?>
                <li class="nav-item<?= $isActive ? ' active' : ''; ?>">
                    <a class="nav-link pb-0<?= $isActive ? ' active' : ''; ?>"
                        href="<?= html_escape(base_url($sm['vc_url'])); ?>"
                        data-admin-link<?= $isActive ? ' aria-current="page"' : ''; ?>>
                        <i class="<?= html_escape($sm['vc_icon']); ?>" aria-hidden="true"></i>
                        <span><?= html_escape($sm['vc_sub_menu_name']); ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </ul>
</aside><!-- End Sidebar -->

<main id="main" class="main admin-content">
    <div class="pagetitle">
        <h1><?= html_escape($title); ?></h1>
    </div>
