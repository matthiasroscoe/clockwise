<?php

/* Referrals post type */
add_action( 'init', 'referral_post_type' );

function referral_post_type() {
    $labels = array(
        'name'               => _x( 'Referrals', 'post type general name', 'clockwise' ),
        'singular_name'      => _x( 'Referral', 'post type singular name', 'clockwise' ),
        'menu_name'          => _x( 'Referrals', 'admin menu', 'clockwise' ),
        'name_admin_bar'     => _x( 'Referral', 'add new on admin bar', 'clockwise' ),
        'add_new'            => _x( 'Add New', 'menu', 'clockwise' ),
        'add_new_item'       => __( 'Add New Referral', 'clockwise' ),
        'new_item'           => __( 'New Referral', 'clockwise' ),
        'edit_item'          => __( 'Edit Referral', 'clockwise' ),
        'view_item'          => __( 'View Referral', 'clockwise' ),
        'all_items'          => __( 'All Referrals', 'clockwise' ),
        'search_items'       => __( 'Search Referrals', 'clockwise' ),
        'parent_item_colon'  => __( 'Parent Referrals:', 'clockwise' ),
        'not_found'          => __( 'No referrals found.', 'clockwise' ),
        'not_found_in_trash' => __( 'No referrals found in Trash.', 'clockwise' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Referrals', 'clockwise' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'referral' ),
        'capability_type'    => 'post',
        'capabilities'       => array(
            'create_posts' => 'do_not_allow'
        ),
        'map_meta_cap'       => true,
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-id',
        'hierarchical'       => false,
        'menu_position'      => 25,
        'supports'           => array( 'title', 'author' )
    );

    register_post_type( 'referral', $args );
}

?>