<?php // Meeting Rooms booking modal
ob_start();
?>
    <div class="mr-modal">
        <div class="mr-modal__tabs | d-flex flex-center">
            <div class="tab js-hov js-mr-modal-tab is-active | d-flex flex-center" data-content-type="member"><?php pll_e('Book as Member'); ?></div>
            <div class="tab js-hov js-mr-modal-tab | d-flex flex-center" data-content-type="non-member"><?php pll_e('Book as Non-Member'); ?></div>
        </div>
    
        <div class="mr-modal__content mr-modal__content--member js-mr-modal-content is-active" data-content-type="member">
            <h1><?php pll_e('Access the Member Portal below to book your meeting'); ?></h1>
            <?php 
                // Book as member button
                if (get_field('operate_bookings_url', 'option')) {
                    $btn_data = array(
                        'button_type' => 'link',
                        'link' => array(
                            'title' => pll__('Book as member'),
                            'url' => get_field('operate_bookings_url', 'option'),
                            'target' => '_blank',
                        ),
                    );
                    echo get_button(null, null, null, $btn_data);
                }
            ?>
        </div>
    
        <div class="mr-modal__content js-mr-modal-content" data-content-type="non-member">
            <h1><?php // pll_e('Book room as a non-member'); ?></h1>
            <iframe src="https://workclockwise.member.site/externalbooker.aspx" scrolling="no" height="525" width="280" frameborder="no"></iframe>
    
            <div class="js-mr-modal-tel">
                <h2><?php pll_e('Book via telephone'); ?></h2>
                <p>T: <a href="#" target="_blank" class="js-mr-modal-tel-text" data-barba-prevent></a></p>
            </div>
            <div class="js-mr-modal-email">
                <h2><?php pll_e('Book via email'); ?></h2>
                <p>E: <a href="#" target="_blank" class="js-mr-modal-email-text" data-barba-prevent></a></p>
            </div>
        </div>

    </div>
<?php

$content = ob_get_clean();

echo get_small_modal($content, 'js-mr-modal');
?>