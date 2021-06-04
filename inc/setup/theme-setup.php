<?php
if ( ! function_exists( 'custom_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function custom_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on this, use a find and replace
		 * to change the theme name referenced here to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'clockwise', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'clockwise' ),
			'Locations' => esc_html__( 'Locations', 'clockwise'),
			'quick-links' => esc_html__( 'Quick Links', 'clockwise'),
			'memberships' => esc_html__( 'Memberships', 'clockwise'),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add image sizes
		add_image_size('thumb', 256, 256, false);
		add_image_size('cw_small', 450, 450, false);
		add_image_size('cw_600', 600, 600, false);
		add_image_size('cw_medium', 800, 800, false);
		add_image_size('big', 1400, 800, false);
		add_image_size('hero', 2250, 1200, false);

		// Add media library support for webp
		function webp_upload_mimes($existing_mimes) {
			$existing_mimes['webp'] = 'image/webp';
			return $existing_mimes;
		}
		add_filter('mime_types', 'webp_upload_mimes');

	}
endif;
add_action( 'after_setup_theme', 'custom_theme_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function edit_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'edit_content_width', 640 );
}
add_action( 'after_setup_theme', 'edit_content_width', 0 );



/**
 * Remove Posts and Comments from CMS
 */
add_action( 'admin_menu', 'remove_menus' );
function remove_menus() {
	remove_menu_page( 'edit-comments.php' );
	remove_menu_page( 'edit.php' ); 
}



/**
 * Add ACF Options page
 */

function setup_options() {

 	if(function_exists('acf_add_options_page')) {
	 	$parent = acf_add_options_page(array(
			'page_title'  => 'CW Options',
			'menu_title'  => 'CW Options',
			'menu_slug'   => 'options',
			'capability'  => 'manage_options',
			'redirect'    => false,
		));
	}

	if( function_exists('acf_add_options_sub_page') ) {
		$child = acf_add_options_sub_page(array(
			'page_title'  => 'Navigation Menus',
			'menu_title'  => 'Navigation Menus',
			'parent_slug' => $parent['menu_slug'],
		));
	}
	
	if( function_exists('acf_add_options_sub_page') ) {
		$child = acf_add_options_sub_page(array(
			'page_title'  => 'Hubspot Forms',
			'menu_title'  => 'Hubspot Forms',
			'parent_slug' => $parent['menu_slug'],
		));
	}

	if( function_exists('acf_add_options_sub_page') ) {
		$child = acf_add_options_sub_page(array(
			'page_title'  => 'Operate Settings',
			'menu_title'  => 'Operate Settings',
			'parent_slug' => $parent['menu_slug'],
		));
	}

	if( function_exists('acf_add_options_sub_page') ) {
		$child = acf_add_options_sub_page(array(
			'page_title'  => 'Cost Calculator Settings',
			'menu_title'  => 'Cost Calculator Settings',
			'parent_slug' => $parent['menu_slug'],
		));
	}

	if( function_exists('acf_add_options_sub_page') ) {
		$child = acf_add_options_sub_page(array(
			'page_title'  => '404 Page',
			'menu_title'  => '404 Page',
			'parent_slug' => $parent['menu_slug'],
		));
	}

	if( function_exists('acf_add_options_sub_page') ) {
		$child = acf_add_options_sub_page(array(
			'page_title'  => 'Developer Settings',
			'menu_title'  => 'Developer Settings',
			'parent_slug' => $parent['menu_slug'],
		));
	}
}

add_action('init', 'setup_options');



/**
 * Enabling Google Maps for ACF
 */
add_filter('acf/fields/google_map/api', 'acf_google_maps_api');

function acf_google_maps_api( $api ){
    $api['key'] = get_field('google_api_key', 'option');
    return $api;
}




/**
 * Additional styling for ACF
 */
add_action('acf/input/admin_head', 'custom_acf_css');

function custom_acf_css() { 
	include(get_stylesheet_directory() . '/inc/setup/acf-css.php');
}



/**
 * Admin Bar Tweak. 
 * 
 * This changes the default CSS added by WordPress to place the admin bar margin in 
 * the body element instead of the html element.
 */

add_theme_support( 'admin-bar', array( 'callback' => 'my_admin_bar_css') );

function my_admin_bar_css() { ?>
	<style type="text/css" media="screen">	
		html , html body { margin-top: 0 !important; }
	</style>
<?php } 



/**
 * Moves YOAST panel to bottom when editing posts/pages/etc
 */
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');
function yoasttobottom() {
	return 'low';
}


?>
