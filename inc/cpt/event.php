<?php

/* Events post type */
add_action( 'init', 'event_post_type' );

function event_post_type() {
    $labels = array(
        'name'               => _x( 'Events', 'post type general name', 'clockwise' ),
        'singular_name'      => _x( 'Event', 'post type singular name', 'clockwise' ),
        'menu_name'          => _x( 'Events', 'admin menu', 'clockwise' ),
        'name_admin_bar'     => _x( 'Event', 'add new on admin bar', 'clockwise' ),
        'add_new'            => _x( 'Add New', 'menu', 'clockwise' ),
        'add_new_item'       => __( 'Add New Event', 'clockwise' ),
        'new_item'           => __( 'New Event', 'clockwise' ),
        'edit_item'          => __( 'Edit Event', 'clockwise' ),
        'view_item'          => __( 'View Event', 'clockwise' ),
        'all_items'          => __( 'All Events', 'clockwise' ),
        'search_items'       => __( 'Search Events', 'clockwise' ),
        'parent_item_colon'  => __( 'Parent Events:', 'clockwise' ),
        'not_found'          => __( 'No events found.', 'clockwise' ),
        'not_found_in_trash' => __( 'No events found in Trash.', 'clockwise' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Events', 'clockwise' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'events' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-calendar-alt',
        'hierarchical'       => false,
        'menu_position'      => 4,
        'supports'           => array( 'title', 'author' )
    );

    register_post_type( 'event', $args );
}

/**
 * Event Locations Taxonomy for Locations
 */

add_action( 'init', 'event_location_taxonomy', 0 );

function event_location_taxonomy() {
  $labels = array(
    'name'              => _x( 'Locations', 'taxonomy general name', 'clockwise' ),
    'singular_name'     => _x( 'Location', 'taxonomy singular name', 'clockwise' ),
    'search_items'      => __( 'Search Locations', 'clockwise' ),
    'all_items'         => __( 'All Locations', 'clockwise' ),
    'edit_item'         => __( 'Edit Location', 'clockwise' ),
    'parent_item'       => __( 'Location', 'clockwise' ),
    'parent_item_colon' => __( 'Location:', 'clockwise' ),
    'update_item'       => __( 'Update Location', 'clockwise' ),
    'add_new_item'      => __( 'Add New Location', 'clockwise' ),
    'new_item_name'     => __( 'New Location Name', 'clockwise' ),
    'menu_name'         => __( 'Locations', 'clockwise' ),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'public'            => false,
    'show_ui'           => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => false,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'event-locations' ),
  );

  register_taxonomy( 'event-location', array( 'event' ), $args );
}
?>