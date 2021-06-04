<?php 
    $regions = get_terms(array(
        'taxonomy' => 'regions',
        'parent' => 0,
    ));
?>

<section class="location-index module module-<?php echo $mod_num; ?>">
    <div class="container-lg">

        <div class="row justify-content-center">    
            <div class="location-index__heading | col-lg-8">
                <h1 class="text-center"><?php pll_e('Location Index'); ?></h1>
                <p class="d-lg-none text-upper"><?php pll_e('Clockwise in'); ?>:</p>
            </div>

            <div class="location-index__filter | d-none d-lg-block col-lg-11 col-xl-10 col-xxl-8">
                <div class="c-pills">
                    <p class="c-pills__heading | text-center"><?php pll_e('Clockwise in'); ?>:</p>
                    <div class="c-pills__inner | d-flex justify-content-center align-items-center">
                        <?php $i = 1; foreach($regions as $reg) : ?>
                            <a href="#" class="c-pill js-loc-index-pill <?php if ($i == 1) { echo 'is-active'; } ?>" title="<?php echo $reg->name; ?>" data-term-id="<?php echo $reg->term_id; ?>" data-barba-prevent><?php echo $reg->name; ?></a>
                        <?php $i++; endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    
        <?php $i = 1; foreach($regions as $reg) : ?>
            <div class="<?php if ($i == 1) { echo 'is-first'; } ?> row">
                <div class="c-accordion js-loc-index-accordion | d-flex align-items-center justify-content-between d-lg-none col-12" data-term-id="<?php echo $reg->term_id; ?>">
                    <h2 class="c-accordion__title"><?php echo $reg->name; ?></h2>
                    <div class="c-accordion__toggle">
                        <span class="line"></span>
                        <span class="line line-2"></span>
                    </div>
                </div>
                <div class="location-index__posts js-loc-index-posts <?php if ($i == 1) { echo 'is-first'; } ?> | u-w100 d-flex flex-wrap" data-term-id="<?php echo $reg->term_id; ?>">
                    <?php 
                        $locations = get_locations_by_region($reg->term_id);
                        foreach($locations as $loc) {
                            echo get_location_card($loc, 'contact');
                        }
                    ?>
                </div>
            </div>
        <?php $i++; endforeach; ?>

    </div>
</section>