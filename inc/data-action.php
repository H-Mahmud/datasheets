<?php
/**
 * Delete Data row from data table together deleting data post from post table
 * 
 * @param int $post_id
 * @return void
 */
function delete_custom_table_row_on_post_delete($post_id)
{
    global $wpdb;

    if (empty($post_id) || get_post_status($post_id) === false) {
        return;
    }

    $table_name = $wpdb->prefix . 'data';

    $wpdb->delete(
        $table_name,
        array('post_id' => $post_id),
        array('%d')
    );
}

add_action('before_delete_post', 'delete_custom_table_row_on_post_delete');
