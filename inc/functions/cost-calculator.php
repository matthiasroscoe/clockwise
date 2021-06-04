<?php 

/**
 * Gets calculator data from ACF options page data
 * Calculations based on client's Flexible vs Traditional google sheet:
 * https://docs.google.com/spreadsheets/d/1eynZm9oZEKiwMxk0mfkk_y7VJDwXGRWLuzN47CBQJ84/edit#gid=1001259963
 */

function get_cost_calculator_data($loc_id = null, $people = 1, $years = 1) {
    if ($loc_id == null) {
        return false;
    }

    $rent = get_field('rent', $loc_id);
    $rates = get_field('rates', $loc_id);
    $desk_rate = get_field('desk_rate', $loc_id);
    $months = $years * 12;

    // Get total space required (in sq ft). Figure used as the basis for most calculations.
    // 600 sq ft is the space required for 1 person. Every subsequent person adds an extra 50 sq ft
    $space = 600 + (($people - 1) * 50);
    if ($people >= 24) {
        $space += 100;
    }

    
    /**
     * Get traditional model setup costs
     */

    $fit_out_costs = (40 * $space) / $months;
    $furniture_costs = (10 * $space) / $months;
    $dilapidations = (12 * $space) / $months;
    $transaction_cost = 5000 / $months;

    $setup_costs_per_month = $fit_out_costs + $furniture_costs + $dilapidations + $transaction_cost;
    $setup_costs = $setup_costs_per_month * $months;


    /**
     * Get traditional model operating costs
     */

    $tm_rent = ($rent * $space) / 12;
    $tm_rates = ($rates * $space) / 12;

    $tm_utility = (4 * $space) / 12;
    $tm_cleaning = (3 * $space) / 12;

    $tm_reception_staff = (12 * $space) / 12;
    $tm_repairs_maintenance = (3 * $space) / 12;
    $other_fees = (2 * $space) / 12;

    // Get total traditional model operating costs both per month and over the full period
    $total_op_costs_per_month = $tm_rent + $tm_rates + $tm_utility + $tm_reception_staff + $tm_repairs_maintenance + $tm_cleaning + $other_fees;
    $total_op_costs = $total_op_costs_per_month * $months;


    /** 
     * Get traditional model total costs
     */

    $tm_total_costs_per_month = $setup_costs_per_month + $total_op_costs_per_month;
    $tm_total_costs = $setup_costs + $total_op_costs;

    
    /**
     * Get clockwise costs
     */

    $cw_rent_per_month = $desk_rate * $people;
    $cw_meeting_room_hire = (25 * $people / 2 * 52) / 12;
    // $total_rent = $rent_per_month * $months;
    $cw_total_costs_per_month = $cw_rent_per_month + $cw_meeting_room_hire;
    $cw_total_costs = $cw_total_costs_per_month * $months;


    /**
     * Get total savings
     */

    $total_savings = $tm_total_costs - $cw_total_costs;
    $savings_percentage = 100 - ($cw_total_costs / $tm_total_costs) * 100;


    /**
     * Package data
     */

    $data = array(
        'years' => $years,
        'people' => $people,
        'location' => get_the_title($loc_id),
        'setup_costs' => array(
            'per_month' => number_format($setup_costs_per_month),
            'total' => number_format($setup_costs),
            'transaction' => number_format($transaction_cost),
            'fit_out' => number_format($fit_out_costs),
            'furniture' => number_format($furniture_costs),
            'dilapidations' => number_format($dilapidations),
        ),
        'operating_costs' => array(
            'rent' => number_format($tm_rent),
            'business_rates' => number_format($tm_rates),
            'utility_costs' => number_format($tm_utility),
            'reception_staff' => number_format($tm_reception_staff),
            'repairs_maintenance' => number_format($tm_repairs_maintenance),
            'cleaning' => number_format($tm_cleaning),
            'other_fees' => number_format($other_fees),
            'total_per_month' => number_format($total_op_costs_per_month),
            'total' => number_format($total_op_costs),
        ),
        'tm_total_costs' => array(
            'per_month' => number_format($tm_total_costs_per_month),
            'total' => number_format($tm_total_costs),
        ),
        'clockwise_costs' => array(
            'desk_rate_per_month' => number_format($desk_rate),
            'meeting_room_hire' => number_format($cw_meeting_room_hire),
            'rent_per_month' => number_format($cw_rent_per_month),
            'total_costs_per_month' => number_format($cw_total_costs_per_month),
            'total_costs' => number_format($cw_total_costs)
        ),
        'savings' => array(
            'total_savings' => number_format($total_savings),
            'savings_percentage' => round($savings_percentage),
        )
    );

    return $data;
}


