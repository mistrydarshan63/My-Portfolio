<?php 

function enqueue_child_theme_styles() {
    wp_enqueue_style('darshan-style', get_stylesheet_directory_uri() . '/darshan-style.css');
    wp_enqueue_script('darshan-script', get_stylesheet_directory_uri() . '/darshan-javascript.js');
}
add_action('wp_enqueue_scripts', 'enqueue_child_theme_styles');