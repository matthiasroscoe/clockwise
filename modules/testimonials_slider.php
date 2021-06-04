<section class="testimonials-slider module module-<?php echo $mod_num; ?>">
    <div class="container-lg">
        <div class="row">
            <div class="testimonials-slider__slider <?php if ($m['testimonials']) { echo 'js-testimonials-video-slider slick-hide-load'; } ?> js-hidden | col-12">
                <?php // Display intro slide

                    $intro_poster = ($m['intro_video_poster']) ? 'poster="' . $m['intro_video_poster']['sizes']['big'] . '"' : '';
                    ?>
                        <div class="testimonials-slider__slide testimonials-slider__slide--intro">
                            <div class="testimonials-slider__slide__inner | d-flex u-rel flex-column align-items-center justify-content-start justify-content-md-center">
                                <video 
                                    src="<?php echo $m['intro_video']; ?>" 
                                    <?php echo $intro_poster; ?>
                                    class="video js-testimonial-intro-video <?php if ($m['intro_video_mobile']) { echo 'd-none d-md-block'; } else { echo 'd-block'; } ?> u-fluid" preload="metadata" loop muted playsinline disableremoteplayback>
                                </video>
                                <?php if ($m['intro_video_mobile']) : ?>
                                    <video 
                                        src="<?php echo $m['intro_video_mobile']; ?>" 
                                        <?php echo $intro_poster; ?>
                                        class="video js-testimonial-intro-video d-block d-md-none u-fluid" preload="metadata" loop muted playsinline disableremoteplayback>
                                    </video>
                                <?php endif; ?>
                                                                    
                                <div class="details details--intro | text-center d-flex flex-column justify-content-md-center align-items-center">
                                    <?php if ($m['subheading']) : ?>
                                        <p class="subheading | d-none d-md-block text-white text-upper fw-500"><?php echo $m['subheading']; ?></p>
                                    <?php endif; ?>
                                    
                                    <h1 class="heading | text-white"><?php echo $m['heading']; ?></h1>

                                    <?php if ($m['intro_text']) : ?>
                                        <p class="intro | fw-300 text-white"><?php echo $m['intro_text']; ?></p>
                                    <?php endif; ?>

                                    <?php if ($m['link']) : $link = $m['link']; ?>
                                        <a class="c-btn c-btn--white mt-3" href="<?php echo $link['url']; ?>" title="<?php echo $link['title']; ?>" target="<?php echo $link['target']; ?>">
                                            <span><?php echo $link['title']; ?></span>
                                            <div class="icon">
                                                <svg>
                                                    <circle class="bg-circle" r="50%" cx="50%" cy="50%" />
                                                    <circle class="fg-circle" r="50%" cx="50%" cy="50%" />
                                                </svg>
                                                <img src="<?php echo get_icon('arrow--dark.svg'); ?>" alt="arrow">
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    <?php
                ?>

                <?php // Display testimonial slides
                    if ($m['testimonials']) :
                        foreach($m['testimonials'] as $test) :

                            // If no video available, skip testimonial
                            if (! get_field('video', $test)) {
                                continue;
                            }

                            // Use placeholder video/image if available
                            $placeholder = (get_field('video_placeholder', $test)) ? get_field('video_placeholder', $test) : get_field('video', $test);
                            $poster = (get_field('video_poster', $test)) ? 'poster="' . get_field('video_poster', $test)['sizes']['big'] . '"' : '';

                            // Get testimonial vars
                            $name = (get_field('last_name', $test)) ? get_field('first_name', $test) . '<span class="d-none d-md-inline"> ' . get_field('last_name', $test) . '</span>' : get_field('first_name', $test);
                            $img = (get_field('landscape_img', $test)) ? get_field('landscape_img', $test) : get_field('thumbnail', $test);
                            $quote = get_field('video_quote', $test);
                            $location = get_field('clockwise_location', $test)[0];
                            ?>
                                <div class="testimonials-slider__slide testimonials-slider__slide--testimonial">
                                    <div class="testimonials-slider__slide__inner | d-flex u-rel flex-column align-items-center justify-content-start justify-content-md-center">
                                        <video 
                                            src="<?php echo $placeholder; ?>" 
                                            <?php echo $poster; ?>
                                            class="video js-testimonials-video d-block u-fluid" preload="none" loop muted playsinline disableremoteplayback>
                                        </video>
                                                                            
                                        <div class="details | text-center d-flex flex-column justify-content-md-center align-items-center">
                                            <h1 class="heading | text-white"><?php echo $name; ?></h1>
                                            
                                            <?php if ($location) : ?>
                                                <p class="subheading | text-white text-upper fw-500"><?php echo $location->post_title;?></p>
                                            <?php endif; ?>

                                            <?php if ($quote) : ?>
                                                <p class="intro | fw-300 text-white"><?php echo $quote; ?></p>
                                            <?php endif; ?>

                                            <a class="c-btn c-btn--white js-play-testimonial-video" href="#" data-barba-prevent data-href="<?php echo get_field('video', $test); ?>" title="<?php pll_e('Watch video'); ?>">
                                                <span><?php pll_e('Watch video'); ?></span>
                                                <div class="icon">
                                                    <svg>
                                                        <circle class="bg-circle" r="50%" cx="50%" cy="50%" />
                                                        <circle class="fg-circle" r="50%" cx="50%" cy="50%" />
                                                    </svg>
                                                    <img src="<?php echo get_icon('arrow--dark.svg'); ?>" alt="arrow">
                                                </div>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            <?php
                        endforeach;
                    endif;
                ?>
            </div>
        </div>
    </div>

    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-xxl-10">
                <?php if ( $m['show_logos'] && count($m['logos']) > 0 ) : ?>
                    <div class="testimonials-slider__logos js-hidden | d-flex flex-column align-items-lg-center">
                        <div class="testimonials-slider__logos__inner | d-xl-flex flex-xl-row justify-content-xl-center align-items-xl-center">
                            <p class="our-clients | text-upper fw-500"><?php pll_e('Our clients'); ?>:</p>
                            <div class="logos js-logos-slider | d-flex flex-nowrap flex-lg-wrap">
                                <?php $i = 1; foreach($m['logos'] as $logo) : 
                                    if ($i > 6) { break; } ?>
                                    <div class="logo">
                                        <img src="<?php echo $logo['client_logo']['url']; ?>" alt="<?php echo $logo['client_logo']['alt']; ?>" loading="lazy">
                                    </div>
                                <?php $i++; endforeach; ?>
                            </div>
                        </div>

                        <?php $about_page = pll_get_post('421', pll_current_language()); ?>
                        <a href="<?php echo get_permalink($about_page); ?>" class="c-inline-link c-inline-link--arrow | d-none d-lg-inline-block"><?php pll_e('About Clockwise'); ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>