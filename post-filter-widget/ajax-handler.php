<?php 

/**
 * AJAX handler
 */
function filter_posts() {
    // get request param
    $category = isset($_POST['category']) ? intval($_POST['category']) : '';
    $date = isset($_POST['date']) ? sanitize_text_field($_POST['date']) : '';
    $order = isset($_POST['order']) ? sanitize_text_field($_POST['order']) : 'date';

    // form arguments for WP_Query
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 10,
    );

    if ($category) {
        $args['cat'] = $category;
    }

    if ($date) {
        $args['date_query'] = array(
            array(
                'after'     => $date,
                'inclusive' => true,
            ),
        );
    }

    if ($order === 'popularity') {
        $args['meta_key'] = 'post_views_count';
        $args['orderby']  = 'meta_value_num';
        $args['order']    = 'DESC';
    } else {
        $args['orderby'] = 'date';
        $args['order']   = 'DESC';
    }

    // request posts
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            echo '<div class="post-item">';
            echo '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
            echo '<p>' . get_the_excerpt() . '</p>';
            echo '</div>';
        }
        wp_reset_postdata();
    } else {
        echo '<p>No posts found.</p>';
    }

    die(); // end request
}

// register AJAX handler
add_action('wp_ajax_filter_posts', 'filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts');
