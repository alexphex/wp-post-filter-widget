<?php
/**
 * Plugin Name: Post Filter Widget
 * Description: Widget for sorting posts by category, date and popularity.
 * Version: 1.0
 * Author: alex & Copilot
 */

class Post_Filter_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct('post_filter_widget', 'Post Filter Widget', array('description' => 'Filter Posts'));
    }

    public function widget($args, $instance) {
        echo '<form id="filter-form">
                <select name="category">
                    <option value="">Select category</option>';
                    $categories = get_categories();
                    foreach ($categories as $category) {
                        echo '<option value="' . $category->term_id . '">' . $category->name . '</option>';
                    }
        echo   '</select>
                <input type="date" name="date">
                <select name="order">
                    <option value="date">By date</option>
                    <option value="popularity">By popularity</option>
                </select>
                <button type="submit">Filter</button>
              </form>';
        
        // Automatically create a container for posts
        echo '<div id="posts-container"></div>';

    }
}

function register_post_filter_widget() {
    register_widget('Post_Filter_Widget');
}
add_action('widgets_init', 'register_post_filter_widget');

/**
 * connect script & styles
 */
require_once plugin_dir_path(__FILE__) . 'assets.php';

/**
 * Add AJAX handler
 */
require_once plugin_dir_path(__FILE__) . 'ajax-handler.php';