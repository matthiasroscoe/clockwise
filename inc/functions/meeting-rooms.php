<?php // Meeting Rooms related functions

/**
 * Get all meeting rooms for specified location
 */
function get_meeting_rooms_by_location($location_id = NULL) {
    if ($location_id == NULL) {
        return;
    }

    $args = array(
        'post_type' => 'meeting-room',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'fields' => 'ids',
        'meta_query' => array(
            array(
                'key' => 'location',
                'value' => '"' . $location_id . '"',
                'compare' => 'LIKE',
            )
        ),
    );

    $rooms = get_posts($args);

    return $rooms;
}



/**
 * Get meeting room feature data
 */

function get_mr_feature_icon($feature = null) {
    if ($feature == null) {
        return;
    }

    // TODO. as part of phase 2 have icons for diff meeting room features (e.g. wifi, disabled access, etc).
    // Logic is ready below just need the features from client and icons from design.
    switch ($feature) {
        case 'a':
            $icon = get_icon('feature-x.svg');
            break;
            
        case 'b':
            $icon = get_icon('feature-y.svg'); 
            break;
        
        default:
            break;
    }

    // return $icon;
    return get_icon('icon-placeholder.svg');
}



/**
 * Get HTML for a meeting room card
 */
function get_meeting_room_card($mr_id = NULL) {
    if ($mr_id == NULL) {
        return;
    }

    $img = (get_field('image', $mr_id)) ? get_field('image', $mr_id)['sizes']['cw_600'] : get_image('clockwise-placeholder.jpg');
    
    if (get_field('floor', $mr_id)) {
        $floor_seats_text = pll__('Floor') . ' ' . get_field('floor', $mr_id);
    }
    if ($floor_seats_text) {
        $floor_seats_text .= ', ' . get_field('num_seats', $mr_id) . ' ' . pll__('seats');
    } else {
        $floor_seats_text = get_field('num_seats', $mr_id) . ' ' . pll__('seats');
    }

    ob_start();
    ?>
        <div class="mr-card | col-md-6 col-lg-4">
            
            <img class="img" src="<?php echo $img; ?>" alt="<?php echo get_the_title($mr_id); ?>" loading="lazy">
            
            <div class="details js-matchHeight | d-flex flex-column align-items-start">
                <div class="name | d-flex flex-column flex-lg-row u-w100 justify-content-between">
                    <p class="title fw-500"><?php echo get_the_title($mr_id); ?></p>
                    <p class="floor-seats | fw-300 m-0"><?php echo $floor_seats_text; ?></p>
                </div>

                <!-- <div class="icons | d-flex flex-wrap">
                    <?php if (get_field('features', $mr_id)) : foreach(get_field('features', $mr_id) as $feature) : 
                        $icon = get_mr_feature_icon($feature['value']); ?>
                        <img class="d-block" src="<?php echo $icon; ?>" alt="<?php echo $feature['label']; ?>" loading="lazy">
                    <?php endforeach; endif; ?>
                </div> -->

                <?php if (get_field('description', $mr_id)) : ?>
                    <p class="description | fw-300"><?php echo get_field('description', $mr_id); ?></p>
                <?php endif; ?>
                
                <div class="flex-fill d-flex flex-column align-items-start justify-content-end">
                    <?php if (get_field('price', $mr_id)) : ?>
                        <p class="price | mb-0 fw-300"><span class="amount fw-500"><?php echo get_field('price', $mr_id); ?></span> <?php pll_e('per hour'); ?></p>
                    <?php endif; ?>

                    <?php
                        // PHASE2
                        // Meeting room modal button 
                        // $tel = get_field('phone_number', get_field('location', $mr_id)[0]);
                        // $email = get_field('email', get_field('location', $mr_id)[0]);

                        // $btn_data = array(
                        //     'button_type' => 'custom',
                        //     'class' => 'js-mr-modal-open',
                        //     'title' => pll__('Book Now'),
                        //     'data_attr' => 'data-email="' . $email . '" data-tel="' . $tel . '"',
                        // );
                        // echo get_button(null, null, null, $btn_data);
                    ?>
                    <?php 
                        // Book as member button
                        if (get_field('operate_bookings_url', 'option')) {
                            $btn_data = array(
                                'button_type' => 'link',
                                'data_attr' => 'id="book-as-member"',
                                'link' => array(
                                    'title' => pll__('Book as member'),
                                    'url' => get_field('operate_bookings_url', 'option'),
                                    'target' => '_blank',
                                ),
                            );
                            echo get_button(null, null, 'small', $btn_data);
                        }
                        
                        // Book as non-member button
                        $tel = get_field('phone_number', get_field('location', $mr_id)[0]);
                        $email = get_field('email', get_field('location', $mr_id)[0]);

                        if ($tel || $email) {
                            $btn_data = array(
                                'button_type' => 'custom',
                                'class' => 'js-mr-modal-open',
                                'title' => pll__('Book as non-member'),
                                'data_attr' => 'id="book-as-non-member" ' . 'data-email="' . $email . '" data-tel="' . $tel . '"',
                            );
                            echo get_button('white', null, 'small', $btn_data);
                        }

                    ?>
                </div>
            </div>

        </div>
    <?php

    wp_reset_postdata();

    $html = ob_get_clean();
    return $html;
}


/**
 * Get meeting rooms grid
 * Get's all meeting rooms for a region, separated by location
 */

add_action('wp_ajax_nopriv_get_meeting_rooms_grid', 'get_meeting_rooms_grid');
add_action('wp_ajax_get_meeting_rooms_grid', 'get_meeting_rooms_grid');

