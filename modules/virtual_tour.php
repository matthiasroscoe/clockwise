<section class="virtual-tour module module-<?php echo $mod_num; ?>">
    <div class="container">
        <div class="row">
            <div class="virtual-tour__mp | col-lg-7">
                <div class="virtual-tour__mp-inner js-hidden | u-rel">
                    <img class="virtual-tour__mp-img <?php if ($m['matterport']) { echo 'has-matterport'; } ?> | d-block" src="<?php echo $m['cover_image']['sizes']['cw_medium']; ?>" alt="<?php echo $m['heading']; ?>" loading="lazy">
                    
                    <?php if ($m['matterport']) : ?>
                        <a href="<?php echo $m['matterport']; ?>" class="play-tour js-open-matterport | d-block text-center" title="Virtual Tour" data-lity>
                            <img src="<?php echo get_icon('play-video.svg'); ?>" class="icon" alt="play video">
                            <p class="text-white mb-0"><?php pll_e('Take virtual tour'); ?></p>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="virtual-tour__content js-hidden | col-lg-4">
                <?php if ($m['subheading']) : ?>
                    <p class="virtual-tour__subheading | text-upper"><?php echo $m['subheading']; ?></p>
                <?php endif; ?>
                
                <h1 class="virtual-tour__heading"><?php echo $m['heading']; ?></h1>
                
                <?php if ($m['text']) : ?>
                    <p class="virtual-tour__text | fw-300"><?php echo $m['text'] ?></p>
                <?php endif; ?>

                <?php echo get_button(null, null, null, $m['button']); ?>
            </div>
        </div>
    </div>
</section>