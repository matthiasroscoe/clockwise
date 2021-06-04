<?php 

/**
 * Get Regions Dropdown
 */

function get_hero_dropdown($type = null, $region_id = null) {
    
    if ($type == 'locations') {
        $locations = get_locations_by_region($region_id);
    } else {
        $regions = get_terms(array(
            'taxonomy' => 'regions',
            'parent' => 0,
        ));
    }

    if ($type == 'locations') :   

        // If region has sub-regions pass data to js to create a dropdown within selectric
        $subregion_dropdowns = array();
        $child_terms = get_term_children($region_id, 'regions');
        foreach($child_terms as $child_term) {
            $term = get_term($child_term, 'regions');
            if ($term->count > 1) {
                $subregion_dropdowns[] = $term->name;
            }
        }

        $subregions_dropdowns_string = '';
        if (! empty($subregion_dropdowns)) {
            if (count($subregion_dropdowns) > 1) {
                $subregions_dropdowns_string = 'data-subregions="' . implode(',', $subregion_dropdowns) . '"';
            } else {
                $subregions_dropdowns_string = 'data-subregions="' . $subregion_dropdowns[0] . '"';
            }
        }

        ?>
            <select name="location" id="select-region" class="js-selectric-locations js-hero-loc-select--locations js-hero-loc-select" <?php echo $subregions_dropdowns_string; ?> data-coming-soon-text="<?php pll_e('Coming soon'); ?>">
                <option value="" selected disabled>Select a location...</option>
                <?php 
                    foreach ($locations as $loc) :
                        // Get coming soon status
                        $coming_soon = false;
                        if (get_field('location_status', $loc) == false && get_field('coming_soon_text', $loc)) {
                            $coming_soon = 'coming-soon';
                        }

                        // Add sub-region as data attribute, so we can create subregion dropdown in js
                        $subregion = false;
                        $terms = get_the_terms($loc, 'regions');
                        foreach($terms as $term) {
                            if ($term->parent != 0) {
                                if (in_array($term->name, $subregion_dropdowns)) {
                                    $subregion = $term->name;
                                }
                            }
                        }

                        ?>
                            <option <?php if ($subregion) { echo 'data-subregion="' . $subregion . '"'; } ?> data-location-status="<?php if ($coming_soon) { echo $coming_soon; } ?>" value="<?php echo $loc; ?>" data-url="<?php echo get_permalink($loc); ?>"><?php echo get_the_title($loc); ?></option>
                        <?php
                    endforeach;
                ?>
            </select>
        <?php else : ?>
            <select name="location" id="select-region" class="js-selectric js-hero-loc-select js-hero-loc-select--regions">
                <option value="" selected disabled>Select a region...</option>
                <?php foreach($regions as $reg) : ?>
                    <option value="<?php echo $reg->term_id; ?>" data-url="<?php echo get_term_link($reg->term_id); ?>"><?php echo $reg->name; ?></option>
                <?php endforeach; ?>    
            </select>
        <?php endif; ?>

        <a class="hero__view-location js-view-location-btn c-btn c-btn--dark | d-lg-none" href="#" title="<?php pll_e('View Location'); ?>">
            <span><?php pll_e('View Location'); ?></span>
            <div class="icon">
                <svg>
                    <circle class="bg-circle" r="50%" cx="50%" cy="50%" />
                    <circle class="fg-circle" r="50%" cx="50%" cy="50%" />
                </svg>
                <img src="<?php echo get_icon('arrow--white.svg'); ?>" alt="arrow">
            </div>
        </a>
            
        <?php 
            if ($type == 'locations') {
                $class = 'js-find-location';
                $data_attr = 'data-region="' . $region_id . '"';
            } else {
                $class = 'js-find-region';
                $data_attr = '';
            }
        ?> 
        <div class="hero__find-location <?php echo $class; ?> js-hov | d-flex d-lg-inline-flex align-items-center justify-content-center justify-content-lg-start" <?php echo $data_attr; ?>>
            <img src="<?php echo get_icon('find-location.svg'); ?>" alt="Find location">
            <span class="text-underline text-white pl-2">Use your location</span>
        </div>
    <?php
}



/**
 * Get hero contact info HTML
 */

function get_hero_contact_info() {
    $bus_name = get_field('business_name', 'option');
    $email = get_field('general_email', 'option');
    $phone = get_field('general_phone_number', 'option');
    $socials = get_field('socials', 'option');

    ob_start();
    ?>
        <div class="hero__contact-info">
            <?php if ($bus_name) : ?>
                <div class="bus-name mb-4">
                    <h4 class="text-upper text-white"><?php pll_e('Business Name'); ?></h4>
                    <p><?php echo $bus_name; ?></p>
                </div>
            <?php endif; ?>

            <div class="email-number | mb-4">
                <h4 class="text-upper text-white"><?php pll_e('Contact Info'); ?></h4>
                <?php if ($email) : ?>
                    <p class="mb-1 mb-lg-0">E: <a href="mailto:<?php echo $email; ?>" target="_blank" ><?php echo $email; ?></a></p>
                <?php endif; ?>
                <?php if ($phone) : ?>
                    <p>T: <a href="tel:<?php echo $phone; ?>" target="_blank" ><?php echo $phone; ?></a></p>
                <?php endif; ?>
            </div>

            <?php if ($socials) : ?>
                <div class="socials | d-flex align-items-center pt-1">
                    <?php foreach($socials as $soc) : ?>
                        <a class="d-block" href="<?php echo $soc['url']; ?>" title="<?php echo $soc['account']; ?>" target="_blank">
                            <img src="<?php echo $soc['icon']; ?>" alt="<?php echo $soc['account']; ?>" loading="lazy">
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php
    $html = ob_get_clean();
    return $html;
}
?>