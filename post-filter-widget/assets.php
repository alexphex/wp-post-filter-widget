<?php 

/**
 * connect script
 */
function enqueue_post_filter_scripts() {
    wp_enqueue_script('post-filter', plugin_dir_url(__FILE__) . 'post-filter.js', array('jquery'), null, true);
    wp_localize_script('post-filter', 'post_filter', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_post_filter_scripts');

/**
 * connect styles
 */
function enqueue_post_filter_styles() {
    wp_enqueue_style('post-filter-css', plugin_dir_url(__FILE__) . 'post-filter.css');
}
add_action('wp_enqueue_scripts', 'enqueue_post_filter_styles');
