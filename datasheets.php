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
include_once (plugin_dir_path(__FILE__) . 'inc/data-table.php');
register_activation_hook(__FILE__, 'datasheets_data_table');

include_once (plugin_dir_path(__FILE__) . 'inc/data-cpt.php');
include_once (plugin_dir_path(__FILE__) . 'inc/data-fields.php');
