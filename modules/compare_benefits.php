<section class="benefits module module-<?php echo $mod_num; ?>">
    <div class="benefits__container | container-lg">
        <div class="row">
            
            <div class="benefits__img-col | col-lg-4 offset-lg-1 order-lg-2 px-0">
                <?php if (get_field('bnfts_image_1', 'option')) : ?>    
                    <img class="benefits__img benefits__img--1 js-hidden" src="<?php echo get_field('bnfts_image_1', 'option')['sizes']['cw_small']; ?>" alt="<?php echo get_field('bnfts_image_1','option')['alt']; ?>" loading="lazy">
                <?php endif; ?>
                <?php if (get_field('bnfts_image_2', 'option')) : ?>    
                    <img class="benefits__img benefits__img--2 d-none d-lg-block js-hidden" src="<?php echo get_field('bnfts_image_2', 'option')['sizes']['cw_small']; ?>" alt="<?php echo get_field('bnfts_image_2','option')['alt']; ?>" loading="lazy">
                <?php endif; ?>
            </div>

            <div class="benefits__content-col js-hidden | col-lg-5 col-xxl-4 offset-lg-1 offset-xxl-2 order-lg-1">
                
                <?php if ($m['heading']) : ?>    
                    <div class="benefits__headings">
                        <h1 class="heading"><?php echo $m['heading']; ?></h1>
                        <?php if ($m['subheading']) : ?>    
                            <p class="subheading"><?php echo $m['subheading']; ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="benefits__tabs | d-flex">
                    <div class="tab js-benefit-tab js-hov is-active | d-flex flex-center fw-500" data-list="1">
                        <?php echo get_field('bnfts_list_title_1','option'); ?>
                    </div>
                    <div class="tab js-benefit-tab js-hov | d-flex flex-center fw-500" data-list="2">
                        <?php echo get_field('bnfts_list_title_2','option'); ?>
                    </div>
                </div>

                <div class="benefits__lists | u-rel">
                    <div class="benefits__list benefits__list--1 js-matchHeight is-active">
                        <?php foreach(get_field('bnfts_list_1', 'option') as $item) : ?>
                            <div class="benefit | d-flex align-items-start">
                                <div class="icon">
                                    <img src="<?php echo $item['icon']; ?>" alt="<?php echo $item['text']; ?>" loading="lazy">
                                </div>
                                <p><?php echo $item['text']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="benefits__list benefits__list--2 js-matchHeight">
                        <?php foreach(get_field('bnfts_list_2', 'option') as $item) : ?>
                            <div class="benefit | d-flex align-items-start">
                                <div class="icon">
                                    <img src="<?php echo $item['icon']; ?>" alt="<?php echo $item['text']; ?>" loading="lazy">
                                </div>
                                <p><?php echo $item['text']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <?php if (get_field('bnfts_button', 'option')) {
                        $btn = get_field('bnfts_button', 'option')['button'];
                        echo get_button(null, null, null, $btn);
                    } ?>
                </div>
            </div>
        </div>
    </div>
</section>