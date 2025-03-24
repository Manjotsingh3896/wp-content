<?php
// functions.php

// Register Custom Post Type for Customer Reviews
function create_customer_review_post_type() {
    register_post_type('customer_review',
        array(
            'labels' => array(
                'name' => __('Customer Reviews'),
                'singular_name' => __('Customer Review')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
            'rewrite' => array('slug' => 'reviews'),
            'menu_icon' => 'dashicons-star-filled',
        )
    );
}
add_action('init', 'create_customer_review_post_type');