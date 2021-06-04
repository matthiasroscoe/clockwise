<?php

/* Team Member post type */
add_action( 'init', 'career_case_study_post_type' );

function career_case_study_post_type() {
    $labels = array(
        'name'               => _x( 'Case Studies', 'post type general name', 'clockwise' ),
        'singular_name'      => _x( 'Case Study', 'post type singular name', 'clockwise' ),
        'menu_name'          => _x( 'Case Studies', 'admin menu', 'clockwise' ),
        'name_admin_bar'     => _x( 'Case Study', 'add new on admin bar', 'clockwise' ),
        'add_new'            => _x( 'Add New', 'menu', 'clockwise' ),
        'add_new_item'       => __( 'Add New Case Study', 'clockwise' ),
        'new_item'           => __( 'New Case Study', 'clockwise' ),
        'edit_item'          => __( 'Edit Case Study', 'clockwise' ),
        'view_item'          => __( 'View Case Study', 'clockwise' ),
        'all_items'          => __( 'All Case Studies', 'clockwise' ),
        'search_items'       => __( 'Search Case Studies', 'clockwise' ),
        'parent_item_colon'  => __( 'Parent Case Studies:', 'clockwise' ),
        'not_found'          => __( 'No case studies found.', 'clockwise' ),
        'not_found_in_trash' => __( 'No case studies found in Trash.', 'clockwise' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Case Studies', 'clockwise' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'case-study' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-groups',
        'hierarchical'       => false,
        'menu_position'      => 4,
        'supports'           => array( 'title', 'author' )
    );

    register_post_type( 'career_case_study', $args );
}

?>