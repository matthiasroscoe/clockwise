<?php
/**
 * Generates the HTML for the hubspot modals
 * @param form. Needs to be the ACF options page field for the form.
 */

function get_hubspot_modal($title = null, $form = null, $portal_id = null, $form_id = null, $intro = null) {
    if ($title == NULL || $form == NULL || $portal_id == NULL || $form_id == null) {
        return;
    }
    
    ob_start();
    ?>
        <div class="c-hs-modal js-modal" data-modal-type="<?php echo $form; ?>">
            <div class="c-hs-modal__inner">

                <?php include(get_stylesheet_directory() . '/components/modals/hs-modal-header.php'); ?>

                <div class="c-hs-modal__form | container-lg">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <h1 class="text-center <?php if ($intro != null) { echo 'mb-3'; } ?>"><?php echo $title; ?></h1>
                            <?php if ($intro != null) : ?>
                                <p class="c-hs-modal__form__intro text-center mb-5"><?php echo $intro; ?></p>
                            <?php endif; ?>
                            
                            <div class="c-hbspt-form js-hs-form-container" data-portal-id="<?php echo $portal_id; ?>" data-form-id="<?php echo $form_id; ?>"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    
    return ob_get_clean();
}


/**
 * Get small/windowed modal
 */

function get_small_modal($content = null, $classlist = null) {
    if ($content == null) {
        return;
    }

    ob_start();
    ?> 
        <div class="c-small-modal <?php echo $classlist; ?>">
            <div class="c-small-modal__inner">
                <img class="c-small-modal__close js-mr-modal-close js-hov" src="<?php echo get_icon('close-modal.svg'); ?>" alt="Close modal">
                <div class="c-small-modal__content">
                    <?php echo $content; ?>
                </div>
            </div>
        </div>
    <?php
    $html = ob_get_clean();
    return $html;
}
?>