<section class="rooms-slider module module-<?php echo $mod_num; ?>">
    <?php if ($m['heading']): ?>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="js-hidden"><?php echo $m['heading']; ?></h1>
                </div>
            </div>
        </div>
    <?php endif; ?>
    
    <div class="rooms-slider__wrap js-hidden | u-rel mt-3">
        <div class="rooms-slider__slider js-meeting-rooms-slider | u-rel">
            <?php 
                $rooms = get_meeting_rooms_by_location($m['location'][0]);
                $num_slides = count($rooms);
                if ($num_slides < 4 && $num_slides > 1) {
                    $rooms_duplicated = $rooms;
                    $rooms = array_merge($rooms_duplicated, $rooms);
                }

                $i = 1; foreach($rooms as $room) : ?>
                    <div class="room <?php if ($num_slides > 1) { echo 'js-meeting-rooms-slide'; } else { echo 'is-only-slide'; } ?> | u-rel" data-slide="<?php echo $i; ?>">
                        <img class="img" srcset="<?php echo generate_srcset(get_field('image', $room)['sizes']); ?>" src="<?php echo get_field('image', $room)['sizes']['cw_medium']; ?>" alt="<?php echo get_the_title($room); ?>" loading="lazy">
                        <div class="details | u-rel">

                            <?php if ($num_slides > 1) : ?>
                                <div class="slick-arrows | d-flex justify-content-between align-items-center d-sm-none">
                                    <img src="<?php echo get_icon('arrow--button--grey.svg'); ?>" class="arrow arrow--prev js-slick-prev" alt="arrow">
                                    <img src="<?php echo get_icon('arrow--button--grey.svg'); ?>" class="arrow arrow--next js-slick-next" alt="arrow">
                                </div>
                            <?php endif; ?>

                            <h2><?php echo get_the_title($room); ?></h2>
                            
                            <?php if (get_field('description', $room)) : ?>
                                <p class="description"><?php echo get_field('description', $room); ?></p>
                            <?php endif; ?>
                            
                            <div class="buttons">
                                <?php 
                                    // PHASE2
                                    // Book as non-member button 
                                    // $tel = get_field('phone_number', get_field('location', $room)[0]);
                                    // $email = get_field('email', get_field('location', $room)[0]);

                                    // $btn_data = array(
                                    //     'button_type' => 'custom',
                                    //     'class' => 'js-mr-modal-open',
                                    //     'title' => pll__('Book Now'),
                                    //     'data_attr' => 'data-email="' . $email . '" data-tel="' . $tel . '"',
                                    // );
                                    // echo get_button(null, null, null, $btn_data);
                                ?>

                                <?php 
                                    // Book as member button
                                    if (get_field('operate_bookings_url', 'option')) {
                                        $btn_data = array(
                                            'button_type' => 'link',
                                            'data_attr' => 'id="book-as-member"',
                                            'link' => array(
                                                'title' => pll__('Book as member'),
                                                'url' => get_field('operate_bookings_url', 'option'),
                                                'target' => '_blank',
                                            ),
                                        );
                                        echo get_button(null, null, 'small', $btn_data);
                                    }

                                    // Book as non-member button
                                    $tel = get_field('phone_number', get_field('location', $room)[0]);
                                    $email = get_field('email', get_field('location', $room)[0]);

                                    if ($tel || $email) {
                                        $btn_data = array(
                                            'button_type' => 'custom',
                                            'class' => 'js-mr-modal-open',
                                            'title' => pll__('Book as non-member'),
                                            'data_attr' => 'id="book-as-non-member" data-email="' . $email . '" data-tel="' . $tel . '"',
                                        );
                                        echo get_button('white', null, 'small', $btn_data);
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php $i++; endforeach;
            ?>
        </div>
        
        <?php if ($num_slides > 1) : ?>
            <img src="<?php echo get_icon('arrow--button--grey.svg'); ?>" class="arrow arrow--prev js-hov js-mr-arrow-prev" alt="arrow">
            <img src="<?php echo get_icon('arrow--button--grey.svg'); ?>" class="arrow arrow--next js-hov js-mr-arrow-next" alt="arrow">
        <?php endif; ?>

    </div>
</section>