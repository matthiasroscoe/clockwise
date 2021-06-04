<?php
/**
 * Template name: Community Template
 */

get_header();

/**
* Hero Slider
*/

// Get data for slider
if (get_field('display_mode') == 'recent') {
    $args = array(
        'post_type' => array('event', 'article'),
        'posts_per_page' => 4,
        'post_status' => 'publish',
        'fields' => 'ids',
    );
    $articles = get_posts($args);
} else {
    $articles = get_field('articles');
}

$items = array();
foreach($articles as $a) {
    $items[$a] = array(
        'post_type' => get_post_type($a),
        'heading' => get_the_title($a),
        'link' => get_the_permalink($a),
        'mobile_image' => get_field('thumbnail', $a),
        'time_since_published' => get_time_since_published($a),
    );

    if (get_field('description', $a)) {
        $items[$a]['description'] = get_field('description', $a);
    }

    if (get_field('landscape', $a)) {
        $items[$a]['desktop_image'] = get_field('landscape', $a);
    } else {
        $items[$a]['desktop_image'] = $items[$a]['mobile_image'];
    }

    if (get_post_type($a) == 'article') {
        $items[$a]['subheading'] = pll__('Featured article');
    } else if (get_post_type($a) == 'event') {
        $items[$a]['subheading'] = pll__('Featured event');
    }
}

// Display slider
include(get_stylesheet_directory() . '/modules/hero-slider.php');


/**
* Articles/Events grid
*/
include(get_stylesheet_directory() . '/modules/articles_events_grid.php');

get_footer();