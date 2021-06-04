<div class="hover-banner js-hidden | d-none d-lg-block">
        
    <?php if ($m['heading']) : ?>
        <div class="container-lg mb-5">
            <div class="row align-items-center">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <h1 class="mb-0"><?php echo $m['heading']; ?></h1>
                </div>
                <?php if ($m['content_type']) : ?>
                    <div class="col-lg-2 d-none d-lg-inline-block text-right pr-0">
                        <?php $locations_page = pll_get_post('860', pll_current_language()); ?>
                        <a href="<?php echo get_permalink($locations_page); ?>" class="c-inline-link c-inline-link--arrow mt-3"><?php pll_e('All locations'); ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="hover-banner__inner | u-rel">
        
            <?php $i = 1; foreach($items as $item) : ?>
                <img class="hover-banner__bg js-hover-banner-bg | u-fluid <?php if ($i == 1) { echo 'is-active'; } ?>" data-content-index="<?php echo $i; ?>" src="<?php echo $item['desktop_image']; ?>" alt="<?php echo $item['heading']; ?>" loading="lazy">
            <?php $i++; endforeach; ?>
            
            <div class="hover-banner__overlay | u-fluid"></div>

            <div class="row">
                <div class="col">
                    
                    <div class="row">
                        <div class="hover-banner__headings | col-lg-6 d-flex flex-column align-items-start justify-content-center">
                            <?php $i = 1; foreach($items as $item) : 
                                ?>
                                <h2 class="js-hover-banner-heading js-hov <?php if ($i == 1) { echo 'is-active'; } ?> d-inline-flex align-items-center u-pointer text-upper text-white mb-0" data-content-index="<?php echo $i; ?>">
                                    <?php 
                                        echo $item['heading']; 
                                        if (! $item['coming_soon']) {
                                            echo '<span class="coming-soon">' . pll__("Coming soon") . '</span>';
                                        }
                                    ?>
                                </h2>
                            <?php $i++; endforeach; ?>
                        </div>
                        <div class="hover-banner__content | u-rel col-lg-6 d-flex flex-center">
                            <?php $i = 1; foreach($items as $item) : ?>
                                <div class="hover-banner__text | js-hover-banner-text <?php if ($i == 1) { echo 'is-active'; } ?>" data-content-index="<?php echo $i; ?>">
                                    <p class="<?php if (! $m['content_type']) { echo 'is-custom'; } ?> text-white mb-4"><?php echo $item['text']; ?></p>
                                    <?php if ($item['link']) :  ?>
                                        <a href="<?php echo $item['link']; ?>" target="<?php echo $item['link_target']; ?>" class="c-inline-link c-inline-link--arrow c-inline-link--white"><?php pll_e('Learn more'); ?></a>
                                    <?php endif; ?>
                                </div>
                            <?php $i++; endforeach; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php if (! $m['heading'] && $m['content_type']) : ?>
        <div class="container-lg text-center d-none d-lg-block">
            <?php $locations_page = pll_get_post('860', pll_current_language()); ?>
            <a href="<?php echo get_permalink($locations_page); ?>" class="c-inline-link c-inline-link--arrow mt-5"><?php pll_e('All locations'); ?></a>
        </div>
    <?php endif; ?>

</div>