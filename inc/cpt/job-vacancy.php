<?php

/* Team Member post type */
add_action( 'init', 'job_vacancy_post_type' );

function job_vacancy_post_type() {
    $labels = array(
        'name'               => _x( 'Vacancies', 'post type general name', 'clockwise' ),
        'singular_name'      => _x( 'Vacancy', 'post type singular name', 'clockwise' ),
        'menu_name'          => _x( 'Vacancies', 'admin menu', 'clockwise' ),
        'name_admin_bar'     => _x( 'Vacancy', 'add new on admin bar', 'clockwise' ),
        'add_new'            => _x( 'Add New', 'menu', 'clockwise' ),
        'add_new_item'       => __( 'Add New Vacancy', 'clockwise' ),
        'new_item'           => __( 'New Vacancy', 'clockwise' ),
        'edit_item'          => __( 'Edit Vacancy', 'clockwise' ),
        'view_item'          => __( 'View Vacancy', 'clockwise' ),
        'all_items'          => __( 'All Vacancies', 'clockwise' ),
        'search_items'       => __( 'Search Vacancies', 'clockwise' ),
        'parent_item_colon'  => __( 'Parent Vacancies:', 'clockwise' ),
        'not_found'          => __( 'No vacancies found.', 'clockwise' ),
        'not_found_in_trash' => __( 'No vacancies found in Trash.', 'clockwise' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Vacancies', 'clockwise' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'vacancy' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_icon'          => 'dashicons-admin-post',
        'menu_position'      => 4,
        'supports'           => array( 'title', 'author' )
    );

    register_post_type( 'job_vacancy', $args );
}


/**
 * Job Type taxonomy
 */

add_action( 'init', 'job_type_taxonomy', 0 );

function job_type_taxonomy() {
  $labels = array(
    'name'              => _x( 'Job Types', 'taxonomy general name', 'clockwise' ),
    'singular_name'     => _x( 'Job Type', 'taxonomy singular name', 'clockwise' ),
    'search_items'      => __( 'Search Job Types', 'clockwise' ),
    'all_items'         => __( 'All Job Types', 'clockwise' ),
    'edit_item'         => __( 'Edit Job Type', 'clockwise' ),
    'parent_item'       => __( 'Job Type', 'clockwise' ),
    'parent_item_colon' => __( 'Job Type:', 'clockwise' ),
    'update_item'       => __( 'Update Job Type', 'clockwise' ),
    'add_new_item'      => __( 'Add New Job Type', 'clockwise' ),
    'new_item_name'     => __( 'New Job Type Name', 'clockwise' ),
    'menu_name'         => __( 'Job Types', 'clockwise' ),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'public'            => false,
    'show_ui'           => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => false,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'job-type' ),
  );

  register_taxonomy( 'job-type', array( 'job_vacancy' ), $args );
}


/**
 * Job Location taxonomy
 */

add_action( 'init', 'job_location_taxonomy', 0 );

function job_location_taxonomy() {
  $labels = array(
    'name'              => _x( 'Job Locations', 'taxonomy general name', 'clockwise' ),
    'singular_name'     => _x( 'Job Location', 'taxonomy singular name', 'clockwise' ),
    'search_items'      => __( 'Search Job Locations', 'clockwise' ),
    'all_items'         => __( 'All Job Locations', 'clockwise' ),
    'edit_item'         => __( 'Edit Job Location', 'clockwise' ),
    'parent_item'       => __( 'Job Location', 'clockwise' ),
    'parent_item_colon' => __( 'Job Location:', 'clockwise' ),
    'update_item'       => __( 'Update Job Location', 'clockwise' ),
    'add_new_item'      => __( 'Add New Job Location', 'clockwise' ),
    'new_item_name'     => __( 'New Job Location Name', 'clockwise' ),
    'menu_name'         => __( 'Job Locations', 'clockwise' ),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'public'            => false,
    'show_ui'           => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => false,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'job-location' ),
  );

  register_taxonomy( 'job-location', array( 'job_vacancy' ), $args );
}
