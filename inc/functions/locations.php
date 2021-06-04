<?php // Misc locations-related functions

/**
 * Gets all locations for a region, returns only IDs
 */

function get_locations_by_region($region_id = NULL, $data_type = NULL) {
    if ($region_id == NULL) {
        return;
    }

    $args = array(
        'post_type' => 'location',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => 'regions',
                'terms' => $region_id,
            ),
        ),
    );

    if ($data_type == null) {
        $args['fields'] = 'ids';
    }
    
    return get_posts($args);
}


/**
 * Get location name with sub-region
 */

function get_location_name_with_subregion($location_id = null) {
    if ($location_id == null) {
        return;
    }

    $terms = wp_get_post_terms($location_id, 'regions');
    foreach($terms as $term) {
        if ($term->parent != 0) {
            $term_name = $term->name;
            break;
        }
    }

    if ($term_name) {
        return $term_name . ' - ' . get_the_title($location_id);
    } else {
        return get_the_title($location_id);
    }

}


/**
 * Get HTML for the filter by region dropdown for locations
 */
function get_region_filter($region_id = NULL, $post_type = 'location', $subheading = null, $locations = null) {
    if ($region_id == NULL) {
        return;
    }
    
    if ($locations != null) {
        $regions = wp_get_object_terms($locations, 'regions', array(
            'parent' => 0,
        ));
    } else {
        $regions = get_terms(array(
            'taxonomy' => 'regions',
            'parent' => 0,
        ));
    }

    ob_start();

    if ($regions) : ?>
        <div class="locations__filter locations__filter--dropdown <?php echo $post_type; ?> | col-12">
            <?php if ($subheading) : ?>
                <span class="locations__filter__subheading | d-block text-upper ml-1"><?php echo $subheading; ?></span>
            <?php endif; ?>

            <select class="js-selectric selectric-transparent js-regions-filter-<?php echo $post_type; ?>" name="location-filter" id="location-filter">
                <?php foreach($regions as $region) : ?>
                    <option value="<?php echo $region->term_id; ?>" <?php if ($region->term_id == $region_id) { echo 'selected '; } ?>><?php echo $region->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endif;

    $html = ob_get_clean();
    return $html;
}


/** 
 * Get region pill buttons 
 */

function get_region_pill_buttons($region_id = null, $subheading = null, $locations = null) {
    if ($region_id == null) {
        return;
    }

    if ($locations != null) {
        $regions = wp_get_object_terms($locations, 'regions', array(
            'parent' => 0,
        ));
    } else {
        $regions = get_terms(array(
            'taxonomy' => 'regions',
            'parent' => 0,
        ));
    }

    ob_start();

    if ($regions) : ?>
        <div class="locations__filter locations__filter--pills | d-none d-lg-block col-lg-11 col-xl-10 col-xxl-8">
            <div class="c-pills">
                <?php if ($subheading) : ?>
                    <p class="c-pills__heading | text-center"><?php echo $subheading; ?></p>
                <?php endif; ?>
                <div class="c-pills__inner | d-flex justify-content-center align-items-center">
                    <?php $i = 1; foreach($regions as $reg) : ?>
                        <a href="#" class="c-pill js-regions-filter-pill <?php if ($reg->term_id == $region_id) { echo 'is-active'; } ?>" title="<?php echo $reg->name; ?>" data-term-id="<?php echo $reg->term_id; ?>" data-barba-prevent><?php echo $reg->name; ?></a>
                    <?php $i++; endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif;

    $html = ob_get_clean();
    return $html;
}


/**
 * Get HTML for a location card
 */
