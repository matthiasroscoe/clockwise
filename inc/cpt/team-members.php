<?php

/* Team Member post type */
add_action( 'init', 'team_members_post_type' );

function team_members_post_type() {
    $labels = array(
        'name'               => _x( 'Team Members', 'post type general name', 'clockwise' ),
        'singular_name'      => _x( 'Team Member', 'post type singular name', 'clockwise' ),
        'menu_name'          => _x( 'Team Members', 'admin menu', 'clockwise' ),
        'name_admin_bar'     => _x( 'Team Member', 'add new on admin bar', 'clockwise' ),
        'add_new'            => _x( 'Add New', 'menu', 'clockwise' ),
        'add_new_item'       => __( 'Add New Team Member', 'clockwise' ),
        'new_item'           => __( 'New Team Member', 'clockwise' ),
        'edit_item'          => __( 'Edit Team Member', 'clockwise' ),
        'view_item'          => __( 'View Team Member', 'clockwise' ),
        'all_items'          => __( 'All Team Members', 'clockwise' ),
        'search_items'       => __( 'Search Team Members', 'clockwise' ),
        'parent_item_colon'  => __( 'Parent Team Members:', 'clockwise' ),
        'not_found'          => __( 'No team members found.', 'clockwise' ),
        'not_found_in_trash' => __( 'No team members found in Trash.', 'clockwise' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Team Members', 'clockwise' ),
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'team-member' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-groups',
        'hierarchical'       => false,
        'menu_position'      => 4,
        'supports'           => array( 'title' )
    );

    register_post_type( 'team_member', $args );
}

?>