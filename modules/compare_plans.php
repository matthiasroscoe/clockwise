<?php 
    $plan1 = $m['plan_1'];
    $plan2 = $m['plan_2'];
?>
<section class="compare-plans module module-<?php echo $mod_num; ?>">
    
    <?php if ($m['heading']) : ?>
        <div class="compare-plans__heading js-hidden | container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center"><?php echo $m['heading']; ?></h1>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="compare-plans__content | u-rel">
        <div class="container-lg | u-rel">
            <div class="js-plans-slider slick-hide-load-mobile | row align-items-lg-start">
                <div class="compare-plans__highlighted-icons js-hidden js-matchHeight-mob | u-rel text-white col-lg-6 col-xl-5 offset-xl-1">
                    <div class="slick-arrows | d-flex d-lg-none justify-content-between align-items-center">
                        <img src="<?php echo get_icon('arrow--button.svg'); ?>" class="arrow arrow--prev js-slick-prev" alt="arrow">
                        <img src="<?php echo get_icon('arrow--button.svg'); ?>" class="arrow arrow--next js-slick-next" alt="arrow">
                    </div>

                    <?php if ($plan1['title']) : ?>
                        <h2 class="compare-plans__subheading | text-white u-rel"><?php echo $plan1['title']; ?></h2>
                    <?php endif; ?>
                    
                    <?php foreach($plan1['icons'] as $icon) : ?>
                        <div class="compare-plans__icon | d-flex align-items-start">
                            <div class="icon-wrap | text-left">
                                <img src="<?php echo $icon['icon']['sizes']['thumbnail']; ?>" loading="lazy" alt="<?php echo $icon['text']; ?>">
                            </div>
                            <p class="text-white flex-fill mb-0"><?php echo $icon['text']; ?></p>
                        </div>
                    <?php endforeach; ?>

                    <?php if ($m['button']) :
                        echo get_button(null, null, null, $m['button']);
                    endif; ?>
                </div>

                <div class="compare-plans__normal-icons js-matchHeight-mob | u-rel col-lg-5 offset-lg-1 col-xl-4">
                    <div class="slick-arrows | d-flex d-lg-none justify-content-between align-items-center">
                        <img src="<?php echo get_icon('arrow--button--grey.svg'); ?>" class="arrow arrow--prev js-slick-prev" alt="Arrow">
                        <img src="<?php echo get_icon('arrow--button--grey.svg'); ?>" class="arrow arrow--next js-slick-next" alt="Arrow">
                    </div>
                    
                    <?php if ($plan2['title']) : ?>
                        <h2 class="compare-plans__subheading"><?php echo $plan2['title']; ?></h2>
                    <?php endif; ?>
                    
                    <?php foreach($plan2['icons'] as $icon) : ?>
                        <div class="compare-plans__icon | d-flex align-items-start">
                            <div class="icon-wrap | text-left">
                                <img src="<?php echo $icon['icon']['sizes']['thumbnail']; ?>" loading="lazy" alt="<?php echo $icon['text']; ?>">
                            </div>
                            <p class="flex-fill mb-0"><?php echo $icon['text']; ?></p>
                        </div>
                    <?php endforeach; ?>

                    <div class="d-lg-none">
                        <?php if ($m['button']) :
                            echo get_button(null, null, null, $m['button']);
                        endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>