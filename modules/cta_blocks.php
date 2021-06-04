<section class="cta-blocks module module-<?php echo $mod_num; ?>">
    <div class="container-fluid">
        <div class="row">
            <?php foreach($m['blocks'] as $block) : ?>
                <div class="cta-blocks__col js-hidden | u-rel col-md-6">
                    <a href="<?php echo $block['link']['url']; ?>" class="d-block u-fluid" title="<?php echo $block['heading']; ?>">
                        <picture class="u-fluid">
                            <source srcset="<?php echo $block['webp_image']; ?>" type="image/webp">
                            <source srcset="<?php echo $block['image']['sizes']['big']; ?>" type="image/jpeg">
                            <img class="cta-blocks__img u-fluid" src="<?php echo $block['image']['sizes']['big']; ?>" srcset="<?php echo generate_srcset($block['image']['sizes']); ?>" alt="<?php echo $block['image']['alt']; ?>" loading="lazy">
                        </picture>
                        <div class="cta-blocks__overlay | u-fluid"></div>
                        <div class="cta-blocks__content">
                            <h2 class="u-rel mb-0 text-white"><?php echo $block['heading']; ?></h2>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>