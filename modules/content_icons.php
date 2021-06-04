<section class="cont-icons module module-<?php echo $mod_num; ?>">
    <div class="container-md">
        <div class="row align-items-lg-start">
            <div class="col-md-6 col-lg-5 offset-lg-1 col-xxl-4 offset-xxl-2">
                <div class="cont-icons__content">
                    <?php if ($m['heading']) : ?>
                        <h1 class="cont-icons__heading"><?php echo $m['heading']; ?></h1>
                    <?php endif; ?>
    
                    <?php foreach($m['text_sections'] as $ts) : ?>
                        <div class="cont-icons__text-section">
                            <?php if ($ts['subheading']) : ?>
                                <h2 class="cont-icons__subheading"><?php echo $ts['subheading']; ?></h2>
                            <?php endif; ?>
                            <p><?php echo $ts['text']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="cont-icons__icons-col | col-md-6 col-lg-5 u-bg-beige-2 d-flex flex-column align-items-center">
                <div class="cont-icons__icons-col__inner">
                    <h2 class="cont-icons__subheading cont-icons__subheading--icons"><?php echo $m['icons_heading']; ?></h2>
                    <?php if ($m['icons']) :
                        foreach($m['icons'] as $icon) : ?>
                            <div class="cont-icons__icon | d-flex align-items-center">
                                <div class="img">
                                    <img src="<?php echo $icon['icon']['url']; ?>" alt="<?php echo $icon['text']; ?>" loading="lazy">
                                </div>
                                <p class="mb-0"><?php echo $icon['text']; ?></p>
                            </div>
                        <?php endforeach; 
                    endif;?>
                </div>
            </div>
        </div>

    </div>
</section>