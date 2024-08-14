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
