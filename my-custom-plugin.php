<?php
/*
Plugin Name: My Custom Plugin
Description: A custom plugin to demonstrate various features
Version: 1.0
Author: Your Name
*/

// Add meta tag inside haeader
function add_fb_meta_tag() {
    echo '<meta property="fb:pages" content="XXXXX123456" />';
}
add_action('wp_head', 'add_fb_meta_tag');

// Home alert script
function enqueue_custom_scripts() {
    if( is_front_page() ) {
        wp_enqueue_script('alert-script', plugins_url('/alert.js', __FILE__), array(), null, true);
    }
}

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');
// Post title replacer
function replace_post_content( $content ) {
    return '- NEW POST TITLE';
}
add_filter('the_content', 'replace_post_content');

// Book category creation

function create_book_post_type() {
    $args = array(
        'public' => true,
        'label'  => 'Books',
        'menu_icon' => 'dashicons-book',
    );
    register_post_type('book', $args);
}
add_action('init', 'create_book_post_type');

// Fetch user data from api

function fetch_users() {
    $response = wp_remote_get('https://jsonplaceholder.typicode.com/users/');
    if( is_array($response) ) {
        $users = json_decode( wp_remote_retrieve_body($response), true );
     }
}
add_action('init', 'fetch_users');