function get_location_card($location_id = NULL, $style = NULL, $region_name = NULL) {
    if ($location_id == NULL) {
        return;
    }

    ob_start();
    ?>  
        <div class="location-card js-match-height | col-md-6 col-lg-4">

            <?php if ($style == 'show-region-name') : ?>
                <div class="c-accordion js-loc-index-accordion | d-flex align-items-center justify-content-between" data-term-id="<?php echo $reg->term_id; ?>">
                    <h2 class="c-accordion__title"><?php echo $region_name; ?></h2>
                    <div class="c-accordion__toggle">
                        <span class="line"></span>
                        <span class="line line-2"></span>
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="location-card__inner | d-flex flex-column">
                <a class="image-wrap | d-block u-rel" href="<?php echo get_permalink($location_id); ?>" title="<?php echo get_the_title($location_id); ?>">
                    <img class="u-fluid" src="<?php echo get_field('thumbnail', $location_id)['sizes']['cw_600']; ?>" alt="<?php echo get_field('thumbnail', $location_id)['alt']; ?>" loading="lazy">
                </a>
                
                <div class="details | flex-fill d-flex flex-column align-items-start">
                    <div class="name | u-w100 d-flex justify-content-between align-items-center align-items-lg-start">
                        <p class="title m-0 fw-500"><?php echo get_location_name_with_subregion($location_id); ?></p>
                        <?php if (! get_field('location_status', $location_id) && get_field('coming_soon_text', $location_id)) : ?>
                            <span class="coming-soon | text-upper text-white fw-500"><?php pll_e('Coming soon'); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ($style != 'contact') : ?>
                        
                        <?php if (get_field('building_name', $location_id)) : ?>
                            <p class="building-name | fw-300"><?php echo get_field('building_name', $location_id); ?></p>
                        <?php endif; ?>
                        
                        <?php if (get_field('address', $location_id)) : ?>
                            <div class="address | fw-300 d-flex align-items-start">
                                <img src="<?php echo get_icon('pin.svg'); ?>" loading="lazy" alt="Address">
                                <p class="ml-2 mb-0"><?php echo get_field('address', $location_id); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (get_field('intro', $location_id)) : 
                            $intro = get_field('intro', $location_id);
                            // $intro_truncated = strlen($intro) > 75 ? substr($intro, 0, 75) . "..." : $intro;
                            // $intro_trimmed = trim($intro_truncated);
                            ?>
                            <p class="intro | fw-300"><?php echo $intro; ?></p>
                        <?php endif; ?>
                    
                    <?php else: ?>
                        
                        <div class="contact">
                            
                            <?php if (get_field('address', $location_id)) : ?>
                                <p class="contact__heading | fw-500 text-upper mb-1"><?php pll_e('Address'); ?></p>
                            
                                <p class="mb-0"><?php echo get_field('address', $location_id); ?></p>
                                
                                <?php if ( get_field('google_maps_link', $location_id) ) : ?>
                                    <a class="fw-300" href="<?php echo get_field('google_maps_link', $location_id); ?>"><?php pll_e('View in Google Maps'); ?></a>
                                <?php endif; ?>
                            <?php endif; ?>
                            
                            <?php if (get_field('email', $location_id) || get_field('phone_number', $location_id)) : ?>
                                <p class="contact__heading contact__heading--email | fw-500 text-upper mb-1"><?php pll_e('Contact Info'); ?></p>
    
                                <?php if (get_field('email', $location_id)) : ?>
                                    <p class="link mb-1">E: <a href="mailto:<?php the_field('email', $location_id); ?>" target="_blank"><?php the_field('email', $location_id); ?></a></p>
                                <?php endif; ?>
                                <?php if (get_field('phone_number', $location_id)) : ?>
                                    <p class="link mb-0">T: <a href="tel:<?php the_field('phone_number', $location_id); ?>" target="_blank"><?php the_field('phone_number', $location_id); ?></a></p>
                                <?php endif; ?>
    
                            <?php endif; ?>
                        </div>
    
                    <?php endif; ?>
                    
                    <div class="button | flex-fill d-flex flex-column justify-content-end">
                        <?php 
                            $btn_title = ($style != 'contact') ? pll__('Learn More') : pll__('View Location');
                            $btn_data = array(
                                'button_type' => 'link',
                                'link' => array(
                                    'title' => $btn_title,
                                    'target' => '_self',
                                    'url' => get_permalink($location_id),
                                )
                                );
                            echo get_button(null, null, null, $btn_data);
                        ?>
                    </div>
                </div>
            </div>

        </div>
    <?php

    wp_reset_postdata();

    $html = ob_get_clean();
    return $html;
}




/**
 * Locations Load More button functionality
 */

add_action('wp_ajax_nopriv_locations_load_more', 'locations_load_more');
add_action('wp_ajax_locations_load_more', 'locations_load_more');

function locations_load_more() {
    $region_id = (isset($_POST['region'])) ? $_POST['region'] : null;
    $offset = (isset($_POST['offset'])) ? $_POST['offset'] : null;
    $filtered_locations = (isset($_POST['locations']) && $_POST['locations'] != '') ? $_POST['locations'] : null;

    if ($filtered_locations == null) {
        $locations = get_locations_by_region($region_id);
    } else {
        $args = array(
            'post_type' => 'location',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'field' => 'ids',
            'order' => 'ASC',
            'orderby' => 'title',
            'post__in' => $filtered_locations,
            'tax_query' => array(
                array(
                    'taxonomy' => 'regions',
                    'terms' => $region_id,
                )
            )
        );
        $locations = get_posts($args);
    }
    
    $html = '';
    $i = 1; foreach($locations as $loc) {
        if ($i <= $offset) {
            $i++;
            continue;
        }
        $html .= get_location_card($loc, null, null);
        $i++;
    }

    echo $html;
    wp_die();
}


/**
 * Locations region filters AJAX
 */

add_action('wp_ajax_nopriv_filter_locations_by_region', 'filter_locations_by_region');
add_action('wp_ajax_filter_locations_by_region', 'filter_locations_by_region');

function filter_locations_by_region() {

    $region = (isset($_POST['region'])) ? (int) $_POST['region'] : null;
    $posts_per_page = (isset($_POST['posts_per_page'])) ? $_POST['posts_per_page'] : null;
    $locations = (isset($_POST['locations']) && $_POST['locations'] != '') ? $_POST['locations'] : null;
    
    ob_start();
    ?>
        <div class="js-locations-grid | row">
            <?php
                $args = array(
                    'post_type' => 'location',
                    'posts_per_page' => $posts_per_page,
                    'post_status' => 'publish',
                    'field' => 'ids',
                    'order' => 'ASC',
                    'orderby' => 'title',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'regions',
                            'terms' => $region,
                        )
                    )
                );
                
                // If module set to only show certain locations
                if ($locations != null) {
                    $args['post__in'] = $locations;
                }
                
                $posts = get_posts($args);

                foreach($posts as $post) {
                    echo get_location_card($post);
                }
            ?>
        </div>
        
        <?php 
        $args['posts_per_page'] = '-1';
        $total_locations = get_posts($args);
        if (count($total_locations) > $posts_per_page) : ?>
            <div class="locations__load-more js-loc-load-more-container | row justify-content-center" data-region="<?php echo $region; ?>">
                <div class="col-md-6 col-lg-4 text-center">
                    <?php 
                        $btn_data = array(
                            'button_type' => 'custom',
                            'title' => pll__('Load more'),
                            'class' => 'js-loc-load-more u-lg-w100',
                            'data_attr' => 'data-region="' . $region . '" data-offset="' . $posts_per_page . '"',
                        );
                        echo get_button('beige', 'load-more', null, $btn_data); 
                    ?>
                </div>
            </div>
        <?php endif; ?>
    <?php
    $html = ob_get_clean();

    echo $html;
    wp_die();
}

?>