<?php
/**
 * Template name: Careers Template
 */

get_header();

/**
* Hero
*/

// Show hero slider
if (get_field('hero_type') == 'slider') {
    // Get data for slider
    if (get_field('display_mode') == 'recent') {
        $args = array(
            'post_type' => 'career_case_study',
            'posts_per_page' => 4,
            'post_status' => 'publish',
            'fields' => 'ids',
        );
        $case_studies = get_posts($args);
    } else {
        $case_studies = get_field('case_studies');
    }
    
    $items = array();
    foreach($case_studies as $cs) {
        $items[$cs] = array(
            'post_type' => get_post_type($cs),
            'heading' => get_the_title($cs),
            'subheading' => pll__('Career Case Study'),
            'link' => get_the_permalink($cs),
            'mobile_image' => get_field('thumbnail', $cs),
            'time_since_published' => get_time_since_published($cs),
        );
    
        if (get_field('description', $cs)) {
            $items[$cs]['description'] = get_field('description', $cs);
        }
    
        if (get_field('landscape', $cs)) {
            $items[$cs]['desktop_image'] = get_field('landscape', $cs);
        } else {
            $items[$cs]['desktop_image'] = $items[$cs]['mobile_image'];
        }
    }
    
    // Display slider
    include(get_stylesheet_directory() . '/modules/hero-slider.php');
} 

// Show normal hero
else {
    $m = array();
    $m['heading'] = get_field('hero_heading');
    $m['text'] = get_field('hero_text');
    $m['image'] = get_field('hero_image');
    $m['mobile_image'] = get_field('hero_mobile_image');

    include(get_stylesheet_directory() . '/modules/hero.php');
}



/**
* Job Vacancies filter & posts
*/
include(get_stylesheet_directory() . '/modules/vacancies.php');


get_footer(); ?>