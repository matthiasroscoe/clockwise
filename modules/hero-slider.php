<?php 
    $slider_active = (count($items) >= 4) ? true : false; 
    $topbar_active = (get_field('enable_topbar', 'option')) ? 'topbar-active' : '';
?>

<section class="hero-slider module module-<?php echo $mod_num; ?>">
    <div class="hero-slider__main js-hero-slider slick-hide-load">
        <?php $i = 1; foreach($items as $item) : ?>
            <div class="hero-slide js-matchHeight | <?php if ($i == 1) { echo 'is-active'; } ?>" data-slide="<?php echo $i; ?>">
                
                <?php if ($item['mobile_image']) : 
                    $desktop_class = 'd-none d-md-block'; $mobile_class = 'd-md-none'; ?>
                    <img src="<?php echo $item['mobile_image']['sizes']['cw_medium']; ?>" alt="<?php echo $item['heading']; ?>" class="u-fluid <?php echo $mobile_class; ?>" loading="lazy">
                    <img srcset="<?php echo generate_srcset($item['desktop_image']['sizes']); ?>" src="<?php echo $item['desktop_image']['sizes']['hero']; ?>" alt="<?php echo $item['heading']; ?>" class="u-fluid <?php echo $desktop_class; ?>" loading="lazy">
                <?php else : ?>
                    <img srcset="<?php echo generate_srcset($item['desktop_image']['sizes']); ?>" src="<?php echo $item['desktop_image']['sizes']['hero']; ?>" alt="<?php echo $item['heading']; ?>" class="u-fluid" loading="lazy">
                <?php endif; ?>

                <div class="hero-slider__overlay | u-fluid"></div>

                <div class="container-lg u-h100 u-rel">
                    <div class="row u-h100">
                        <div class="col-lg-8 col-xl-7 ml-lg-5 u-h100">
                            <div class="details <?php echo $topbar_active; ?> | u-h100 d-flex flex-column align-items-start">
                                <?php if ($item['subheading']) : ?>
                                    <p class="subheading | fw-300 text-white text-upper"><?php echo $item['subheading']; ?></p>
                                <?php endif; ?>

                                <h1 class="heading | text-white"><?php echo $item['heading']; ?></h1>

                                <?php if ($item['description']) : ?>
                                    <div class="description | text-white"><?php echo $item['description']; ?></div>
                                <?php endif; ?>
                                
                                <div class="flex-fill d-flex flex-row align-items-end align-items-lg-start justify-content-between u-w100">
                                    <?php 
                                        $btn_data = array(
                                            'button_type' => 'link',
                                            'link' => array(
                                                'title' => pll__('Read more'),
                                                'url' => $item['link'],
                                                'target' => '',
                                            )
                                        );
                                        echo get_button(null, null, null, $btn_data);
                                    ?>

                                    <div class="slick-arrows | d-flex d-lg-none justify-content-between align-items-center mb-3 ml-4">
                                        <img src="<?php echo get_icon('arrow-simple--white.svg'); ?>" class="arrow arrow--prev js-slick-prev" loading="lazy" alt="arrow">
                                        <img src="<?php echo get_icon('arrow-simple--white.svg'); ?>" class="arrow arrow--next js-slick-next" loading="lazy" alt="arrow">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php $i++; endforeach; ?>
    </div>

    <?php if ($slider_active) : ?>
        <div class="hero-slider__thumbs | d-none d-lg-block">

            <div class="js-hero-thumbs slick-hide-load" data-num-slides="<?php echo count($items) - 1; ?>">
                <?php 
                // Move first item to end of array.
                $first_item = array_shift($items);
                $items[] = $first_item;
    
                // Display thumbnail slider
                foreach($items as $item) : ?>
                    <a class="thumb | u-rel d-block" href="<?php echo $item['link']; ?>" title="<?php echo $item['heading']; ?>">
                        <img src="<?php echo $item['mobile_image']['sizes']['cw_small']; ?>" alt="<?php echo $item['heading']; ?>" class="u-fluid" loading="lazy">
                        <div class="details | u-rel u-h100 d-flex justify-content-between align-items-end">
                            <p class="heading <?php if ($item['post_type'] == 'event') { echo 'heading--event'; } ?> | mb-0 u-rel fw-500 text-white"><?php echo $item['heading']; ?></p>
                            <p class="time | mb-0 u-rel text-white text-right"><?php echo $item['time_since_published']; ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</section>