function get_meeting_rooms_grid($region = null, $posts_per_page = '3', $num_seats = '2') {
    if (isset($_POST['region'])) {
        $region = $_POST['region'];
    }
    if (isset($_POST['num_seats'])) {
        $num_seats = (int) $_POST['num_seats'];
    }
    if (isset($_POST['posts_per_page'])) {
        $posts_per_page = $_POST['posts_per_page'];
    }
    
    if ($region == null) {
        return;
    }


    $locations = get_locations_by_region($region);
    
    ob_start();
    $num_locations = 0;
    foreach($locations as $loc) {
        echo get_meeting_rooms_grid_section($loc, $posts_per_page, $num_seats);
    }
    $html = ob_get_clean();

    if ($html == '' || ctype_space($html)) {
        $html = get_no_meeting_rooms_html();
    }

    if ($_POST['regions_ajax']) {
        echo $html;
        wp_die();
    } else {
        return $html;
    }
}



/**
 * Get meeting rooms grid row for a location
 */

add_action('wp_ajax_nopriv_get_meeting_rooms_grid_section', 'get_meeting_rooms_grid_section');
add_action('wp_ajax_get_meeting_rooms_grid_section', 'get_meeting_rooms_grid_section');

function get_meeting_rooms_grid_section($location_id = null, $posts_per_page = '3', $num_seats = '2') {
    
    if (isset($_POST['location'])) {
        $location_id = (int) $_POST['location'];
    }
    if (isset($_POST['num_seats'])) {
        $num_seats = (int) $_POST['num_seats'];
    }
    if (isset($_POST['posts_per_page'])) {
        $posts_per_page = $_POST['posts_per_page'];
    }
    
    if ($location_id == null) {
        return;
    }

    ob_start();
    
    $rooms = filter_rooms_by_num_seats($location_id, $num_seats);
    
    // Display card for each room
    if ($rooms) : ?>
        <div class="mr-grid__location | container-lg">
            <div class="row">
                <div class="mr-grid__location__heading | col-12">
                    <h3><?php echo get_the_title($location_id); ?></h3>
                </div>
            </div>

            <div class="mr-grid__row | row" data-location="<?php echo $location_id; ?>">
                <?php 
                    if ($posts_per_page == '-1') {
                        foreach($rooms as $room) {
                            echo get_meeting_room_card($room);
                        }
                    } else {
                        for ($i = 0; $i < $posts_per_page; $i++) {
                            echo get_meeting_room_card($rooms[$i]);
                        } 
                    }
                ?>
            </div>

            <?php if (count($rooms) > 3 && $posts_per_page != '-1') : ?>
                <div class="mr-grid__load-more | row justify-content-center" data-location="<?php echo $location_id; ?>">
                    <div class="col-md-6 col-lg-4 text-center">
                        <?php 
                            $btn_data = array(
                                'button_type' => 'custom',
                                'title' => pll__('Load more'),
                                'class' => 'js-mr-load-more u-lg-w100',
                                'data_attr' => 'data-location="' . $location_id . '" data-offset="' . $posts_per_page . '"',
                            );
                            echo get_button('beige', 'load-more', null, $btn_data); 
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    <?php 
    else :
        if ($_POST['is_ajax']) : 
            echo get_no_meeting_rooms_html();    
        endif;
    endif;

    $html = ob_get_clean();

    if ($_POST['is_ajax']) {
        echo $html;
        wp_die();
    } else {
        return $html;
    }
}



/**
 * Load more meeting rooms AJAX func.
 * 
 */

add_action('wp_ajax_nopriv_meeting_rooms_grid_load_more', 'meeting_rooms_grid_load_more');
add_action('wp_ajax_meeting_rooms_grid_load_more', 'meeting_rooms_grid_load_more');

function meeting_rooms_grid_load_more() {
    if (isset($_POST['location'])) {
        $location_id = $_POST['location'];
    }
    if (isset($_POST['num_seats'])) {
        $num_seats = $_POST['num_seats'];
    }
    if (isset($_POST['offset'])) {
        $offset = $_POST['offset'];
    }

    $rooms = filter_rooms_by_num_seats($location_id, $num_seats);

    $html = '';
    $i = 1; foreach($rooms as $room) {
        if ($i <= $offset) {
            $i++;
            continue;
        }
        $html .= get_meeting_room_card($room);
        $i++;
    }

    echo $html;
    wp_die();
}



/**
 * Get all rooms for a location that have a greater 
 * or equal number of rooms to the number specified.
 */

function filter_rooms_by_num_seats($location_id = null, $num_seats = null) {
    if ($location_id == null || $num_seats == null) {
        return;
    }

    $rooms = get_meeting_rooms_by_location($location_id);
    // Check if room has enough seats
    $rooms_filtered = array();
    foreach($rooms as $room) {
        if (get_field('num_seats', $room) >= $num_seats) {
            $rooms_filtered[] = $room;
        }
    }

    return $rooms_filtered;
}



/**
 * No meeting rooms fallback text
 */

function get_no_meeting_rooms_html() {
    ob_start();
    ?>
        <div class="mr-grid__location | py-3 container-lg">
            <div class="row">
                <div class="mr-grid__empty | col-12">
                    <h3 class="text-center"><?php pll_e('No meeting rooms could be found'); ?></h3>
                </div>
            </div>
        </div>
    <?php
    $html = ob_get_clean();
    return $html;
}
?>