<?php
defined('ABSPATH') || exit();

/**
 * Editor error view for Data post type only
 * 
 * @param mixed $message
 * @param mixed $post_id
 * @return never
 */
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


/**
 * Safely data print from data array by array key
 * 
 * @param array $data
 * @param string $key
 * @return void
 */
function ds_the_data($data, $key)
{
    if (!$data)
        return;
    isset($data[$key]) ? esc_attr_e($data[$key], 'datasheets') : '';

}
