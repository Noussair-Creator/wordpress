<?php
function pm_register_plugin_pages() {
    add_menu_page(
        'Plateforme Mastère', 'Mastère', 'read',
        'DashboardCorrdinateur', 'pm_render_page_callback',
        'dashicons-welcome-learn-more', 30
    );

    $dir = plugin_dir_path(__FILE__) . 'pages';
    foreach (glob($dir . '/*.php') as $file) {
        $slug = basename($file, '.php');

        if ($slug === 'DashboardCorrdinateur') continue;

        add_submenu_page(
            'DashboardCorrdinateur',
            ucwords(str_replace('-', ' ', $slug)),
            ucwords(str_replace('-', ' ', $slug)),
            'read',
            $slug,
            'pm_render_page_callback'
        );
    }
}
add_action('admin_menu', 'pm_register_plugin_pages');

function pm_render_page_callback() {
    $slug = isset($_GET['page']) ? sanitize_file_name($_GET['page']) : 'DashboardCorrdinateur';
    $filepath = plugin_dir_path(__FILE__) . 'pages/' . $slug . '.php';

    if (file_exists($filepath)) {
        include $filepath;
    } else {
        echo "<div class='notice notice-error'><p>Page introuvable : $slug</p></div>";
    }
}
