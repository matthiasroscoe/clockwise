<?php

/* Membership Plans post type */
add_action( 'init', 'membership_plan_post_type' );

function membership_plan_post_type() {
    $labels = array(
        'name'               => _x( 'Membership Plans', 'post type general name', 'clockwise' ),
        'singular_name'      => _x( 'Membership Plan', 'post type singular name', 'clockwise' ),
        'menu_name'          => _x( 'Membership Plans', 'admin menu', 'clockwise' ),
        'name_admin_bar'     => _x( 'Membership Plan', 'add new on admin bar', 'clockwise' ),
        'add_new'            => _x( 'Add New', 'menu', 'clockwise' ),
        'add_new_item'       => __( 'Add New Membership Plan', 'clockwise' ),
        'new_item'           => __( 'New Membership Plan', 'clockwise' ),
        'edit_item'          => __( 'Edit Membership Plan', 'clockwise' ),
        'view_item'          => __( 'View Membership Plan', 'clockwise' ),
        'all_items'          => __( 'All Membership Plans', 'clockwise' ),
        'search_items'       => __( 'Search Membership Plans', 'clockwise' ),
        'parent_item_colon'  => __( 'Parent Membership Plans:', 'clockwise' ),
        'not_found'          => __( 'No membership plans found.', 'clockwise' ),
        'not_found_in_trash' => __( 'No membership plans found in Trash.', 'clockwise' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Membership Plans', 'clockwise' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'membership-plans' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-star-filled',
        'hierarchical'       => false,
        'menu_position'      => 4,
        'supports'           => array( 'title' )
    );

    register_post_type( 'membership-plans', $args );
}

?>