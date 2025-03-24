<?php
// functions.php

// Register Custom Post Type for Customer Reviews
/**
 * Register a custom post type called "expert_tips".
 *
 * @see get_post_type_labels() for label keys.
 */
function wpdocs_codex_expert_tips_init() {
    $labels = array(
        'name'                  => _x( 'Expert Tips', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Expert Tip', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Expert Tips', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Expert Tip', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New Expert Tip', 'textdomain' ),
        'new_item'              => __( 'New Expert Tip', 'textdomain' ),
        'edit_item'             => __( 'Edit Expert Tip', 'textdomain' ),
        'view_item'             => __( 'View Expert Tip', 'textdomain' ),
        'all_items'             => __( 'All Expert Tips', 'textdomain' ),
        'search_items'          => __( 'Search Expert Tips', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Expert Tips:', 'textdomain' ),
        'not_found'             => __( 'No expert tips found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No expert tips found in Trash.', 'textdomain' ),
        'featured_image'        => _x( 'Tip Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set tip image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove tip image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as tip image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'Expert Tips archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into expert tip', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this expert tip', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter expert tips list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'Expert Tips list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'Expert Tips list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'expert-tips' ), // URL slug for the post type
        'capability_type'    => 'post',
        'has_archive'        => true, // Enable archive page
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-lightbulb', // Icon for the admin menu
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'show_in_rest'       => true, // Enable Block Editor support
    );

    register_post_type( 'expert_tips', $args );
}

add_action( 'init', 'wpdocs_codex_expert_tips_init' );

