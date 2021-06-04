<section class="image-slider js-hidden module module-<?php echo $mod_num; ?>">
    <div class="container">
        <div class="row | u-rel">
            <div class="js-image-slider | col-12 u-rel mb-lg-0">
                <?php foreach($m['images'] as $img) : ?>
                    <div class="img-wrap | u-rel">
                        <img class="u-fluid" src="<?php echo $img['sizes']['big']; ?>" srcset="<?php echo generate_srcset($img['sizes']); ?>" alt="<?php echo $img['alt']; ?>" loading="lazy">
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (count($m['images']) > 1) : ?>
                <img src="<?php echo get_icon('arrow--button.svg'); ?>" class="arrow arrow--prev js-hov js-slick-prev d-block" alt="arrow">
                <img src="<?php echo get_icon('arrow--button.svg'); ?>" class="arrow arrow--next js-hov js-slick-next d-block" alt="arrow">
            <?php endif; ?>
        </div>
    </div>
</section>