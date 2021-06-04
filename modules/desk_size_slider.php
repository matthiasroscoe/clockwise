<section class="desk-size-slider module module-<?php echo $mod_num; ?> | u-rel">
    <div class="container-lg">
        <?php if ($m['heading']) : ?>
            <div class="row">
                <div class="flex-fill">
                    <h1 class="desk-size-slider__heading js-hidden | text-center"><?php echo $m['heading']; ?></h1>
                    
                    <div class="desk-size-slider__img js-hidden | u-rel">
                        <?php $i = 1; foreach($m['desk_sizes'] as $size) : ?>
                            <img class="u-fluid js-desk-size-img <?php if ($i == 2) { echo 'is-active'; } ?>" src="<?php echo $size['image']['sizes']['cw_small']; ?>" alt="<?php echo $size['image']['alt']; ?>" data-step="<?php echo $i; ?>" loading="lazy">
                        <?php $i++; endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="js-hidden | row align-items-lg-start">
            <div class="desk-size-slider__range | col-lg-4 col-xxl-3 offset-xxl-1 d-flex flex-column flex-lg-row justify-content-lg-between">
                <div class="range-slider | u-rel d-flex flex-column align-items-center">
                    <span class="range-slider__text range-slider__text--large"><?php pll_e('Large'); ?></span>
                    <div class="js-range-slider | flex-grow" data-num-steps="<?php echo count($m['desk_sizes']); ?>"></div>
                    <span class="range-slider__text range-slider__text--small"><?php pll_e('Small'); ?></span>
                </div>
                <div class="desk-size | d-flex flex-lg-column align-items-start align-items-lg-normal justify-content-between justify-content-lg-center">
                    <div class="desk-size__inner | u-rel flex">
                        <div>
                            <?php $i = 1; foreach($m['desk_sizes'] as $size) : ?>
                                <p class="desk-size__number js-desk-size <?php if ($i == 2) { echo 'is-active'; } ?>" data-step="<?php echo $i; ?>"><?php echo $size['desk_size']; ?></p>
                            <?php $i++; endforeach; ?>
                            <p class="desk-size__text"><?php pll_e('Number of desks'); ?></p>
                        </div>
                    </div>
                    <?php 
                        $btn_data = array(
                            'button_type' => 'form',
                            'button_text' => pll__('Enquire Now'),
                            'form' => 'enquiry_form',
                        );
                        echo get_button(null, null, null, $btn_data);
                    ?>
                </div>
            </div>
            <div class="desk-size-slider__content | u-bg-beige-2 col-lg-7">
                <?php $i = 1; foreach($m['desk_sizes'] as $size) : ?>
                    <div class="content js-desk-size-content <?php if ($i == 2) { echo 'is-active'; } ?>" data-step="<?php echo $i; ?>">
                        <h3 class="text-upper "><?php echo $size['subheading']; ?></h3>

                        <?php if ($size['notice_period']) : ?>
                            <div class="feature ">
                                <p class="feature-title | fw-500"><?php pll_e('Notice period'); ?></p>
                                <p class="feature-description"><?php echo $size['notice_period']; ?></p>
                            </div>
                        <?php endif; ?>
                        <?php if ($size['min_length']) : ?>
                            <div class="feature ">
                                <p class="feature-title | fw-500"><?php pll_e('Minimum length of license'); ?></p>
                                <p class="feature-description"><?php echo $size['min_length']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($size['features']) : foreach($size['features'] as $f) : ?>
                            <div class="feature ">
                                <p class="feature-title | fw-500"><?php echo $f['title']; ?></p>
                                <p class="feature-description"><?php echo $f['description']; ?></p>
                            </div>
                        <?php endforeach; endif; ?>
                        <a href="<?php echo get_permalink(112); ?>" class="c-inline-link c-inline-link--arrow mt-4 "><?php pll_e('Learn more'); ?></a>
                    </div>
                <?php $i++; endforeach; ?>
                <img class="bg-logo d-lg-none" src="<?php echo get_icon('logo-icon--navy.svg'); ?>" loading="lazy" alt="Logo">
            </div>
        </div>
    </div>
</section>