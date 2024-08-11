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

include_once (plugin_dir_path(__FILE__) . 'inc/data-cpt.php');

/**
 * Add datasheets data meta box on data post editor
 * 
 * @return void
 */
function datasheets_data_meta_box()
{
    add_meta_box(
        'data_fields',
        'Data Fields',
        'datasheets_data_fields_cb',
        'data',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'datasheets_data_meta_box');

/**
 * 
 * Data Datasheets date fields on post meta box
 * 
 * @param mixed $post
 * @return void
 */
function datasheets_data_fields_cb($post)
{
    wp_nonce_field(basename(__FILE__), 'datasheets_data_fields_nonce');

    ?>
    <table class="form-table">
        <tr>
            <th>
                <label for="manufacturer_name">Manufacturer Name</label>
            </th>
            <td><input type="text" name="manufacturer_name" id="manufacturer_name" class="regular-text"></td>
        </tr>
        <tr>
            <th>
                <label for="part_number">Part Number</label>
            </th>
            <td>
                <input type="text" name="part_number" id="part_number" class="regular-text">
            </td>
        </tr>
        <tr>
            <th>
                <label for="pdf_name">PDF Name</label>
            </th>
            <td>
                <input type="text" name="pdf_name" id="pdf_name" class="regular-text">
            </td>
        </tr>
        <tr>
            <th>
                <label for="description">Description</label>
            </th>
            <td>
                <textarea name="description" id="description" rows="2" class="regular-text"></textarea>
            </td>
        </tr>
        <tr>
            <th>
                <label for="source_url">Source Url</label>
            </th>
            <td>
                <input type="text" name="source_url" id="source_url" class="large-text">
            </td>
        </tr>
        <tr>
            <th>
                <label for="file_url">File Url</label>
            </th>
            <td>
                <input type="text" name="file_url" id="file_url" class="large-text">
            </td>
        </tr>
    </table>
    <?php
}


/**
 * Save Datasheets meta box submitted data on a data custom table
 * 
 * @param mixed $post_id
 * @return void
 */
function save_datasheets_data_fields_meta_box_data($post_id)
{
    if (!isset($_POST['datasheets_data_fields_nonce']) || !wp_verify_nonce($_POST['datasheets_data_fields_nonce'], basename(__FILE__))) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // manufacturer_name and part_number must be defined to execute the data store query 
    if (!isset($_POST['manufacturer_name']) || empty($_POST['manufacturer_name']) || !isset($_POST['part_number']) || empty($_POST['part_number'])) {

        add_settings_error(
            'data_meta_field_errors',
            'data_meta_field_error',
            'Manufacturer name and Part Number fields cannot be empty',
            'error'
        );

        set_transient('data_meta_errors', get_settings_errors('data_meta_field_errors'), 30);

        wp_safe_redirect(add_query_arg('failed_message', 'data_meta_error', get_edit_post_link($post_id, 'url')));
        exit;

    }

    // Check and sanitize the custom field input
    // if (isset($_POST['manufacturer_name'])) {
    //     $sanitized_value = sanitize_text_field($_POST['manufacturer_name']);
    //     update_post_meta($post_id, 'manufacturer_name', $sanitized_value);
    // } else {
    //     // If the field is empty, delete the meta key
    //     delete_post_meta($post_id, 'manufacturer_name');
    // }
}
add_action('save_post', 'save_datasheets_data_fields_meta_box_data');


/**
 *  Show error message on the post edit screen
 * 
 * @return void
 */
function datasheets_display_data_meta_errors()
{
    // Check if the custom message query parameter is set
    if (isset($_GET['failed_message']) && $_GET['failed_message'] === 'data_meta_error') {
        $errors = get_transient('data_meta_errors');

        if ($errors) {
            foreach ($errors as $error) {
                ?>
                <div class="notice notice-error is-dismissible">
                    <p><?php echo esc_html($error['message']); ?></p>
                </div>
                <?php
            }

            delete_transient('data_meta_errors');
        }
    }
}
add_action('admin_notices', 'datasheets_display_data_meta_errors');

