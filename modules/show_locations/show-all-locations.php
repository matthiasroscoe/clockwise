<section class="locations locations--show-all module module-<?php echo $mod_num; ?>">
    <div class="container-lg">
        <?php 
            $regions = get_terms(array(
                'taxonomy' => 'regions',
                'parent' => 0,
            ));

            // Separate regions with one location from regions with multiple locations
            $regions_with_one_location = array();
            $regions_with_multiple_locations = array();
            
            foreach($regions as $region) : 
                $locations = get_locations_by_region($region);
                if (count($locations) > 1) {
                    $regions_with_multiple_locations[] = array(
                        'region' => $region,
                        'locations' => $locations,
                    );
                } else if (count($locations) == 1) {
                    $regions_with_one_location[] = array(
                        'region' => $region,
                        'location' => $locations[0],
                    );
                }
            endforeach;

            // Display England first, Scotland second
            get_region_row($regions_with_multiple_locations[0]);
            get_region_row($regions_with_multiple_locations[1]);

            // Display Wales & N. Ireland together
            // Combines regions with only one location into one row.
            if (count($regions_with_one_location) > 0) : ?>
                <div class="region region--one-location | row">
                    <?php foreach($regions_with_one_location as $region) : ?>
                        <?php echo get_location_card($region['location'], 'show-region-name', $region['region']->name); ?>
                    <?php endforeach; ?>
                </div>
            <?php endif;

            // Display Mainland Europe and rest of regions.
            $i = 1; foreach($regions_with_multiple_locations as $region) :
                if ($i < 3) {
                    $i++;
                    continue;
                }
                get_region_row($region);
            $i++; endforeach;
            
        ?>
    </div>
</section>

<?php function get_region_row($region = null) { 
    if ($region == null) { return; }
    ?>
    <div class="region | row">
                    
        <?php if ($i == 1) : ?>
            <p class="subheading | text-upper mb-0"><?php pll_e('Clockwise in:'); ?></p>
        <?php endif; ?>

        <div class="c-accordion js-loc-accordion | d-flex align-items-center justify-content-between col-12" data-term-id="<?php echo $reg->term_id; ?>">
            <h2 class="c-accordion__title"><?php echo $region['region']->name; ?></h2>
            <div class="c-accordion__toggle">
                <span class="line"></span>
                <span class="line line-2"></span>
            </div>
        </div>
    
        <div class="region__posts js-locations-grid-container" data-region="<?php echo $region['region']->term_id; ?>">
            <div class="region__posts__inner js-locations-grid | d-flex flex-wrap">
                <?php for ($i=0; $i < 3; $i++) { 
                        echo get_location_card($region['locations'][$i], null);
                } ?>
            </div>

            <?php if (count($region['locations']) > 3) : ?>
                <div class="region__load-more js-loc-load-more-container | row justify-content-center" data-region="<?php echo $region['region']->term_id; ?>">
                    <div class="col-md-6 col-lg-4">
                        <?php 
                            $btn_data = array(
                                'button_type' => 'custom',
                                'title' => pll__('Load more'),
                                'class' => 'js-loc-load-more u-w100',
                                'data_attr' => 'data-region="' . $region['region']->term_id . '" data-offset="3" data-barba-prevent',
                            );
                            echo get_button('beige', 'load-more', null, $btn_data); 
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>   
<?php } ?>