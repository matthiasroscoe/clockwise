<?php $num_members = count($m['team_members']); ?>

<section class="team-slider module module-<?php echo $mod_num; ?>">
    <div class="container">

        <?php if ($m['custom_heading']) : ?>
            <div class="js-hidden | d-lg-none row justify-content-center">
                <div class="col-10">
                    <h1 class="text-center mb-2"><?php echo $m['custom_heading']; ?></h1>
                </div>
            </div>
        <?php endif; ?>

        <div class="js-hidden | row">
            <div class="<?php if ($num_members > 1) { echo 'js-team-slider | '; } ?> | col-12">
                <?php 
                    $num_members = count($m['team_members']);
                    foreach($m['team_members'] as $member) : 
                        
                        // Team member vars
                        // $member = $tm['team_member'];
                        $name = get_field('first_name', $member) . ' ' . get_field('last_name', $member);
                        $role = get_field('role', $member);
                        $intro = get_field('intro', $member);
                        $phone = get_field('phone',$member);
                        $email = get_field('email',$member);
                        $img = get_field('profile_image', $member)['sizes']['cw_medium'];
                        ?>
                        <div class="d-flex">
                            <div class="team-slider__content js-matchHeight <?php if ($num_members > 1) { echo 'team-slider__content--slider '; } ?>| col-lg-6">
                                
                                <?php if ($m['custom_heading']) : ?>
                                    <img class="team-slider__img-mobile d-lg-none" src="<?php echo $img; ?>" alt="<?php echo $name; ?>" loading="lazy">
                                <?php endif; ?>

                                <?php if ($num_members > 1 && $m['custom_heading']) : ?>
                                    <div class="slick-arrows | d-flex justify-content-between align-items-center">
                                        <img class="arrow arrow--prev js-slick-prev" src="<?php echo get_icon('arrow--button--grey.svg'); ?>" alt="Previous Arrow">
                                        <img class="arrow arrow--next js-slick-next" src="<?php echo get_icon('arrow--button--grey.svg'); ?>" alt="Next Arrow">
                                    </div>
                                <?php endif; ?>

                                <?php if ($m['custom_heading']) : ?>
                                    <h1 class="team-slider__heading | d-none d-lg-block"><?php echo $m['custom_heading']; ?></h1>
                                    
                                    <?php $subheading = ($role) ? $name . ', ' . $role : $name; ?>
                                    <p class="team-slider__subheading team-slider__subheading--custom | fw-500"><?php echo $subheading; ?></p>
                                <?php else: ?>
                                    <p class="team-slider__subheading | fw-500"><?php pll_e('The team'); ?></p>
                                    <h1 class='team-slider__heading'><?php echo $name; ?></h1>
                                    
                                    <?php if ($role) : ?>
                                        <p class="team-slider__role | text-upper fw-300"><?php echo $role; ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                                
                                <?php if (! $m['custom_heading']) : ?>
                                    <img class="team-slider__img-mobile d-lg-none" src="<?php echo $img; ?>" alt="<?php echo $name; ?>" loading="lazy">
                                <?php endif; ?>

                                <?php if ($intro) : ?>
                                    <div class="team-slider__intro | fw-300"><?php echo $intro; ?></div>
                                <?php endif; ?>
                                    
                                <?php if ($email) : ?>
                                    <p class="team-slider__link">E: <a href="mailto:<?php echo $email; ?>" class="team-slider__email"><?php echo $email; ?></a></p>
                                <?php endif; ?>
                                    
                                <?php if ($phone) : ?>
                                    <p class="team-slider__link">T: <a href="tel:<?php echo $phone; ?>" class="team-slider__phone"><?php echo $phone; ?></a></p>
                                <?php endif; ?>

                                <?php if ($num_members > 1 && ! $m['custom_heading']) : ?>
                                    <div class="slick-arrows | d-none d-lg-flex justify-content-between align-items-center">
                                        <img class="arrow arrow--prev js-slick-prev" src="<?php echo get_icon('arrow--button--grey.svg'); ?>" alt="Previous Arrow">
                                        <img class="arrow arrow--next js-slick-next" src="<?php echo get_icon('arrow--button--grey.svg'); ?>" alt="Next Arrow">
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="team-slider__img | u-rel col-lg-6 d-none d-lg-block">
                                <img class="u-fluid" srcset="<?php echo generate_srcset(get_field('profile_image', $member)['sizes']); ?>" src="<?php echo $img; ?>" alt="<?php echo $name; ?>" loading="lazy">
                            </div>
                        </div>
                    <?php 
                endforeach; ?>
            </div>
        </div>
    </div>
</section>