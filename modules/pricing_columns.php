<section class="pricing-cols module module-<?php echo $mod_num; ?>">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="pricing-cols__heading js-hidden"><?php echo $m['heading']; ?></h1>
            </div>
        </div>

        <div class="u-rel">
            <div class="js-pricing-cols-slider<?php if ($m['style'] != 'carousel') { echo '--mobile-only'; } ?> js-slick-slider js-hidden | row">
                <?php foreach($m['columns'] as $col) : 
                    $mp = $col['membership_plan'][0];
                    $title = get_the_title($mp);
                    $image = ($col['image']) ? $col['image'] : get_field('thumbnail', $mp);
                    
                    // Get base perks for membership
                    $perks = get_field('perks', $mp); 

                    // Get base pricing
                    $price = get_field('price', $mp);
                    $price_details = get_field('price_details', $mp);
                    
                    if ($m['location']) {
                        // Get any extra location-specific perks 
                        $extra_perks = get_field('extra_perks', $mp);
                        $extra_perks_text = '';
                        if ($extra_perks) : foreach($extra_perks as $ep) {
                            foreach($ep['location'] as $loc) {
                                if ($loc == $m['location'][0]) {
                                    $extra_perks_text = $ep['perks'];
                                };
                            }
                        } endif;

                        // Get location-specific pricing
                        $extra_pricing = get_field('extra_pricing', $mp);
                        if ($extra_pricing) : foreach($extra_pricing as $ep) {
                            foreach($ep['location'] as $loc) {
                                if ($loc == $m['location'][0]) {
                                    $price = $ep['price'];
                                }
                            }
                        } endif;
                    }

                    ?>
                    <div class="pricing-cols__col js-matchHeight | col-md-6 col-lg-4 d-flex flex-column">
                        <?php if ( $image ) : ?>
                            <div class="image-wrap">
                                <img class="u-fluid" src="<?php echo $image['sizes']['cw_small']; ?>" alt="<?php echo $title; ?>" loading="lazy">
                            </div>
                        <?php endif; ?>
    
                        <div class="details | d-flex flex-column flex-fill">
                            <div class="slick-arrows d-flex d-md-none align-items-center justify-content-between">
                                <img src="<?php echo get_icon('arrow--button--grey.svg'); ?>" class="arrow arrow--prev js-slick-prev" alt="arrow">
                                <img src="<?php echo get_icon('arrow--button--grey.svg'); ?>" class="arrow arrow--next js-slick-next" alt="arrow">
                            </div>
    
                            <h2 class="title | fw-500"><?php echo $title; ?></h2>
                            
                            <?php if ( $perks ) : ?>
                                <div class="text"><?php echo $perks . $extra_perks_text; ?></div>
                            <?php endif; ?>
    
                            <?php if ( $price ) : ?>
                                <div class="d-flex flex-column flex-fill justify-content-end">
                                    <div class="pricing | d-flex ">
                                        <p class="price-text | fw-300 mb-0">from <span class="price fw-500">£<?php echo $price; ?></span></p>
                                        <?php if ($price_details) : ?>
                                            <p class="price-details fw-300 | mb-0"><?php echo $price_details; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
    
                            <?php 
                                if ( $col['link_to_memb_plan'] ) {
                                    $btn_data = array(
                                        'button_type' => 'link',
                                        'link' => array(
                                            'url' => get_the_permalink($mp),
                                            'title' => pll__('Learn More'),
                                            'target' => '_self',
                                        )
                                    );
                                    echo get_button(null, null, null, $btn_data);
                                } else if ( $col['button'] ) {
                                    echo get_button(null, null, null, $col['button']);
                                }
                            ?>
                                
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ($m['style'] == 'carousel') : ?>
                <img src="<?php echo get_icon('arrow--button--grey.svg'); ?>" class="slick-arrow-desk slick-arrow-desk--prev js-hov js-slick-prev d-none d-md-block" alt="arrow">
                <img src="<?php echo get_icon('arrow--button--grey.svg'); ?>" class="slick-arrow-desk slick-arrow-desk--next js-hov js-slick-next d-none d-md-block" alt="arrow">
            <?php endif; ?>

        </div>
    </div>
</section>