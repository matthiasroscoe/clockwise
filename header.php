<!doctype html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	
	<?php // force Internet Explorer to use the latest rendering engine available ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">

	<!-- FB Domain Verification -->
	<meta name="facebook-domain-verification" content="fvd3mtxjyxx1pzf5d6fvhu1dlwybyl" />

	<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon.jpg">
	<!--[if IE]>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
	<![endif]-->
	<?php // or, set /favicon.ico for IE10 win ?>

	<?php // Preload fonts ?>
	<link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/library/fonts/gt-walsheim/GTWalsheim-Light.woff2" as="font" crossorigin="anonymous">
	<link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/library/fonts/gt-walsheim/GTWalsheimMedium.woff2" as="font" crossorigin="anonymous">
	<link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/library/fonts/gt-walsheim/GTWalsheim.woff2" as="font" crossorigin="anonymous">

	<?php wp_head(); ?>

	<!-- Facebook Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window,document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '2168024763440380');
	fbq('track', 'PageView');
	</script>
	<noscript>
	<img height="1" width="1"
	src="https://www.facebook.com/tr?id=2168024763440380&ev=PageView
	&noscript=1"/>
	</noscript>
	<!-- End Facebook Pixel Code -->

	<!-- Linkedin Insights Code -->
	<script type="text/javascript">
	_linkedin_partner_id = "521812";
	window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
	window._linkedin_data_partner_ids.push(_linkedin_partner_id);
	</script><script type="text/javascript">
	(function(){var s = document.getElementsByTagName("script")[0];
	var b = document.createElement("script");
	b.type = "text/javascript";b.async = true;
	b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
	s.parentNode.insertBefore(b, s);})();
	</script>
	<noscript>
	<img height="1" width="1" style="display:none;" alt="" src="https://dc.ads.linkedin.com/collect/?pid=521812&fmt=gif" />
	</noscript>
	<!-- End Linkedin Insights Code -->

	<!-- Google Tag Manager -->
	<?php $gtm_id = get_field('gtm_id', 'option'); ?>

	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer',<?php echo "'" . $gtm_id . "'"; ?>);</script>
	<!-- End Google Tag Manager -->

	<?php
		if ( is_singular('location') && get_field('scheme') ) { ?>
			<!-- Location Schema -->
			<script type='application/ld+json'>
				<?php echo get_field('scheme'); ?>
			</script>
			<!-- End Location Schema -->
		<?php }
	?>
</head>

<body <?php body_class(); ?> data-barba="wrapper">

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $gtm_id; ?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


<div id="page" class="site">

	<?php 
		if (is_tax('regions') || (is_single() && get_post_type() == 'location')) {
    	    $page_transition_text = pll__('Locations');
		} else if (get_field('page_transition_text')) {
			$page_transition_text = get_field('page_transition_text');
		} else {
			$page_transition_text = 'Clockwise';
		}
	?>
	<div id="content" class="site-content u-rel" data-barba="container" data-barba-namespace="default" data-current-language="<?php echo pll_current_language(); ?>" data-page-transition-text="<?php echo $page_transition_text; ?>">
		
		<div class="c-cursor js-cursor-wrap">
			<div class="cursor js-cursor-default"></div>
			<div class="cursor js-cursor-play"></div>
			<div class="cursor js-cursor-close"></div>
		</div>

		<header id="site-header">
			
			<?php include('components/topbar.php'); ?>

			<div class="header-inner | container-xl">
				<div class="row">
					<div class="header-logo | d-flex align-items-center col col-lg-auto">
						<a class="d-flex align-items-center justify-content-center" href="<?php echo get_site_url(); ?>">
							<?php include(get_stylesheet_directory() . '/inc/svgs/clockwise.php'); ?>	
						</a>
					</div>

					<div class="c-lang-switcher | d-flex flex-center flex-column order-lg-3 col-auto u-rel">
						<?php
							// Disabling language selector for launch.
							// Remove outer if statement to enable once content is ready.
							if (is_user_logged_in()) {
								$language_data = pll_the_languages(array('raw' => 1,)); 
								
								// Get the current language, and any other languages for which translations are available
								$languages_with_translations = array();
								foreach($language_data as $lang) {
									if ($lang['current_lang'] == true) {
										$current_lang = $lang;
									} else if ($lang['no_translation'] == false) {
										$languages_with_translations[] = $lang;
									}
								}
								
								// Display lang switcher
								if (! empty($languages_with_translations)) : ?>

									<div class="c-lang-switcher__current js-lang-switcher | d-flex align-items-center u-rel">
										<img class="flag" src="<?php echo $current_lang['flag']; ?>" alt="<?php echo $current_lang['name']; ?>">
									</div>
									<div class="c-lang-switcher__dropdown js-langs">
										<?php foreach($languages_with_translations as $lang) : ?>
											<a class="c-lang-switcher__lang | d-flex align-items-start" href="<?php echo $lang['url']; ?>" title="<?php echo $lang['name']; ?>">
												<img class="c-lang-switcher__flag" src="<?php echo $lang['flag']; ?>" alt="<?php echo $lang['name']; ?>">
												<span class="text-upper"><?php echo $lang['name']; ?></span>
											</a>
										<?php endforeach; ?>
									</div>
								<?php endif;
							}
						?>
					</div>

					<div class="header-hamburger | order-lg-4 col-auto">
						<div class="hamburger js-nav-toggle js-hamburger js-hov">
							<span class="l1"></span>
							<span class="l2"></span>
							<span class="l3"></span>
						</div>
					</div>
		
					<div class="header-menu | d-flex justify-content-between justify-content-lg-end text-center order-lg-2 col-12 col-lg px-3">
						<a href="#" data-barba-prevent class="header-menu__link js-modal-open | u-rel d-flex align-items-center text-upper mx-lg-3" data-modal-type="enquiry_form"><?php pll_e('Become a member'); ?></a>

						<?php $meet_room_post = pll_get_post('151', pll_current_language()); ?>
						<a href="<?php echo get_permalink($meet_room_post); ?>" class="header-menu__link | u-rel d-flex align-items-center text-upper mx-lg-3"><?php pll_e('Book a meeting room'); ?></a>
						
						<a href="<?php echo get_field('operate_login_url', 'option'); ?>" target="_blank" class="header-menu__link header-menu__link--login | u-rel text-upper d-flex align-items-center mx-lg-3">
							<?php pll_e('Member Login'); ?>
							<?php include(get_stylesheet_directory() . '/inc/svgs/login.php'); ?>
						</a>
					</div>
				</div>
			</div>
		</header>

		<div id="primary" class="content-area u-rel">
			<main id="main" class="site-main u-rel">
