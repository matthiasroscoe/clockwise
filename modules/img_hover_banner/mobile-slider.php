<?php $num_slides = count($items); ?>

<section class="hov-banner-mob js-hidden | d-lg-none module-<?php echo $mod_num; ?>">

    <?php if ($m['heading'] && $m['content_type']) : ?>
        <div class="container-lg mb-4">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="mb-0"><?php echo $m['heading']; ?></h1>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="hov-banner-mob__inner js-hover-banner-slider slick-hide-load-mobile | pr-0">

        <?php $i = 1; foreach($items as $item) : ?>
            <div class="hov-banner-mob__slide">
                <div class="hov-banner-mob__slide-inner | u-rel">
                    <img class="hov-banner-mob__bg js-hover-banner-bg | u-fluid" src="<?php echo $item['mobile_image']; ?>" alt="<?php echo $item['heading']; ?>" loading="lazy">
                    <div class="hov-banner-mob__text | u-rel">
                        <h2 class="slide__title | text-white text-upper"><?php echo $item['heading']; ?></h2>
                        <?php if ($item['link']) : ?>
                            <a href="<?php echo $item['link']; ?>" target="<?php echo $item['link_target']; ?>" class="c-inline-link c-inline-link--arrow c-inline-link--white"><?php pll_e('Learn more'); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php $i++; endforeach; ?>

    </div>

    <div class="hov-banner-mob__counter | d-flex justify-content-between align-items-center mt-3">
        <div class="d-flex align-items-center">
            <span class="js-current-slide pr-2">01</span>
            <span class="line"></span>
            <span class="js-total-slides">0<?php echo $num_slides; ?></span>
        </div>
        <?php $locations_page = pll_get_post('860', pll_current_language()); ?>
        <a href="<?php echo get_permalink($locations_page); ?>" class="c-inline-link c-inline-link--arrow mr-4"><?php pll_e('All locations'); ?></a>
    </div>
</section>