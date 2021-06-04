<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

// Redirect all vacancy posts which are set to link out to an external link
if (is_single() && get_post_type('job_vacancy')) {
	if ( get_field('external_link', get_the_ID()) ) {
		wp_redirect(get_field('external_link', get_the_ID()), );
		exit;
	}
}

// Redirect sub-regions to their parent
if (is_tax('regions')) {
	$parent_id = get_queried_object()->parent;
	if ($parent_id != 0) {
		wp_redirect(get_term_link($parent_id, 'regions'));
		exit;
	}
}

get_header();

render_flexible_content_modules('modules');

get_footer();
