<?php

/* Articles post type */
add_action( 'init', 'article_post_type' );

function article_post_type() {
    $labels = array(
        'name'               => _x( 'Articles', 'post type general name', 'clockwise' ),
        'singular_name'      => _x( 'Article', 'post type singular name', 'clockwise' ),
        'menu_name'          => _x( 'Articles', 'admin menu', 'clockwise' ),
        'name_admin_bar'     => _x( 'Article', 'add new on admin bar', 'clockwise' ),
        'add_new'            => _x( 'Add New', 'menu', 'clockwise' ),
        'add_new_item'       => __( 'Add New Article', 'clockwise' ),
        'new_item'           => __( 'New Article', 'clockwise' ),
        'edit_item'          => __( 'Edit Article', 'clockwise' ),
        'view_item'          => __( 'View Article', 'clockwise' ),
        'all_items'          => __( 'All Articles', 'clockwise' ),
        'search_items'       => __( 'Search Articles', 'clockwise' ),
        'parent_item_colon'  => __( 'Parent Articles:', 'clockwise' ),
        'not_found'          => __( 'No articles found.', 'clockwise' ),
        'not_found_in_trash' => __( 'No articles found in Trash.', 'clockwise' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Articles', 'clockwise' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'articles' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-edit-page',
        'hierarchical'       => false,
        'menu_position'      => 4,
        'supports'           => array( 'title', 'author' )
    );

    register_post_type( 'article', $args );
}

?>