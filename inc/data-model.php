<?php
defined('ABSPATH') || exit();
/**
 * Insert a new data row on data table
 * 
 * @param array $data
 * @return bool|int
 */
function ds_insert_data($data)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'data';

    $format = array(
        '%d',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
    );

    return $wpdb->insert($table_name, $data, $format);
}

/**
 * Update a Data row by data id
 * 
 * @param int $id
 * @param array $data
 * @return bool|int
 */
function ds_update_data($id, $data)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'data';

    $format = array(
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
    );

    return $wpdb->update($table_name, $data, ['id' => $id], $format, ['%d']);
}


/**
 * Get data id by post_id purpose to check does data exist
 * 
 * @param int $post_id
 * @return string|null
 */
function ds_get_data_id($post_id)
{
    global $wpdb;

    return $wpdb->get_var($wpdb->prepare("SELECT id FROM {$wpdb->prefix}data WHERE post_id=%d LIMIT 1", $post_id));
}

/**
 * Get a single data row from data by post_id
 * 
 * @param int $post_id
 * @return array|null
 */
function ds_get_data($post_id)
{
    global $wpdb;

    return $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}data WHERE post_id=%d LIMIT 1", $post_id), ARRAY_A);
}
