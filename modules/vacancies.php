<section class="vacancies module module-<?php echo $mod_num; ?>">
    
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <h1 class="vacancies__heading | text-center"><?php pll_e('Vacancies'); ?></h1>
            </div>
        </div>

        <div class="row mx-lg-0">
            <div class="col-12 px-0">
                <div class="c-filter | d-flex flex-column flex-lg-row justify-content-lg-between">
                    
                    <div class="c-filter__options | d-flex flex-column flex-lg-row flex-wrap align-items-stretch align-items-lg-center justify-content-lg-between">
                        <!-- <div class="c-filter__dropdown">
                            <label><?php pll_e('Region'); ?>:</label>
                            <select id="vacancy-regions" class="js-selectric js-vacancy-regions js-reg-dropdown-update">
                                <option value="" selected disabled><?php pll_e('Select region'); ?></option>
                                <option value="all"><?php pll_e('All regions'); ?></option>
                                <?php // Regions
                                    $regions = get_terms(array(
                                        'taxonomy' => 'regions',
                                        'parent' => 0,
                                        'orderby' => 'title',
                                        'order' => 'ASC',
                                    ));
                                    foreach($regions as $reg) { ?>
                                        <option value="<?php echo $reg->term_id; ?>"><?php echo $reg->name; ?></option>
                                    <?php }
                                ?>
                            </select>
                        </div> -->

                        <div class="c-filter__dropdown">
                            <label><?php pll_e('Location'); ?>:</label>
                            <select id="vacancy-locations" class="js-selectric js-vacancy-locations js-loc-dropdown-update">
                                <option value="" selected disabled><?php pll_e('Select location'); ?></option>
                                <option value="all"><?php pll_e('All locations'); ?></option>
                                <?php // Locations
                                    $locations = get_terms(array(
                                        'taxonomy' => 'job-location',
                                        'parent' => 0,
                                        'orderby' => 'title',
                                        'order' => 'ASC',
                                    ));
                                    foreach($locations as $loc) { ?>
                                        <option value="<?php echo $loc->term_id; ?>"><?php echo $loc->name; ?></option>
                                    <?php }
                                ?>
                            </select>
                        </div>
                        
                        <div class="c-filter__dropdown">
                            <label><?php pll_e('Job type'); ?>:</label>
                            <select id="vacancy-job-types" class="js-selectric js-vacancy-job-types">
                                <option value="" selected disabled><?php pll_e('Select a job type'); ?></option>
                                <option value="all"><?php pll_e('All types'); ?></option>
                                <?php // Regions
                                    $job_types = get_terms(array(
                                        'taxonomy' => 'job-type',
                                        'parent' => 0,
                                        'orderby' => 'title',
                                        'order' => 'ASC',
                                    ));
                                    foreach($job_types as $jt) { ?>
                                        <option value="<?php echo $jt->term_id; ?>"><?php echo $jt->name; ?></option>
                                    <?php }
                                ?>
                            </select>
                        </div>

                        <div class="c-filter__dropdown">
                            <label><?php pll_e('Sort by'); ?>:</label>
                            <select id="vacancy-sort-by" class="js-selectric js-sort-by">
                                <option value="date" selected><?php pll_e('Most recently added'); ?></option>
                                <option value="a-z"><?php pll_e('Alphabetically'); ?></option>
                            </select>
                        </div>
                    </div>

                    <div class="c-filter__actions">
                        <a class="c-filter__submit js-vacancies-filter-submit | d-block d-lg-flex justify-content-lg-center align-items-lg-center text-upper text-center" href="#" data-barba-prevent><?php pll_e('Search'); ?></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="c-filter__reset | col-12 text-right">
                    <a href="#" class="js-vacancies-filter-reset | u-rel d-inline-block text-upper" data-barba-prevent><?php pll_e('Reset filter'); ?></a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-lg">
        <div class="js-vacancies-grid | row">
            <?php // TODO load more vacancies
                $args = array(
                    'post_type' => 'job_vacancy',
                    'posts_per_page' => '-1',
                    'post_status' => 'publish',
                    'fields' => 'ids',
                );

                $posts = get_posts($args);

                foreach($posts as $post) {
                    echo get_vacancy_card($post);
                }
            ?>
        </div>
    </div>

</section>