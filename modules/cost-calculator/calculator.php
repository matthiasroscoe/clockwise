<?php 
// Get all locations that have data for calculator added
$locations_in_calculator = get_posts(array(
    'post_type' => 'location',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'fields' => 'ids',
    'orderby' => 'title',
    'order' => 'ASC',
    'meta_query' => array(
        array(
            'key' => 'is_in_calculator',
            'value' => true,
            'compare' => 'IN',
        )
    )
));

// Get regions available for calculator
$regions_in_calculator = array();
foreach($locations_in_calculator as $loc) {
    $term = get_the_terms($loc, 'regions')[0];
    if ($term->parent == 0) {
        $term_id = $term->term_id;
        if (! in_array($term_id, $regions_in_calculator)) {
            $regions_in_calculator[$term_id] = $term->name;
        }
    }
}
asort($regions_in_calculator);
?>

<section class="calculator module module-<?php echo $mod_num; ?>">
    <div class="calculator__filter">
        <div class="container-lg">
            <div class="row justify-content-center">
                <div class="calculator__headings | col-lg-10 pl-lg-0">
                    <?php if ($m['calc_heading']) : ?>
                        <h2 class="text-white"><?php echo $m['calc_heading']; ?></h2>
                    <?php endif; ?>

                    <?php if ($m['calc_subheading']) : ?>
                        <p class="calculator__subheading | text-white mb-0"><?php echo $m['calc_subheading']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="row justify-content-center">   
                <div class="col-lg-10 p-0">
                    <div class="c-filter | d-flex flex-column flex-lg-row justify-content-lg-between">
                        <div class="c-filter__options | d-flex flex-column flex-lg-row flex-wrap align-items-stretch align-items-lg-center justify-content-lg-between">
                            <div class="c-filter__dropdown c-filter__dropdown--region">
                                <label><?php pll_e('Region'); ?>*</label>
                                <select id="calc-regions" class="js-selectric js-calc-regions">
                                    <option value="" disabled selected><?php pll_e('Select region'); ?></option>
                                    <?php // Regions
                                        $i = 1; foreach($regions_in_calculator as $key => $val) { ?>
                                            <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                        <?php $i++; }
                                    ?>
                                </select>
                            </div>
        
                            <div class="c-filter__dropdown">
                                <label><?php pll_e('Location'); ?>*</label>
                                <select id="calc-locations" class="js-selectric js-calc-locations js-loc-dropdown-update" data-locations="<?php echo $locations_in_calculator; ?>">
                                    <option value="" selected disabled><?php pll_e('Select location'); ?></option>
                                    <?php // Locations
                                        foreach($locations_in_calculator as $loc) { ?>
                                            <option value="<?php echo $loc; ?>"><?php echo get_the_title($loc); ?></option>
                                        <?php }
                                    ?>
                                </select>
                            </div>
        
                            <div class="c-filter__dropdown c-filter__dropdown--num-people | u-rel">
                                <label><?php pll_e('No. of people'); ?>*</label>
                                <p class="max-people | mb-0 text-white"><?php pll_e('Max 30 people'); ?></p>
                                <select id="calc-num-people" class="js-selectric js-num-people">
                                    <?php for ($i=1; $i <= 30; $i++) : ?>
                                        <option value="<?php echo $i; ?>" <?php if ($i == 10) { echo 'selected'; } ?> ><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="c-filter__dropdown c-filter__dropdown--time-period">
                                <label><?php pll_e('Time period'); ?>*</label>
                                <select id="calc-time-period" class="js-selectric js-time-period">
                                    <option value="1">1 <?php pll_e('year'); ?></option>
                                    <option value="2">2 <?php pll_e('years'); ?></option>
                                    <option value="3">3 <?php pll_e('years'); ?></option>
                                </select>
                            </div>
                        </div>
        
                        <div class="c-filter__actions text-center">
                            <?php 
                                $btn_data = array(
                                    'button_type' => 'custom',
                                    'title' => pll__('Proceed'),
                                    'class' => 'js-calc-open',
                                    'data_attr' => 'id="cost-calculator-open"',
                                );
                                echo get_button(null, null, null, $btn_data);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-lg-10 pl-lg-0">
                <div class="c-filter__reset | text-right">
                    <a href="#" class="js-calc-filter-reset | u-rel d-inline-block text-upper text-white" data-barba-prevent><?php pll_e('Reset filter'); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>