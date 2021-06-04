<?php
// Clockwise data
$cw_data = get_field('cw_costs', 'option');

// Trad Model data, year 1/2/3
$tmc_1 = get_field('tmc_year1', 'option');
$tmc_2 = get_field('tmc_year2', 'option');
$tmc_3 = get_field('tmc_year3', 'option');
?>

<section class="graph module module-<?php echo $mod_num; ?>">

    <div class="container-lg graph--desktop">
        <div class="row justify-content-center">
            <div class="graph__intro js-hidden | col-lg-9 col-xxl-8 text-center mb-5">
                <?php if ($m['heading']) : ?>
                    <h1><?php echo $m['heading']; ?></h1>
                <?php endif; ?>
                
                <?php if ($m['text']) : ?>
                    <p class="mb-1"><?php echo $m['text']; ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="row d-lg-none">
            <div class="col-12 d-flex">
                <div class="graph__tabs d-flex u-w100">
                    <div class="js-graph-tab tab is-active" data-year="1"><?php pll_e('Year'); ?> 1</div>
                    <div class="js-graph-tab tab" data-year="2"><?php pll_e('Year'); ?> 2</div>
                    <div class="js-graph-tab tab" data-year="3"><?php pll_e('Year'); ?> 3</div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="graph__inner js-graph | d-flex align-items-stretch justify-content-center">
                
                <div class="y-axis">
                    <p class="axis-title axis-title--y text-upper m-0"><?php pll_e('Annual Expenditure'); ?></p>
                    <div class="labels">
                        <?php // Y-axis labels
                            $y_axis_total = get_field('y_axis_total', 'option');

                            for ($i=6; $i >= 1; $i--) { 
                                $label_val = format_currency(($y_axis_total / 6) * $i);
                                ?>
                                <p class="label m-0">£<?php echo $label_val; ?></p>
                            <?php }
                        ?>
                        <p class="label m-0">£0</p>
                    </div>
                </div>
                
                <div class="bars | u-rel">
                    <div class="bars__inner | d-flex justify-content-between align-items-stretch u-rel">

                        <div class="year year--1">
                            <div class="column column--cw">
                                <div class="bar js-mob-bar-1 bar--1">
                                    <div class="bar-section js-serv-util js-cw-year-1" style="height: <?php echo get_bar_section_height($cw_data['year_1']); ?>%" data-height="<?php echo get_bar_section_height($cw_data['year_1']); ?>"></div>
                                </div>
                                <p class="text">Clockwise</br><span class="d-lg-none"><?php echo pll_e('Model'); ?></span><span class="d-none d-lg-inline"><?php echo pll_e('Year'); ?> 1</span></p>
                            </div>
    
                            <div class="column column--tm">
                                <div class="bar js-mob-bar-2 bar--2">
                                    <div class="bar-section js-rent js-year-1" style="height: <?php echo get_bar_section_height($tmc_1['rent']); ?>%" data-height="<?php echo get_bar_section_height($tmc_1['rent']); ?>"></div>
                                    <div class="bar-section js-serv-util js-year-1" style="height: <?php echo get_bar_section_height($tmc_1['serv_util']); ?>%" data-height="<?php echo get_bar_section_height($tmc_1['serv_util']); ?>"></div>
                                    <div class="bar-section js-capex js-year-1" style="height: <?php echo get_bar_section_height($tmc_1['capex']); ?>%" data-height="<?php echo get_bar_section_height($tmc_1['capex']); ?>"></div>
                                </div>
                                <p class="text">Traditional</br><span class="d-lg-none"><?php echo pll_e('Model'); ?></span><span class="d-none d-lg-inline"><?php echo pll_e('Year'); ?> 1</span></p>
                            </div>
                        </div>
    
                        <div class="year year--2 d-none d-lg-flex">
                            <div class="column column--cw">
                                <div class="bar bar--3">
                                    <div class="bar-section js-serv-util js-cw-year-2" style="height: <?php echo get_bar_section_height($cw_data['year_2']); ?>%" data-height="<?php echo get_bar_section_height($cw_data['year_2']); ?>"></div>
                                </div>
                                <p class="text">Clockwise</br><span class="d-lg-none"><?php echo pll_e('Model'); ?></span><span class="d-none d-lg-inline"><?php echo pll_e('Year'); ?> 2</span></p>
                            </div>
    
                            <div class="column column--tm">
                                <div class="bar bar--4">
                                    <div class="bar-section js-rent js-year-2" style="height: <?php echo get_bar_section_height($tmc_2['rent']); ?>%" data-height="<?php echo get_bar_section_height($tmc_2['rent']); ?>"></div>
                                    <div class="bar-section js-serv-util js-year-2" style="height: <?php echo get_bar_section_height($tmc_2['serv_util']); ?>%" data-height="<?php echo get_bar_section_height($tmc_2['serv_util']); ?>"></div>
                                    <div class="bar-section js-capex js-year-2" style="height: <?php echo get_bar_section_height($tmc_2['capex']); ?>%" data-height="<?php echo get_bar_section_height($tmc_2['capex']); ?>"></div>
                                </div>
                                <p class="text">Traditional</br><span class="d-lg-none"><?php echo pll_e('Model'); ?></span><span class="d-none d-lg-inline"><?php echo pll_e('Year'); ?> 2</span></p>
                            </div>
                        </div>
    
                        <div class="year year--3 d-none d-lg-flex">
                            <div class="column column--cw">
                                <div class="bar bar--5">
                                    <div class="bar-section js-serv-util js-cw-year-3" style="height: <?php echo get_bar_section_height($cw_data['year_3']); ?>%" data-height="<?php echo get_bar_section_height($cw_data['year_3']); ?>"></div>
                                </div>
                                <p class="text">Clockwise</br><span class="d-lg-none"><?php echo pll_e('Model'); ?></span><span class="d-none d-lg-inline"><?php echo pll_e('Year'); ?> 3</span></p>
                            </div>
    
                            <div class="column column--tm">
                                <div class="bar bar--6">
                                    <div class="bar-section js-rent js-year-3" style="height: <?php echo get_bar_section_height($tmc_3['rent']); ?>%" data-height="<?php echo get_bar_section_height($tmc_3['rent']); ?>"></div>
                                    <div class="bar-section js-serv-util js-year-3" style="height: <?php echo get_bar_section_height($tmc_3['serv_util']); ?>%" data-height="<?php echo get_bar_section_height($tmc_3['serv_util']); ?>"></div>
                                    <div class="bar-section js-capex js-year-3" style="height: <?php echo get_bar_section_height($tmc_3['capex']); ?>%" data-height="<?php echo get_bar_section_height($tmc_3['capex']); ?>"></div>
                                </div>
                                <p class="text">Traditional</br><span class="d-lg-none"><?php echo pll_e('Model'); ?></span><span class="d-none d-lg-inline"><?php echo pll_e('Year'); ?> 3</span></p>
                            </div>
                        </div>
                    </div>

                    <p class="axis-title axis-title--x text-center text-upper"><?php pll_e('Model Type'); ?></p>
                    <p class="explanation-text | text-center d-none d-lg-block"><?php echo get_field('costs_explanation', 'option'); ?></p>

                    <div class="key | d-flex flex-row flex-lg-column">
                        <p class="title | fw-500 text-upper d-none d-lg-block"><?php pll_e('Key'); ?></p>
                        <p class="item rent"><?php pll_e('Rent'); ?></p>
                        <p class="item serv-util"><?php pll_e('Services & Utilities'); ?></p>
                        <p class="item capex"><?php pll_e('Capital Outlay'); ?></p>
                    </div>
                </div>
                
            </div>
        </div>

        <?php if ($m['button']) : ?>
            <div class="row">
                <div class="col-12 | d-flex flex-center mt-4">
                    <?php echo get_button(null, null, null, $m['button']); ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>