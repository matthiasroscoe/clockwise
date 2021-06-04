<?php get_header();

// Get hero module
$m = array(
	'heading' => pll__('Referee Form'),
    'image' => get_field('referee_form', 'option')['header_image'],
    'text' => get_field('referee_form', 'option')['introduction'],
	'mobile_image' => get_field('referee_form', 'option')['header_image_mobile'],
);
include('modules/hero.php');

$m['form'] = 'referee_form';
$m['form_title'] = pll__('Referee Form');
include('modules/hubspot_form.php');
?>

	

<?php get_footer();
