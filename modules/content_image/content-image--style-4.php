<section class="cont-img-s4 module module-<?php echo $mod_num; ?>">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="cont-img-s4__inner | d-flex flex-column flex-lg-row justify-content-lg-between align-items-lg-center col-lg-11 col-xxl-10">
                
                <img class="cont-img-s4__img | order-lg-2" src="<?php echo $m['image']['sizes']['cw_medium']; ?>" alt="<?php echo $m['image']['alt']; ?>" loading="lazy">
                
                <div class="cont-img-s4__content order-lg-1">
                    <?php foreach($m['text_sections'] as $text) : ?>
                        <div class="text-section">
                            <?php if ($text['subheading']) : 
                                if (count($m['text_sections']) == 1) { ?>
                                    <h2><?php echo $text['subheading']; ?></h2>
                                <?php } else { ?>
                                    <p class="subheading | mb-1 text-upper fw-500"><?php echo $text['subheading']; ?></p>
                                <?php } ?>
                            <?php endif; ?>
                            <?php if ($text['text']) : ?>
                                <p class="text"><?php echo $text['text']; ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                    
                    <?php // Show buttons
                        if (count($m['buttons']) > 0) {
                            foreach($m['buttons'] as $btn) {
                                echo get_button(null, null, null, $btn['button']);
                            }    
                        } 
                    ?>
                </div>

            </div>
        </div>
    </div>
</section>