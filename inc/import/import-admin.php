<?php
defined('ABSPATH') || exit();

add_action('admin_menu', 'ds_import_menu');

function ds_import_menu()
{
    add_submenu_page(
        'edit.php?post_type=data',
        __('Import Data', 'datasheets'),
        __('Import Data', ),
        'manage_options',
        'import-data',
        'ds_import_admin_cb',
        11
    );
}

function ds_import_admin_cb()
{
    include_once DATASHEETS_DIR_PATH . 'templates/admin/import-data-page.php';
}

add_action('admin_enqueue_scripts', 'datasheets_admin_enqueues');
function datasheets_admin_enqueues($page_slug)
{
    if ($page_slug !== 'data_page_import-data')
        return;

    wp_enqueue_style('datasheets.script', DATASHEETS_DIR_URL . 'assets/datasheets.admin.css', [], '1.0.0', 'all');
    wp_enqueue_media();
    wp_enqueue_script('datasheets.style', DATASHEETS_DIR_URL . 'assets/datasheets.admin.js', ['jquery'], '1.0.0', ['in_footer' => true]);
}
