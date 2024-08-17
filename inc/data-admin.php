<?php
defined('ABSPATH') || exit();

/**
 * Create a Custom Data Post Type
 * 
 * @return void
 */
function datasheets_data_cpt()
{

    $labels = array(
        'name' => _x('Data', 'Post type general name', 'datasheets'),
        'singular_name' => _x('Data', 'Post type singular name', 'datasheets'),
        'menu_name' => _x('Data', 'Admin Menu text', 'datasheets'),
        'name_admin_bar' => _x('Data', 'Add New on Toolbar', 'datasheets'),
        'add_new' => __('Add New', 'datasheets'),
        'add_new_item' => __('Add New Data', 'datasheets'),
        'new_item' => __('New Data', 'datasheets'),
        'edit_item' => __('Edit Data', 'datasheets'),
        'view_item' => __('View Data', 'datasheets'),
        'all_items' => __('All Data', 'datasheets'),
        'search_items' => __('Search Data', 'datasheets'),
        'parent_item_colon' => __('Parent Data:', 'datasheets'),
        'not_found' => __('No data found.', 'datasheets'),
        'not_found_in_trash' => __('No data found in Trash.', 'datasheets'),
        'featured_image' => _x('Featured Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'datasheets'),
        'set_featured_image' => _x('Set featured image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'datasheets'),
        'remove_featured_image' => _x('Remove featured image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'datasheets'),
        'use_featured_image' => _x('Use as featured image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'datasheets'),
        'archives' => _x('Data archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'datasheets'),
        'insert_into_item' => _x('Insert into data', 'Overrides the “Insert into post” phrase (used when inserting media into a post). Added in 4.4', 'datasheets'),
        'uploaded_to_this_item' => _x('Uploaded to this data', 'Overrides the “Uploaded to this post” phrase (used when viewing media attached to a post). Added in 4.4', 'datasheets'),
        'filter_items_list' => _x('Filter data list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”. Added in 4.4', 'datasheets'),
        'items_list_navigation' => _x('Data list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”. Added in 4.4', 'datasheets'),
        'items_list' => _x('Data list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”. Added in 4.4', 'datasheets'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'data'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'author'),
        'show_in_rest' => false, // Disable Gutenberg editor, enable Classic Editor
    );

    register_post_type('data', $args);
}

add_action('init', 'datasheets_data_cpt');

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

    $data = ds_get_data($post->ID);
    ?>
    <table class="form-table">
        <tr>
            <th>
                <label for="manufacturer_name">Manufacturer Name</label>
            </th>
            <td><input type="text" name="manufacturer_name" id="manufacturer_name"
                    value="<?php ds_the_data($data, 'manufacturer_name'); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th>
                <label for="part_number">Part Number</label>
            </th>
            <td>
                <input type="text" name="part_number" id="part_number" value="<?php ds_the_data($data, 'part_number'); ?>"
                    class="regular-text">
            </td>
        </tr>
        <tr>
            <th>
                <label for="file_name">File Name</label>
            </th>
            <td>
                <input type="text" name="file_name" id="file_name" value="<?php ds_the_data($data, 'file_name'); ?>"
                    class="regular-text">
            </td>
        </tr>
        <tr>
            <th>
                <label for="description">Description</label>
            </th>
            <td>
                <textarea name="description" id="description" rows="2"
                    class="regular-text"><?php ds_the_data($data, 'description'); ?></textarea>
            </td>
        </tr>
        <tr>
            <th>
                <label for="source_url">Source Url</label>
            </th>
            <td>
                <input type="text" name="source_url" id="source_url" value="<?php ds_the_data($data, 'source_url'); ?>"
                    class="large-text">
            </td>
        </tr>
        <tr>
            <th>
                <label for="file_url">File Url</label>
            </th>
            <td>
                <input type="text" name="file_url" id="file_url" value="<?php ds_the_data($data, 'file_url'); ?>"
                    class="large-text">
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
    $name = sanitize_title($manufacturer_name . '-' . $part_number);
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

