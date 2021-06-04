<?php

/* Locations post type */
add_action( 'init', 'location_post_type' );

function location_post_type() {
    $labels = array(
        'name'               => _x( 'Locations', 'post type general name', 'clockwise' ),
        'singular_name'      => _x( 'Location', 'post type singular name', 'clockwise' ),
        'menu_name'          => _x( 'Locations', 'admin menu', 'clockwise' ),
        'name_admin_bar'     => _x( 'Location', 'add new on admin bar', 'clockwise' ),
        'add_new'            => _x( 'Add New', 'menu', 'clockwise' ),
        'add_new_item'       => __( 'Add New Location', 'clockwise' ),
        'new_item'           => __( 'New Location', 'clockwise' ),
        'edit_item'          => __( 'Edit Location', 'clockwise' ),
        'view_item'          => __( 'View Location', 'clockwise' ),
        'all_items'          => __( 'All Locations', 'clockwise' ),
        'search_items'       => __( 'Search Locations', 'clockwise' ),
        'parent_item_colon'  => __( 'Parent Locations:', 'clockwise' ),
        'not_found'          => __( 'No locations found.', 'clockwise' ),
        'not_found_in_trash' => __( 'No locations found in Trash.', 'clockwise' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Locations', 'clockwise' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'locations' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-building',
        'hierarchical'       => false,
        'menu_position'      => 4,
        'supports'           => array( 'title' )
    );

    register_post_type( 'location', $args );
}



/**
 * Regions Taxonomy for Locations
 */

add_action( 'init', 'regions_taxonomy', 0 );

function regions_taxonomy() {
  $labels = array(
    'name'              => _x( 'Regions', 'taxonomy general name', 'clockwise' ),
    'singular_name'     => _x( 'Region', 'taxonomy singular name', 'clockwise' ),
    'search_items'      => __( 'Search Regions', 'clockwise' ),
    'all_items'         => __( 'All Regions', 'clockwise' ),
    'edit_item'         => __( 'Edit Region', 'clockwise' ),
    'parent_item'       => __( 'Region', 'clockwise' ),
    'parent_item_colon' => __( 'Region:', 'clockwise' ),
    'update_item'       => __( 'Update Region', 'clockwise' ),
    'add_new_item'      => __( 'Add New Region', 'clockwise' ),
    'new_item_name'     => __( 'New Region Name', 'clockwise' ),
    'menu_name'         => __( 'Regions', 'clockwise' ),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => false,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'regions' ),
  );

  register_taxonomy( 'regions', array( 'location' ), $args );
}


?>