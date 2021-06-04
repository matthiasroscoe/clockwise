<section class="hs-form-wrapper <?php if ($m['has_dropdown']) { echo 'has-dropdown u-bg-beige-2'; } ?> module module-<?php echo $mod_num; ?>" data-form-type="<?php echo $m['form']; ?>">
    
    <?php if ($m['has_dropdown']) : ?>
        <div class="container-lg">
            <div class="row">
                <div class="hs-form-wrapper__dropdown | col-xxl-10 offset-xxl-1 d-flex align-items-center justify-content-between">
                    <?php if ($m['form_title']) : ?>
                        <h1 class="mb-0 pr-3"><?php echo $m['form_title']; ?></h1>
                    <?php endif; ?>

                    <?php if ($m['form_subheading']) : ?>
                        <p class="d-none d-lg-block mb-0 pr-3"><?php echo $m['form_subheading']; ?></p>
                    <?php endif; ?>
                    
                    <div class="toggle-icon js-hs-form-toggle js-hov | u-rel">
                        <span class="line line-1"></span>
                        <span class="line line-2"></span>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    
    <div class="hs-form-wrapper__form js-hs-form | container-lg">
        <div class="row justify-content-center">
            <div class="hs-form__inner | col-lg-10">
                
                <?php if ($m['form_title'] && ! $m['has_dropdown']) : ?>
                    <div class="hs-form__headings | mb-lg-5 pb-lg-2">
                        <h1 class="text-center mb-3"><?php echo $m['form_title']; ?></h1>

                        <?php if ($m['form'] == 'referee_form') : ?>
                            <p class="text-center mb-2"><?php echo pll__('You have been referred to Clockwise by: ') . '<span class="fw-500">' . get_the_title() . '</span>'; ?></p>
                            <p class="text-center mb-5 mb-lg-2"><?php pll_e('Please complete the form below and a member of our team will be in touch.'); ?></p>
                        <?php endif; ?>
                        
                        <?php if ($m['introduction']) : ?>
                            <p class="text-center mb-2"><?php echo $m['introduction']; ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <?php 
                // Creating the hubspot forms with custom js rather than just adding the hs scripts inline
                // Needed as with barba the scripts don't fire on page load. 
                $referrer_email_str = (get_field('referrer_email')) ? 'data-referrer-email="' . get_field('referrer_email') . '"' : '';

                $portal_id = get_field('hs_portal_id', 'option');
                if ($m['form'] == 'custom') {
                    $form_id = $m['custom_form_id'];
                } else {
                    $form_id = get_field($m['form'], 'option')['form_id'];
                }
                
                ?>
                <div class="c-hbspt-form js-hs-form-container" data-portal-id="<?php echo $portal_id ?>" data-form-id="<?php echo $form_id; ?>" data-form="<?php echo $m['form']; ?>" <?php echo $referrer_email_str; ?>></div>

            </div>
        </div>
    </div>
</section>