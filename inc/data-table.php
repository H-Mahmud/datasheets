<?php
/**
 * Create Datasheets data custom table
 * 
 * @version 1.0.0
 */
function datasheets_data_table()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'data';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        post_id bigint(20) NOT NULL,
        name varchar(255) DEFAULT NULL UNIQUE,
        title varchar(255) DEFAULT NULL,
        manufacturer_name varchar(255) DEFAULT NULL,
        part_number varchar(255) DEFAULT NULL,
        file_name varchar(255) DEFAULT NULL,
        description text DEFAULT NULL,
        source_url varchar(255) DEFAULT NULL,
        file_url varchar(255) DEFAULT NULL,
        status varchar(25) DEFAULT NULL,
        PRIMARY KEY (id),
        KEY post_id (post_id),
        KEY manufacturer_name (manufacturer_name),
        KEY part_number (part_number)
    ) $charset_collate;";

    require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
