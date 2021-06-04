<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 */

get_header();

// Hero
$mod_num = 1;
$m = array();
$m['image'] = get_field('404_hero_image', 'option');
$m['gradient'] = true;
$m['heading'] = get_field('404_text', 'option');
include('modules/hero.php');
	
get_footer();
