<?php
/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'enqueue_css_js' );
function enqueue_css_js() {
	// Enqueue main stylesheet.
	wp_enqueue_style( 'styles', get_template_directory_uri() . '/library/dist/css/styles.min.css' );

	// Enqueue main js file.
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/library/dist/js/main.min.js?debug='.date('U'), array('jquery'), '', true );
	wp_localize_script( 'main-js', 'scriptVars', array(
		'ajaxUrl'  => admin_url('admin-ajax.php'),
		'siteUrl'  => get_site_url(),
		) 
	);	

	// Enqueuing GSAP js. IE 11 throws errors when Babel compiles GSAP with main.js so doing this separately to avoid IE11 bugs.
	wp_enqueue_script( 'gsap-js', get_template_directory_uri() . '/library/dist/js/gsap.min.js?debug='.date('U'), array('jquery'), '', true );
}

/**
 * Remove Gutenberg Block Library CSS from loading on the frontend
 */

function remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' );
} 
add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );


?>
