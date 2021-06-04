<?php 
// Get all regions
$all_regions = get_terms('regions', array(
    'parent' => 0,
));

// Filter regions to only those which have svg_map acf field.
$regions = array();
foreach($all_regions as $reg) {
    if (get_field('map_svg', $reg)) {
        $regions[] = $reg;
    }
}
if (! empty($regions)) :
?>
    <section class="regions text-white module module-<?php echo $mod_num; ?>">
        <div class="container-lg">
            <div class="row">
                <div class="regions__maps js-hidden | col-lg-7 d-none d-lg-block">
                    <div class="selected | u-fluid">
                        <?php $first_reg = $regions[0]->term_id; ?>
                        <div class="map js-map-selected" data-term-id="<?php echo $regions[0]->term_id; ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="575px" version="1.1">
                                <g>
                                    <path id="selected-path" d="<?php echo get_field('map_svg', 'regions_' . $first_reg); ?>">
                                </g>
                            </svg>
                        </div>
                    </div>
                    <div class="unselected | u-fluid">
                        <svg class="js-reg-maps" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="575px" version="1.1">
                            <?php foreach($regions as $reg) : 
                                $reg_id = 'regions_' . $reg->term_id; 
                                $pointer = ($reg->term_id != $first_reg) ? 'pointer' : '';
                                ?>
                                <g cursor="<?php echo $pointer; ?>">
                                    <path id="<?php echo $reg->term_id; ?>" d="<?php echo get_field('map_svg', $reg_id); ?>">
                                </g>
                            <?php endforeach; ?>
                        </svg>
                    </div>
                    <?php 
                        foreach($regions as $reg) {    
                            $icons = get_field('regions_map_icons', 'regions_' . $reg->term_id);

                            if ($icons) {
                                $icon_data_attr = '';
                                $i = 1; foreach($icons as $icon) {
                                    if (! $icon['disable']) {
                                        $icon_data_attr .= ' data-icon-' . $i . '="' . $icon['x_pos'] . ' ' . $icon['y_pos'] . '"';
                                    }
                                    $i++;
                                }

                                if ($icon_data_attr != '') { ?>
                                    <div class="js-reg-map-icons-data d-none" data-term-id="<?php echo $reg->term_id; ?>" <?php echo $icon_data_attr; ?>></div>
                                <?php }
                            } 
                        }
                    ?>

                    <div class="logo-icon js-reg-map-icon js-reg-map-icon-1"></div>
                    <div class="logo-icon js-reg-map-icon js-reg-map-icon-2"></div>
                    <div class="logo-icon js-reg-map-icon js-reg-map-icon-3"></div>
                    <div class="logo-icon js-reg-map-icon js-reg-map-icon-4"></div>
                    <div class="logo-icon js-reg-map-icon js-reg-map-icon-5"></div>
                    <div class="logo-icon js-reg-map-icon js-reg-map-icon-6"></div>
                    <div class="logo-icon js-reg-map-icon js-reg-map-icon-7"></div>
                    <div class="logo-icon js-reg-map-icon js-reg-map-icon-8"></div>
                    <div class="logo-icon js-reg-map-icon js-reg-map-icon-9"></div>

                </div>
                <div class="regions__text js-hidden | col-lg-5">
                    <p class="clockwise-in | fw-300 text-white text-upper"><?php _e('Clockwise in', 'clockwise'); ?>:</p>
                    <select name="select-region" class="selectric-transparent selectric-transparent--white js-select-region js-selectric" id="select-region">
                        <?php $i = 1; foreach($regions as $reg) : ?>
                            <option value="<?php echo $reg->term_id; ?>" <?php if ($i == 1) { echo 'selected'; } ?>><?php echo $reg->name; ?></option>
                        <?php $i++; endforeach; ?>
                    </select>
                    <div class="u-rel">
                        <?php $i = 1; foreach($regions as $reg) : ?>
                            <div class="regions__locations js-regions-locations <?php if ($i == 1) { echo 'is-active'; } ?>" data-term-id="<?php echo $reg->term_id; ?>" data-url="<?php echo get_term_link($reg->term_id); ?>">
                                <?php 
                                    $locations = get_locations_by_region($reg->term_id);
                        
                                    $j = 1; foreach($locations as $loc) : 
                                        if ($j > 10) { break; }
                                        $coming_soon = (get_field('location_status', $loc) == 'coming_soon') ? false : true;
                                        ?>
                                            <a class="location js-locations-link | text-white d-flex align-items-center" href="<?php echo get_the_permalink($loc); ?>" title="<?php echo get_the_title($loc); ?>">
                                                <?php 
                                                    echo get_the_title($loc); 
                                                    if ($coming_soon) : ?>
                                                        <span class="text-upper"><?php _e('Coming soon', 'clockwise'); ?></span>
                                                    <?php endif;
                                                ?>
                                            </a>
                                        <?php 
                                    $j++; endforeach;
                                ?>
                            </div>
                        <?php $i++; endforeach; ?>
                    </div>
                    
                    <a href="<?php echo get_term_link($regions[0]); ?>" class="js-all-locations-link c-inline-link c-inline-link--white c-inline-link--arrow text-white"><?php pll_e('All locations'); ?></a>
                </div>
            </div>
        </div>
        <div class="regions__nav | text-white d-none d-lg-block">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-10 d-flex justify-content-between">
                        <?php $i = 1; foreach($regions as $reg) : ?>
                            <a class="js-regions-link <?php if ($i == 1) { echo 'is-active'; } ?> | fw-500" href="#" data-term-id="<?php echo $reg->term_id; ?>" data-barba-prevent><?php echo $reg->name; ?></a>
                        <?php $i++; endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>