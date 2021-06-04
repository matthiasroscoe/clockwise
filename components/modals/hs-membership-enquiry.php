<?php 
$title = pll__('Enquiry Form');
if (is_single() && get_post_type() == 'location') {
    $title = pll__('Enquiry Form');
}

$form = 'enquiry_form'; // ACF options page field for the form
$portal_id = get_field($form, 'option')['portal_id'];
$form_id = get_field($form, 'option')['form_id'];

// Display form
if ($portal_id && $form_id) {
    echo get_hubspot_modal($title, $form, $portal_id, $form_id);
}
?>
