<?php
/*
 * Plugin Name:       Data Sheets
 * Plugin URI:        https://github.com/H-Mahmud/datasheets/
 * Description:       Datasheets Core Plugin enables fast data access with custom storage, adds custom fields in the post editor, and displays content seamlessly on the frontend.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Mahmudul Hasan
 * Author URI:        https://imahmud.com/
 * Text Domain:       datasheets
 */

defined('ABSPATH') || exit();

// Includes
include_once(plugin_dir_path(__FILE__) . 'inc/data-table.php');
register_activation_hook(__FILE__, 'datasheets_data_table');
include_once(plugin_dir_path(__FILE__) . 'inc/data-model.php');

include_once(plugin_dir_path(__FILE__) . 'inc/data-cpt.php');
include_once(plugin_dir_path(__FILE__) . 'inc/data-fields.php');


function ds_error_editor_admin($message = '', $post_id)
{
    add_settings_error(
        'data_meta_field_errors',
        'data_meta_field_error',
        $message,
        'error'
    );

    set_transient('data_meta_errors', get_settings_errors('data_meta_field_errors'), 30);

    wp_safe_redirect(add_query_arg('failed_message', 'data_meta_error', get_edit_post_link($post_id, 'url')));
    exit;
}
