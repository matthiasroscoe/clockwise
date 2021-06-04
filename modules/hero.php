<?php
    $basic_post_types = array('event', 'article', 'team_member', 'membership-plans', 'job_vacancy', 'career_case_study');
    $is_post = (in_array(get_post_type(), $basic_post_types)) ? true : false;
    $is_location = (get_post_type() == 'location') ? true : false;
    $is_memb_plan = (get_post_type() == 'membership-plans') ? true : false;

    $topbar_active = (get_field('enable_topbar', 'option')) ? ' topbar-active' : '';
    
    // Generate overlay div classlist
    $overlay_class = '';
    if ($m['video']) {
        $overlay_class .= ' js-hero-overlay';
    }
    if ($m['extra_overlay']) {
        $overlay_class .= ' is-darkened';
    }
    
    // Generate content div classlist
    $hero_content_class = ($m['video']) ? 'has-video' : 'no-video';
    if ($is_memb_plan) { 
        $hero_content_class .= ' is-memb-plan';
    } else if ($is_post) {
        $hero_content_class .= ' is-post';
    } else if ($is_location) {
        $hero_content_class .= ' is-location';
    }
?>

<section class="hero <?php if ($is_post) { echo 'hero--article'; } ?> module module-<?php echo $mod_num . $topbar_active; ?> | u-rel">
    
    <?php if ($m['video']) : ?>
        <video 
            src="<?php echo $m['video']; ?>" 
            class="hero__video js-hero-video u-fluid" 
            preload="metadata" 
            poster="<?php echo $m['image']['sizes']['hero']; ?>"
            loop autoplay muted playsinline disableremoteplayback>
        </video>
        <a href="#" class="hero__video-close js-mob-video-toggle | d-lg-none" data-barba-prevent>
            <img src="<?php echo get_icon('video--close.svg'); ?>" alt="Close video">
        </a>
    <?php elseif ($m['image']) : ?>
        <?php if ($m['mobile_image']) : 
            $desktop_class = 'd-none d-sm-block'; $mobile_class = 'd-sm-none'; ?>
            <picture class="hero__img <?php echo $mobile_class; if ($is_post) { echo ' js-hero-img-prlx'; } ?> | u-fluid">
                <source class="u-fluid" srcset="<?php echo $m['webp_mobile_image']; ?>" type="image/webp">
                <source class="u-fluid" srcset="<?php echo $m['mobile_image']['sizes']['cw_medium']; ?>" type="image/jpeg">
                <img class="u-fluid" src="<?php echo $m['mobile_image']['sizes']['cw_medium']; ?>" srcset="<?php echo generate_srcset($m['mobile_image']['sizes']); ?>" alt="<?php echo $m['image']['alt']; ?>" loading="lazy">
            </picture>
            <picture class="hero__img <?php echo $desktop_class; if ($is_post) { echo ' js-hero-img-prlx'; } ?> | u-fluid">
                <source class="u-fluid" srcset="<?php echo $m['webp_image']; ?>" type="image/webp">
                <source class="u-fluid" srcset="<?php echo $m['image']['sizes']['big']; ?>" type="image/jpeg">
                <img class="u-fluid" src="<?php echo $m['image']['sizes']['big']; ?>" srcset="<?php echo generate_srcset($m['image']['sizes']); ?>" alt="<?php echo $m['image']['alt']; ?>" loading="lazy">
            </picture>
            <img src="<?php echo $m['image']['sizes']['hero']; ?>" srcset="<?php echo generate_srcset($m['image']['sizes']); ?>" class="hero__img <?php echo $desktop_class; if ($is_post) { echo ' js-hero-img-prlx'; } ?> | u-fluid" alt="<?php echo $m['image']['alt']; ?>" loading="lazy">
        <?php else: ?>
            <picture class="hero__img <?php echo $desktop_class; if ($is_post) { echo ' js-hero-img-prlx'; } ?> | u-fluid">
                <source class="u-fluid" srcset="<?php echo $m['webp_image']; ?>" type="image/webp">
                <source class="u-fluid" srcset="<?php echo $m['image']['sizes']['big']; ?>" type="image/jpeg">
                <img class="u-fluid" src="<?php echo $m['image']['sizes']['big']; ?>" srcset="<?php echo generate_srcset($m['image']['sizes']); ?>" alt="<?php echo $m['image']['alt']; ?>" loading="lazy">
            </picture>
        <?php endif; ?>
    <?php else : ?>
        <img src="<?php echo get_image('fallback-hero.jpg'); ?>" class="hero__img <?php if ($is_post) { echo 'js-hero-img-prlx'; } ?> | u-fluid" alt="<?php echo get_the_title(); ?>" loading="lazy">
    <?php endif; ?>
    
    <div class="hero__overlay <?php echo $overlay_class; ?> is-active | u-fluid"></div>
    
    <?php if ($is_post && get_post_type() != 'membership-plans') : ?>
        <div class="hero__sharing | container d-none d-lg-flex justify-content-end">
            <div class="hero__sharing__inner | d-flex flex-column align-items-center">
                <div class="links | d-flex flex-column align-items-center">
                    <?php
                        $sl_data = get_sharing_link_data(); 
                        if ($sl_data) : foreach($sl_data as $key => $link) : ?>
                            <a href="<?php echo $link['url']; ?>" title="<?php echo $key; ?>" target="_blank" class="link">
                                <img src="<?php echo $link['icon_small']; ?>" loading="lazy" alt="<?php echo $key; ?>">
                            </a>
                        <?php endforeach; endif;
                    ?>
                </div>
                <div class="line"></div>
                <p class="text-upper text-white fw-500 mb-0"><?php pll_e('Share'); ?></p>
            </div>
        </div>
    <?php endif; ?>
    
    <div class="hero__content <?php echo $hero_content_class; ?> js-hero-content is-active | u-rel"> 
        <?php echo get_back_link(); ?>

        <div class="hero__content__headings">
            <?php if ($m['heading']) : ?>
                <h1 class="text-white mb-0"><?php echo $m['heading']; ?></h1>
            <?php endif; ?>

            <?php if ($m['subheading']) : ?>
                <h1 class="text-white fw-300 mb-0 <?php if (is_page()) { echo 'mt-3'; } ?>"><?php echo $m['subheading']; ?></h1>
            <?php endif; ?>

            <?php // Add coming soon text for locations
                if (is_single() && get_post_type() == 'location') {
                    if (get_field('location_status', get_the_ID()) == false && get_field('coming_soon_text', get_the_ID())) { ?>
                        <h2 class="coming-soon | text-white fw-300"><?php echo get_field('coming_soon_text', get_the_ID()); ?></h2>
                    <?php }
                } 
            ?>
        </div>

        <?php if ($m['text'] && $m['actions'] != 'contact') : ?>
            <div class="hero__content__text text-white"><?php echo $m['text']; ?></div>
        <?php endif; ?>

        <?php 
            if($m['actions'] == 'eventbrite' && is_user_logged_in()){
                ?>
                <div class="hero__content__text eventbrite-content text-white">
                    <p class="times"><strong>Date and time</strong><br/><?php echo $m['eb_date']; ?><br/><?php echo $m['eb_start']; ?> - <?php echo $m['eb_end']; ?></p>
                    <p class="address"><strong>Location</strong><br/><?php echo $m['eb_venue'] ?></p>
                </div>
                <?php
            }
        ?>

        <?php if ($m['video']) : ?>
            <a class="hero__watch-video js-mob-video-toggle c-btn c-btn--transparent | d-lg-none" href="#" title="<?php pll_e('Watch Video'); ?>" data-barba-prevent>
                <span><?php pll_e('Watch Intro Video'); ?></span>
                <div class="icon">
                    <img src="<?php echo get_icon('play-video--mobile.svg'); ?>" alt="Play Video">
                </div>
            </a>
        <?php endif; ?>

        <?php 
        if ($m['actions'] == 'regions') {
            echo get_hero_dropdown($m['actions'], null);
        } 
        else if ($m['actions'] == 'locations' && $m['region_dropdown']) {
            echo get_hero_dropdown($m['actions'], $m['region_dropdown']);
        } 
        else if ($m['actions'] == 'contact') {
            echo get_hero_contact_info();
        }
        else if ($m['actions'] == 'buttons' && $m['buttons']) { ?>
            <div class="hero__buttons">
                <?php 
                    foreach($m['buttons'] as $btn) {
                        echo get_button(null, null, null, $btn['button']);
                    } 
                    
                    if ($m['brochure_download']) {
                        $btn_data = array(
                            'button_type' => 'form',
                            'form' => 'brochure_form',
                            'button_text' => pll__('Request a Brochure'),
                            'id' => 'download-brochure',
                        );
                        echo get_button(null, null, null, $btn_data);
                    }
                ?>

            </div>
        <?php } ?>
    </div>

    
    <?php if ($is_post || is_front_page()) : ?>
        <a class="hero__scroll-down <?php if ($is_post) { echo 'hero__scroll-down--article'; } ?>" href="#" data-barba-prevent>
            <?php if (! $is_post) : ?>
                <img class="d-lg-none" src="<?php echo get_icon('hero-scroll--mobile.svg'); ?>" loading="lazy" alt="scroll">
            <?php else: ?>
                <img src="<?php echo get_icon('hero-scroll.svg'); ?>" loading="lazy" alt="scroll">
            <?php endif; ?>
        </a>
    <?php endif; ?>
</section>