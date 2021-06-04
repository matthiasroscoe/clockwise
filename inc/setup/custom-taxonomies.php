<?php 

/**
 * Regions Taxonomy for Locations
 */

add_action( 'init', 'regions_taxonomy', 0 );

function regions_taxonomy() {
  $labels = array(
    'name'              => _x( 'Regions', 'taxonomy general name', 'pac-catch' ),
    'singular_name'     => _x( 'Region', 'taxonomy singular name', 'pac-catch' ),
    'search_items'      => __( 'Search Regions', 'pac-catch' ),
    'all_items'         => __( 'All Regions', 'pac-catch' ),
    'edit_item'         => __( 'Edit Region', 'pac-catch' ),
    'parent_item'       => __( 'Region', 'pac-catch' ),
    'parent_item_colon' => __( 'Region:', 'pac-catch' ),
    'update_item'       => __( 'Update Region', 'pac-catch' ),
    'add_new_item'      => __( 'Add New Region', 'pac-catch' ),
    'new_item_name'     => __( 'New Region Name', 'pac-catch' ),
    'menu_name'         => __( 'Regions', 'pac-catch' ),
  );

  $args = array(
    'hierarchical'      => false,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => false,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'locations' ),
  );

  register_taxonomy( 'regions', array( 'location' ), $args );
}




?>