<?php

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
                <label for="file_name">File Name</label>
            </th>
            <td>
                <input type="text" name="file_name" id="file_name" class="regular-text">
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

        ds_error_editor_admin('Manufacturer name and Part Number fields cannot be empty', $post_id);
    }

    $title = isset($_POST['post_title']) ? sanitize_text_field($_POST['post_title']) : '';
    $status = isset($_POST['post_status']) ? sanitize_text_field($_POST['post_status']) : '';

    $manufacturer_name = sanitize_text_field($_POST['manufacturer_name']);
    $part_number = sanitize_text_field($_POST['part_number']);
    $name = sanitize_title($manufacturer_name . $part_number);
    $file_name = isset($_POST['file_name']) ? sanitize_text_field($_POST['file_name']) : '';
    $description = isset($_POST['description']) ? sanitize_text_field($_POST['description']) : '';
    $source_url = isset($_POST['source_url']) ? sanitize_text_field($_POST['source_url']) : '';
    $file_url = isset($_POST['file_url']) ? sanitize_text_field($_POST['file_url']) : '';

    $data = array(
        'post_id' => $post_id,
        'name' => $name,
        'title' => $title,
        'manufacturer_name' => $manufacturer_name,
        'part_number' => $part_number,
        'file_name' => $file_name,
        'description' => $description,
        'source_url' => $source_url,
        'file_url' => $file_url,
        'status' => $status
    );

    $data_id = ds_get_data_id($post_id);
    if ($data_id) {
        unset($data['post_id']);
        ds_update_data($data_id, $data);
        return;
    }

    if (!ds_insert_data($data))
        ds_error_editor_admin('Failed to insert datasheet data', $post_id);
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

