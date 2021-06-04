<section class="mr-grid module module-<?php echo $mod_num; ?>">
    <div class="container-lg">
        
        <?php if ($m['heading']) : ?>
            <div class="row justify-content-center">
                <div class="mr-grid__headings | col-lg-6 mb-lg-4">
                    <h1 class="text-center"><?php echo $m['heading']; ?></h1>
                </div>
            </div>
        <?php endif; ?>

        <div class="row mx-lg-0">
            <div class="col-12 px-0">
                
                <div class="c-filter | d-flex flex-column flex-lg-row justify-content-lg-between">
                    <div class="c-filter__options | d-flex flex-column flex-lg-row flex-wrap align-items-stretch align-items-lg-center justify-content-lg-between">
                        <div class="c-filter__dropdown">
                            <label><?php pll_e('Region'); ?>:</label>
                            <select id="mr-regions" class="js-selectric js-mr-regions js-reg-dropdown-update">
                                <?php // Regions
                                    $regions = get_terms(array(
                                        'taxonomy' => 'regions',
                                        'parent' => 0,
                                    ));
                                    $i = 1; foreach($regions as $reg) { ?>
                                        <option value="<?php echo $reg->term_id; ?>" <?php if ($i == 1) { echo 'selected'; } ?>><?php echo $reg->name; ?></option>
                                    <?php $i++; }
                                ?>
                            </select>
                        </div>
    
                        <div class="c-filter__dropdown">
                            <label><?php pll_e('Location'); ?>:</label>
                            <select id="mr-locations" class="js-selectric js-mr-locations js-loc-dropdown-update">
                                <option value="" selected disabled><?php pll_e('Select location'); ?></option>
                                <option value="all"><?php pll_e('All locations'); ?></option>
                                <?php // Locations
                                    $locations = get_posts(array(
                                        'post_type' => 'location',
                                        'post_status' => 'publish',
                                        'posts_per_page' => -1,
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'regions',
                                                'terms' => $regions[0]->term_id,
                                            )
                                        ),
                                        'orderby' => 'title',
                                        'order' => 'ASC'
                                    ));
                                    
                                    foreach($locations as $loc) { ?>
                                        <option value="<?php echo $loc->ID; ?>"><?php echo get_the_title($loc->ID); ?></option>
                                    <?php }
                                ?>
                            </select>
                        </div>
    
                        <div class="c-filter__dropdown">
                            <label><?php pll_e('No. of seats'); ?>:</label>
                            <select id="mr-num-seats" class="js-selectric js-mr-num-seats">
                                <?php for ($i=2; $i < 20; $i++) : ?>
                                    <option value="<?php echo $i; ?>" <?php if ($i == 2) { echo 'selected'; } ?> ><?php echo $i; ?></option>
                                <?php endfor; ?>
                                <option value="20">20+</option>
                            </select>
                        </div>
                    </div>
    
                    <div class="c-filter__actions">
                        <a class="c-filter__submit js-mr-filter-submit | d-block d-lg-flex justify-content-lg-center align-items-lg-center text-upper text-center" href="#" data-barba-prevent><?php pll_e('Find a room'); ?></a>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="c-filter__reset | text-right">
                    <a href="#" class="js-mr-filter-reset | u-rel d-inline-block text-upper" data-barba-prevent><?php pll_e('Reset filter'); ?></a>
                </div>
            </div>
        </div>
    </div>

    <div class="mr-grid__region-filter | container-lg">
        <div class="row">
            <?php echo get_region_filter($regions[0], 'meeting-room', null, null); ?>
        </div>
    </div>
    
    <div class="js-mr-posts"></div>

</section>