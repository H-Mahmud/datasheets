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

defined('DATASHEETS_DIR_PATH') || define('DATASHEETS_DIR_PATH', plugin_dir_path(__FILE__));
defined('DATASHEETS_DIR_URL') || define('DATASHEETS_DIR_URL', plugin_dir_url(__FILE__));

// Includes
include_once(plugin_dir_path(__FILE__) . 'inc/data-table.php');
register_activation_hook(__FILE__, 'datasheets_data_table');
include_once(plugin_dir_path(__FILE__) . 'inc/helper-func.php');
include_once(plugin_dir_path(__FILE__) . 'inc/data-model.php');
include_once(plugin_dir_path(__FILE__) . 'inc/data-query.php');
include_once(plugin_dir_path(__FILE__) . 'inc/data-action.php');

include_once(plugin_dir_path(__FILE__) . 'inc/data-cpt.php');
include_once(plugin_dir_path(__FILE__) . 'inc/data-fields.php');

include(plugin_dir_path(__FILE__) . 'inc/import/import-admin.php');


/**
 * Load search template for data search
 * 
 * @param string $template
 * @return string
 */
function ds_load_data_search_template($template)
{
    if (is_search() && 'data' === get_query_var('post_type')) {
        $new_template = plugin_dir_path(__FILE__) . 'templates/search-data.php';
        if (file_exists($new_template)) {
            return $new_template;
        }
    }
    return $template;
}
add_filter('template_include', 'ds_load_data_search_template');
