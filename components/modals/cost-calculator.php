<div class="c-calc-modal js-calc-modal js-modal">
    <div class="c-calc-modal__inner">

        <div class="c-calc-modal__header js-calc-header | container-xxl">
            <div class="row align-items-center justify-content-lg-between">
                <div class="logo | d-flex align-items-center col-auto">
                    <a class="d-flex align-items-center justify-content-center" href="<?php echo get_site_url(); ?>">
                        <img src="<?php echo get_icon('logo-icon--navy.svg'); ?>" alt="Clockwise">
                    </a>
                </div>

                <div class="new-search | col-auto d-lg-none d-flex flex-center text-center">
                    <a href="#" class="js-modal-close | text-upper" data-barba-prevent>< <?php pll_e('New Search'); ?></a>
                </div>

                <div class="close | u-rel col-auto text-right">
                    <a href="#" class="js-modal-close" data-barba-prevent>
                        <img src="<?php echo get_icon('close-modal.svg'); ?>" alt="close modal">
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?php // Mobile tabs ?>
                    <div class="tabs js-setup-tabs | d-flex d-lg-none">
                        <div class="tab js-hov js-calc-tab is-active | d-flex flex-center" data-type="traditional"><?php pll_e('Traditional leases'); ?></div>
                        <div class="tab js-hov js-calc-tab | d-flex flex-center" data-type="flexible"><?php pll_e('Flexible office'); ?></div>
                    </div>
                </div>
            </div>
        </div>

        <?php if (get_field('show_newsletter', 'option')) : 
            $form = 'calc_form';
            $portal_id = get_field($form, 'option')['portal_id'];
            $form_id = get_field($form, 'option')['form_id'];

            if ($portal_id && $form_id) :
                ?>
                <div class="c-calc-modal__newsletter">
                    <div class="c-calc-modal__content | container-lg">
                        <div class="row justify-content-lg-center">
                            <div class="c-calc-modal__newsletter__inner | col px-lg-0">
                                <h1><?php echo get_field('calc_form_heading', 'option'); ?></h1>      

                                <div class="c-calc-modal__newsletter__form c-hbspt-form js-hs-form-container" data-portal-id="<?php echo $portal_id; ?>" data-form-id="<?php echo $form_id; ?>"></div>

                                <?php if (get_field('calc_small_text', 'option')) : ?>
                                    <div class="legal-text">
                                        <?php echo get_field('calc_small_text', 'option'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; 
            endif;
        ?>
    </div>
</div>