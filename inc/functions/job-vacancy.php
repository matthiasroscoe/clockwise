<?php

/**
 * Get HTML for a job vacancy listing
 */
function get_vacancy_card($vacancy_id = NULL) {
    if ($vacancy_id == NULL) {
        return;
    }

    $locations = get_the_terms($vacancy_id, 'job-location');
    $location_name = $locations[0]->name;

    ob_start();
    ?>
        <div class="vacancy | col-lg-10 offset-lg-1">
            <div class="u-rel d-lg-flex align-items-start">
                
                <?php $img = (get_field('thumbnail', $vacancy_id)) ? get_field('thumbnail', $vacancy_id)['sizes']['cw_small'] : get_image('clockwise-placeholder.jpg'); ?>
                <img class="thumb" src="<?php echo $img; ?>" alt="<?php echo get_the_title($vacancy_id); ?>" loading="lazy">

                <div class="details">
                    <div class="title | d-lg-flex align-items-center">
                        <h3 class="heading | mb-0"><?php echo get_the_title($vacancy_id); ?></h3>
                        
                        <?php if ($location_name) : ?>
                            <p class="location | mb-0"><?php echo $location_name; ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="d-flex flex-column flex-lg-row align-items-start">
                        <?php if (get_field('description', $vacancy_id)) : ?>
                            <div class="description"><?php echo get_field('description', $vacancy_id); ?></div>
                        <?php endif; ?>

                        <div class="button text-right">
                            <?php 
                                if (get_field('external_link', $vacancy_id)) {
                                    $btn_data = array(
                                        'button_type' => 'link',
                                        'link' => array(
                                            'url' => get_field('external_link', $vacancy_id),
                                            'title' => pll__('Apply'),
                                            'target' => '_blank',
                                        ),
                                    );
                                } else {
                                    $btn_data = array(
                                        'button_type' => 'link',
                                        'link' => array(
                                            'title' => pll__('Learn More'),
                                            'url' => get_permalink($vacancy_id),
                                            'target' => '_self',
                                        ),
                                    );
                                }
                                
                                echo get_button(null, null, null, $btn_data); 
                            ?>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    <?php

    $html = ob_get_clean();
    return $html;
}



/**
 * Job Vacancies filter
 */

add_action('wp_ajax_nopriv_filter_vacancies', 'filter_vacancies');
add_action('wp_ajax_filter_vacancies', 'filter_vacancies');

function filter_vacancies() {
    // $region = (isset($_POST['region']) && $_POST['region'] != '') ? (int) $_POST['region'] : null;
    $location = (isset($_POST['location']) && $_POST['location'] != '') ? (int) $_POST['location'] : null;
    $job_type = (isset($_POST['jobType']) && $_POST['jobType'] != '') ? $_POST['jobType'] : null;
    $sort_by = (isset($_POST['sortBy']) && $_POST['sortBy'] != '') ? $_POST['sortBy'] : null;

    $args = array(
        'post_type' => 'job_vacancy',
        'posts_per_page' => -1, // We override this later once looped through all posts.
        'post_status' => 'publish',
        'fields' => 'ids',
    );
    
    $posts = get_posts($args);
    $has_posts = true;
    if (empty($posts)) {
        $has_posts = false;
    } 

    // Add sorting
    if ($sort_by == 'a-z') {
        $args['orderby'] = 'title';
        $args['order'] = 'ASC';
    }

    // Filter vacancies by location
    if ($location != null && $location != 'all') {
        $args['tax_query']['relation'] = 'AND';
        $args['tax_query'][] = array(
            'taxonomy' => 'job-location',
            'terms' => $location,
        );

    } 

    // Filter vacancies by job type
    if ($job_type != null && $job_type != 'all') {
        $args['tax_query']['relation'] = 'AND';
        $args['tax_query'][] = array(
            'taxonomy' => 'job-type',
            'terms' => $job_type,
        );
    }

    // Filter by region, if no location added
    // else if ($region != null && $region != 'all') {
    //     $region_locations = get_locations_by_region($region);
    //     $posts_by_region = array();
        
    //     foreach($posts as $post) {
    //         $post_location = get_field('location', $post)[0];

    //         if (in_array($post_location, $region_locations)) {
    //             $posts_by_region[] = $post;
    //         }
    //     }

    //     if (empty($posts_by_region)) {
    //         $has_posts = false;
    //     } else {
    //         $args['post__in'] = $posts_by_region;
    //     }
    // }

    // Get posts array again but with correct posts_per_page
    $args['posts_per_page'] = 5;
    $posts = get_posts($args);
    
    $html = '';
    if ($has_posts && count($posts) > 0) {
        foreach($posts as $post) {
            $html .= get_vacancy_card($post);
        }
    } else {
        ob_start();
        ?>
            <div class="col-lg-8 offset-lg-2">
                <h3 class="text-center"><?php pll_e('No vacancies could be found'); ?></h3>
            </div>
        <?php
        $html = ob_get_clean();
    }

    echo $html;
    wp_die();
}