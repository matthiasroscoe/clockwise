<?php

/* Testimonials post type */
add_action( 'init', 'testimonial_post_type' );

function testimonial_post_type() {
    $labels = array(
        'name'               => _x( 'Testimonials', 'post type general name', 'clockwise' ),
        'singular_name'      => _x( 'Testimonial', 'post type singular name', 'clockwise' ),
        'menu_name'          => _x( 'Testimonials', 'admin menu', 'clockwise' ),
        'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'clockwise' ),
        'add_new'            => _x( 'Add New', 'menu', 'clockwise' ),
        'add_new_item'       => __( 'Add New Testimonial', 'clockwise' ),
        'new_item'           => __( 'New Testimonial', 'clockwise' ),
        'edit_item'          => __( 'Edit Testimonial', 'clockwise' ),
        'view_item'          => __( 'View Testimonial', 'clockwise' ),
        'all_items'          => __( 'All Testimonials', 'clockwise' ),
        'search_items'       => __( 'Search Testimonials', 'clockwise' ),
        'parent_item_colon'  => __( 'Parent Testimonials:', 'clockwise' ),
        'not_found'          => __( 'No Testimonials found.', 'clockwise' ),
        'not_found_in_trash' => __( 'No Testimonials found in Trash.', 'clockwise' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Testimonials', 'clockwise' ),
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonials' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-testimonial',
        'hierarchical'       => false,
        'menu_position'      => 4,
        'supports'           => array( 'title' )
    );

    register_post_type( 'testimonial', $args );
}


/**
 * Video/Quote taxonomy for Testimonials
 */

// add_action( 'init', 'media_taxonomy', 0 );

function media_taxonomy() {
  $labels = array(
    'name'              => _x( 'Media', 'taxonomy general name', 'clockwise' ),
    'singular_name'     => _x( 'Media', 'taxonomy singular name', 'clockwise' ),
    'search_items'      => __( 'Search Media', 'clockwise' ),
    'all_items'         => __( 'All Media', 'clockwise' ),
    'edit_item'         => __( 'Edit Media', 'clockwise' ),
    'parent_item'       => __( 'Media', 'clockwise' ),
    'parent_item_colon' => __( 'Media:', 'clockwise' ),
    'update_item'       => __( 'Update Media', 'clockwise' ),
    'add_new_item'      => __( 'Add New Media', 'clockwise' ),
    'new_item_name'     => __( 'New Media Name', 'clockwise' ),
    'menu_name'         => __( 'Media', 'clockwise' ),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => false,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'media' ),
  );

  register_taxonomy( 'media', array( 'testimonial' ), $args );
}

?>