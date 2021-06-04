<?php 
    $am = $m['amenities'];
    $am_count = count($am);
    $half_am_count = round($am_count / 2);
?>

<section class="amenities module module-<?php echo $mod_num; ?>">
    <div class="amenities__container | container-fluid container-lg u-rel">
        <div class="row justify-content-center">
            
            <div class="amenities__img js-hidden | col-lg-4 d-none d-lg-block pr-lg-0">
                <img class="u-fluid" src="<?php echo $m['image']['sizes']['big']; ?>" alt="<?php echo $m['image']['alt']; ?>" loading="lazy">
            </div>
            
            <div class="amenities__content js-hidden | col-lg-6">
                <?php if ($m['heading']): ?>
                    <h1 class="amenities__heading flex-grow"><?php echo $m['heading']; ?></h1>
                <?php endif; ?>
                
                <ul class="amenities__list amenites__list--mobile | d-sm-none">
                    <?php 
                        $i = 0; foreach ($am as $a) {
                            ?>
                                <li class="amenity <?php if ($i >= 8) { echo 'js-extra-amenity'; } ?>">
                                    <img src="/wp-content/themes/clockwise/library/images/icons/amenities/<?php echo $am[$i]['icon']; ?>.svg" loading="lazy" alt="<?php echo $am[$i]['text']; ?>">
                                    <span class="fw-300"><?php echo $am[$i]['text']; ?></span>
                                </li>
                            <?php
                            $i++;
                        }
                    ?>
                </ul>
                
                <ul class="amenities__list | d-none d-sm-inline-block">
                    <?php 
                        for ($i=0; $i < $half_am_count; $i++) { ?>
                            <li class="amenity <?php if ($i >= 6) { echo 'js-extra-amenity'; } ?>">
                                <img src="/wp-content/themes/clockwise/library/images/icons/amenities/<?php echo $am[$i]['icon']; ?>.svg" loading="lazy" alt="<?php echo $am[$i]['text']; ?>">
                                <span class="fw-300"><?php echo $am[$i]['text']; ?></span>
                            </li>
                        <?php } 
                    ?>
                </ul>

                <ul class="amenities__list | d-none d-sm-inline-block">
                    <?php 
                        for ($i=$half_am_count; $i < $am_count; $i++) { ?>
                            <li class="amenity <?php if ($i >= $half_am_count + 6) { echo 'js-extra-amenity'; } ?>">
                                <img src="/wp-content/themes/clockwise/library/images/icons/amenities/<?php echo $am[$i]['icon']; ?>.svg" loading="lazy" alt="<?php echo $am[$i]['text']; ?>">
                                <span class="fw-300"><?php echo $am[$i]['text']; ?></span>
                            </li>
                        <?php } 
                    ?>
                </ul>

                <?php if ($am_count > 12) : ?>
                    <a href="#" class="c-inline-link js-toggle-all-amenities" data-more="<?php _e('Show all amenities', 'clockwise'); ?>" data-less="<?php _e('Show less amenities', 'clockwise'); ?>"><?php _e('Show all amenities', 'clockwise'); ?></a><br>
                <?php endif; ?>
                

                <?php echo get_button(null, null, null, $m['button']); ?>
                
            </div>
        </div>
    </div>
</section>