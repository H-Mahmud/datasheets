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

}
