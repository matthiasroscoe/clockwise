<?php 
$title = pll__('Download a Brochure');
$intro = pll__('Fill out your details below and we’ll send the brochure to your inbox.');

$form = 'brochure_form'; // ACF options page field for the form
$portal_id = get_field($form, 'option')['portal_id'];
$form_id = get_field($form, 'option')['form_id'];

// Display form
if ($portal_id && $form_id) {
    echo get_hubspot_modal($title, $form, $portal_id, $form_id, $intro);
}
?>
