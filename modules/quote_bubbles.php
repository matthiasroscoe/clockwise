<section class="quotes module module-<?php echo $mod_num; ?>">
    <div class="container-lg | u-rel">
        
        <?php if ($m['heading']) : ?>
            <h1 class="quotes__heading js-hidden"><?php echo $m['heading']; ?></h1>
        <?php endif; ?>
    
        <div class="row js-quotes-slider">
            
            <?php $i = 1; foreach($m['testimonials'] as $quote) : 
                $classlist = 'col-lg-6 px-lg-5 offset-lg-5 col-xxl-5 offset-xxl-5';
                if ($i == 2) {
                    $classlist = 'col-lg-5 col-xxl-4 offset-xxl-1 px-lg-4';
                } elseif ($i == 3) {
                    $classlist = 'col-lg-7 col-xxl-6 px-lg-5';
                }
                ?>
                <div class="quotes__testimonial quotes__testimonial--<?php echo $i; ?> js-hidden | <?php echo $classlist; ?>">
                    <div class="quotes__testimonial-inner | d-flex flex-column u-rel">
                        <?php if (get_field('logo', $quote)) : ?>
                            <div class="logo-wrap | d-flex flex-center">
                                <div class="logo <?php if (get_field('white_bg', $quote)) { echo 'has-white-bg'; } ?> | d-flex flex-center">
                                    <img src="<?php echo get_field('logo', $quote)['url']; ?>" loading="lazy" alt="Logo">
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="testimonial | u-rel"><?php echo get_field('testimonial', $quote); ?></div>
                        
                        <div class="d-flex">
                            <?php if (get_field('thumbnail', $quote)) : ?>
                                <img class="thumbnail | d-block pr-3" src="<?php echo get_field('thumbnail', $quote)['sizes']['thumbnail']; ?>" alt="<?php echo get_field('first_name', $quote) . ' ' . get_field('last_name', $quote); ?>" loading="lazy">
                            <?php endif; ?>
                            <div class="pt-2">
                                <p class="name | fw-500 mb-0"><?php echo get_field('first_name', $quote) . ' ' . get_field('last_name', $quote); ?></p>
                                <?php if (get_field('company', $quote)): ?>
                                    <p class="company mb-0"><?php echo get_field('company', $quote); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="slick-arrows d-flex d-lg-none align-items-center">
                            <img src="<?php echo get_icon('arrow--button--grey.svg'); ?>" class="arrow arrow--prev js-slick-prev" alt="arrow">
                            <img src="<?php echo get_icon('arrow--button--grey.svg'); ?>" class="arrow arrow--next js-slick-next" alt="arrow">
                        </div>
                        
                    </div>
                </div>
            <?php $i++; endforeach; ?>
        </div>
    </div>
</section>