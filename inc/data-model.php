<?php
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

    $inserted = $wpdb->insert($table_name, $data, $format);

    return $inserted;
}
