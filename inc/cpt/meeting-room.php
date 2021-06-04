<?php

/* Meeting Rooms post type */
add_action( 'init', 'meeting_room_post_type' );

function meeting_room_post_type() {
    $labels = array(
        'name'               => _x( 'Meeting Rooms', 'post type general name', 'clockwise' ),
        'singular_name'      => _x( 'Meeting Room', 'post type singular name', 'clockwise' ),
        'menu_name'          => _x( 'Meeting Rooms', 'admin menu', 'clockwise' ),
        'name_admin_bar'     => _x( 'Meeting Room', 'add new on admin bar', 'clockwise' ),
        'add_new'            => _x( 'Add New', 'menu', 'clockwise' ),
        'add_new_item'       => __( 'Add New Meeting Room', 'clockwise' ),
        'new_item'           => __( 'New Meeting Room', 'clockwise' ),
        'edit_item'          => __( 'Edit Meeting Room', 'clockwise' ),
        'view_item'          => __( 'View Meeting Room', 'clockwise' ),
        'all_items'          => __( 'All Meeting Rooms', 'clockwise' ),
        'search_items'       => __( 'Search Meeting Rooms', 'clockwise' ),
        'parent_item_colon'  => __( 'Parent Meeting Rooms:', 'clockwise' ),
        'not_found'          => __( 'No meeting rooms found.', 'clockwise' ),
        'not_found_in_trash' => __( 'No meeting rooms found in Trash.', 'clockwise' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Meeting Rooms', 'clockwise' ),
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'meeting-rooms' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-desktop',
        'hierarchical'       => false,
        'menu_position'      => 4,
        'supports'           => array( 'title' )
    );

    register_post_type( 'meeting-room', $args );
}


?>