/**
 * Get cost calculator inner content
 * Uses the data from  and generates the modal content
 */

add_action('wp_ajax_nopriv_get_cost_calculator_content', 'get_cost_calculator_content');
add_action('wp_ajax_get_cost_calculator_content', 'get_cost_calculator_content');

function get_cost_calculator_content() {
    $loc_id = (isset($_POST['location'])) ? $_POST['location'] : null;
    $people = (isset($_POST['num_people'])) ? $_POST['num_people'] : null;
    $years = (isset($_POST['num_years'])) ? $_POST['num_years'] : null;

    if ($loc_id && $years && $people) {
        $data = get_cost_calculator_data($loc_id, $people, $years);
    
        ob_start();
        ?>
            <div class="c-calc-modal__costs js-calc-content c-calc-modal__content | container-lg u-rel">
                <div class="row justify-content-lg-center ">

                    <?php // Left hand side column ?>
                    <div class="header-col d-none d-lg-block">
                        
                        <div class="header-col__setup-costs">
                            <a href="#" class="new-search js-modal-close d-none d-lg-block | text-upper" data-barba-prevent>< <?php pll_e('New Search'); ?></a>
                            <div class="subheading">
                                <h3><?php pll_e('Setup Costs'); ?></h3>
                            </div>
                            <p class="item"><?php pll_e('Transaction costs'); ?></p>
                            <p class="item"><?php pll_e('Fit out'); ?></p>
                            <p class="item"><?php pll_e('Furniture'); ?></p>
                            <p class="item"><?php pll_e('Dilapidations'); ?></p>
                        </div>

                        <div class="header-col__op-costs">
                            <div class="subheading">
                                <h3><?php pll_e('Operating Costs'); ?></h3>
                            </div>
                            <p class="item"><?php pll_e('Rent'); ?></p>
                            <p class="item"><?php pll_e('Meeting room hire'); ?></p>
                            <p class="item"><?php pll_e('Business rates'); ?></p>
                            <p class="item"><?php pll_e('Utility costs'); ?></p>
                            <p class="item"><?php pll_e('Reception staff'); ?></p>
                            <p class="item"><?php pll_e('Repairs and maintenance'); ?></p>
                            <p class="item"><?php pll_e('Cleaning'); ?></p>
                            <p class="item"><?php pll_e('Other fees'); ?></p>
                        </div>
                    </div>

                    <?php // Traditional Model column ?>
                    <div class="content-col traditional js-setup-content is-active" data-type="traditional">
                        <h2 class="heading | d-none d-lg-block fw-500"><?php pll_e('Traditional leases'); ?></h2>
                        
                        <div class="content-col__top | u-rel">
                            <h2 class="heading | d-lg-none fw-500"><?php pll_e('Setup Costs'); ?></h2>
                            <div class="box">
                                <div class="item">
                                    <p class="d-lg-none"><?php pll_e('Transaction costs'); ?></p>
                                    <h2>£<?php echo $data['setup_costs']['transaction']; ?></h2>
                                </div>
                                <div class="item">
                                    <p class="d-lg-none"><?php pll_e('Fit out'); ?></p>
                                    <h2>£<?php echo $data['setup_costs']['fit_out']; ?></h2>
                                </div>
                                <div class="item">
                                    <p class="d-lg-none"><?php pll_e('Furniture'); ?></p>
                                    <h2>£<?php echo $data['setup_costs']['furniture']; ?></h2>
                                </div>
                                <div class="item">
                                    <p class="d-lg-none"><?php pll_e('Dilapidations'); ?></p>
                                    <h2>£<?php echo $data['setup_costs']['dilapidations']; ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="content-col__bottom">
                            <h2 class="heading | d-lg-none fw-500"><?php pll_e('Operating Costs'); ?></h2>
                            <div class="box">
                                <div class="item">
                                    <p class="d-lg-none"><?php pll_e('Rent'); ?></p>
                                    <h2>£<?php echo $data['operating_costs']['rent']; ?></h2>
                                </div>
                                <div class="item">
                                    <p class="d-lg-none"><?php pll_e('Meeting room hire'); ?></p>
                                    <h2 class="included"><?php pll_e('Included'); ?></h2>
                                </div>
                                <div class="item">
                                    <p class="d-lg-none"><?php pll_e('Business rates'); ?></p>
                                    <h2>£<?php echo $data['operating_costs']['business_rates']; ?></h2>
                                </div>
                                <div class="item">
                                    <p class="d-lg-none"><?php pll_e('Utility costs'); ?></p>
                                    <h2>£<?php echo $data['operating_costs']['utility_costs']; ?></h2>
                                </div>
                                <div class="item">
                                    <p class="d-lg-none"><?php pll_e('Reception staff'); ?></p>
                                    <h2>£<?php echo $data['operating_costs']['reception_staff']; ?></h2>
                                </div>
                                <div class="item">
                                    <p class="d-lg-none"><?php pll_e('Repairs and maintenance'); ?></p>
                                    <h2>£<?php echo $data['operating_costs']['repairs_maintenance']; ?></h2>
                                </div>
                                <div class="item">
                                    <p class="d-lg-none"><?php pll_e('Cleaning'); ?></p>
                                    <h2>£<?php echo $data['operating_costs']['cleaning']; ?></h2>
                                </div>
                                <div class="item">
                                    <p class="d-lg-none"><?php pll_e('Other fees'); ?></p>
                                    <h2>£<?php echo $data['operating_costs']['other_fees']; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php // Flexible model column ?>
                    <div class="content-col flexible js-setup-content" data-type="flexible">
                        <h2 class="heading | d-none d-lg-block fw-500"><?php pll_e('Flexible office'); ?></h2>
                        
                        <div class="content-col__top content-col__bg-navy | u-rel">
                            <h2 class="heading | d-lg-none fw-500"><?php pll_e('Setup Costs'); ?></h2>
                            
                            <div class="box d-none d-lg-block">
                                <div class="item">
                                    <h2 class="included"><?php pll_e('Included'); ?></h2>
                                </div>
                                <div class="item">
                                    <h2 class="included"><?php pll_e('Included'); ?></h2>
                                </div>
                                <div class="item">
                                    <h2 class="included"><?php pll_e('Included'); ?></h2>
                                </div>
                                <div class="item">
                                    <h2 class="included"><?php pll_e('Included'); ?></h2>
                                </div>
                            </div>

                            <div class="box box--included d-lg-none">
                                <h2 class="text-white m-0"><?php pll_e('All-inclusive'); ?></h2>
                            </div>
                        </div>

                        <div class="content-col__bottom content-col__bg-navy">
                            <h2 class="heading | d-lg-none fw-500"><?php pll_e('Operating Costs'); ?></h2>
                            <div class="box">
                                <div class="item">
                                    <p class="d-lg-none"><?php pll_e('Rent'); ?></p>
                                    <h2>£<?php echo $data['clockwise_costs']['rent_per_month']; ?></h2>
                                </div>
                                <div class="item">
                                    <p class="d-lg-none"><?php pll_e('Meeting room hire'); ?></p>
                                    <h2>£<?php echo $data['clockwise_costs']['meeting_room_hire']; ?></h2>
                                </div>
                                <div class="item">
                                    <p class="d-lg-none"><?php pll_e('Business rates'); ?></p>
                                    <h2 class="included"><?php pll_e('Included'); ?></h2>
                                </div>
                                <div class="item">
                                    <p class="d-lg-none"><?php pll_e('Utility costs'); ?></p>
                                    <h2 class="included"><?php pll_e('Included'); ?></h2>
                                </div>
                                <div class="item">
                                    <p class="d-lg-none"><?php pll_e('Reception staff'); ?></p>
                                    <h2 class="included"><?php pll_e('Included'); ?></h2>
                                </div>
                                <div class="item">
                                    <p class="d-lg-none"><?php pll_e('Repairs and maintenance'); ?></p>
                                    <h2 class="included"><?php pll_e('Included'); ?></h2>
                                </div>
                                <div class="item">
                                    <p class="d-lg-none"><?php pll_e('Cleaning'); ?></p>
                                    <h2 class="included"><?php pll_e('Included'); ?></h2>
                                </div>
                                <div class="item">
                                    <p class="d-lg-none"><?php pll_e('Other fees'); ?></p>
                                    <h2 class="included"><?php pll_e('Included'); ?></h2>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <?php // Totals row ?>
            <div class="c-calc-modal__totals js-calc-content c-calc-modal__content | container-lg u-rel">
                <div class="row flex-column flex-lg-row justify-content-lg-center ">
                    
                    <div class="c-calc-modal__totals__header header-col">
                        <div class="totals | d-flex flex-column align-items-start align-items-lg-start justify-content-lg-start">
                            <div class="text">
                                <h2 class="mb-1"><?php pll_e('Total monthly'); ?></h2>
                                <?php if ($data['years'] == '3') : ?>
                                    <p class="mb-3 mb-lg-0"><?php echo pll_e('Including setup costs spread over 36 months'); ?></p>
                                <?php elseif ($data['years'] == '2'): ?>
                                    <p class="mb-3 mb-lg-0"><?php echo pll_e('Including setup costs spread over 24 months'); ?></p>
                                <?php else: ?>
                                    <p class="mb-3 mb-lg-0"><?php echo pll_e('Including setup costs spread over 12 months'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="c-calc-modal__totals__content c-calc-modal__totals__content--traditional content-col js-totals is-active | flex-center flex-column" data-type="traditional">
                        <h2 class="total-per-month | mb-1">£<?php echo $data['tm_total_costs']['per_month']; ?> / <?php pll_e('month'); ?></h2>
                        <p class="total | fw-300 m-0">£<?php echo $data['tm_total_costs']['total']; ?> <?php pll_e('in total'); ?></p>
                    </div>

                    <div class="c-calc-modal__totals__content content-col js-totals c-calc-modal__totals__content--flexible | flex-center flex-column" data-type="flexible">
                        <h2 class="total-per-month | mb-1">£<?php echo $data['clockwise_costs']['total_costs_per_month']; ?> / <?php pll_e('month'); ?></h2>
                        <p class="total | fw-300 m-0">£<?php echo $data['clockwise_costs']['total_costs']; ?> <?php pll_e('in total'); ?></p>
                    </div>

                </div>
            </div>

            <div class="c-calc-modal__savings js-calc-content c-calc-modal__content | mb-lg-5 container-lg">
                <div class="row justify-content-lg-center ">
                    <div class="spacer"></div>
                    <div class="c-calc-modal__savings__inner | col pl-lg-0">
                        <h2 class="mb-lg-2"><?php pll_e('Total savings with a Flexible office:'); echo ' ' . $data['savings']['savings_percentage'] . '%'; ?></h2>
                        <p class="fw-500 mb-5">£<?php echo $data['savings']['total_savings'] . ' ' . pll__('can be saved or invested in building your business!') ?></p>
                        <?php 
                            $btn_data = array(
                                'button_type' => 'form',
                                'button_text' => pll__('Make an enquiry'),
                                'form' => 'enquiry_form',
                            );
                            echo get_button(null, null, null, $btn_data);
                        ?>
                    </div>
                </div>
            </div>
            
            <?php // Get cost calculator data for Hubspot email ?>
            <div class="js-cost-calculator-vars d-none" data-cost-calculator-vars='<?php echo json_encode($data); ?>' data-hubspot-location-name="<?php echo get_field('hubspot_location', $loc_id); ?>"></div>
        <?php
    
        $html = ob_get_clean();
        echo $html;
    } else {
        echo '';
    }
    
    wp_die();
}



/**
 * Update calculator filter locations when regions dropdown is changed
 */

add_action('wp_ajax_nopriv_get_calculator_locations_by_region', 'get_calculator_locations_by_region');
add_action('wp_ajax_get_calculator_locations_by_region', 'get_calculator_locations_by_region');

function get_calculator_locations_by_region() {
    $reg_id = (isset($_POST['region_id'])) ? (int) $_POST['region_id'] : '';

    $args = array(
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
        ),
    );

    if ($reg_id != '') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'regions',
                'terms' => $reg_id,
                'operator' => 'IN'
            )
        );
    }

    $locations = get_posts($args);

    ob_start(); ?>
        
    <option value="" disabled selected><?php pll_e('Select location'); ?></option>
    <?php foreach($locations as $loc) { ?>
        <option value="<?php echo $loc; ?>"><?php echo get_the_title($loc); ?></option>
    <?php }

    $options = ob_get_clean();
    echo $options;
    wp_die();
}
?>