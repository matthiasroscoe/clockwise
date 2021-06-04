<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
?>
			</main><!-- #main -->

			<footer id="site-footer">
				<div class="footer | d-flex flex-column justify-content-start text-white">

					<div class="footer-top | container-lg">
						<div class="row">
							<div class="col-12">
								<a href="<?php echo get_site_url(); ?>" title="Clockwise">
									<img src="<?php echo get_icon('logo-icon.svg'); ?>" class="logo logo--icon" alt="Clockwise" loading="lazy">
								</a>
							</div>
						</div>
					</div>
			
					<div class="footer-main container-lg">
						<div class="row">
							<div class="footer__col footer__col--locations | col-lg-3">
								<?php $locations_page = pll_get_post('860', pll_current_language()); ?>
								<a href="<?php echo get_permalink($locations_page); ?>" class="subheading"><?php pll_e('Locations'); ?></a>
								
								<?php // Regions links
									$regions = get_terms(array(
										'taxonomy' => 'regions',
										'parent' => 0,
									));
			
									foreach($regions as $reg) : ?>
										<a href="<?php echo get_term_link($reg->term_id); ?>" title="<?php echo $reg->name; ?>"><span><?php echo $reg->name; ?></span></a>
									<?php endforeach; 
								?>
							</div>
							<div class="footer__col d-none d-lg-flex | col-lg-2">
								<?php if (get_field('memberships_links', 'option')) : ?>
									<?php $memb_page = pll_get_post('112', pll_current_language()); ?>
									
									<a href="<?php echo get_permalink($memb_page); ?>" class="subheading">Memberships</a>
									
									<?php foreach(get_field('memberships_links', 'option') as $link) : $link = $link['link']; ?>
										<a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" title="<?php echo $link['title']; ?>"><span><?php echo $link['title']; ?></span></a>
									<?php endforeach; ?>

								<?php endif; ?>
							</div>
							<div class="footer__col | col-lg-3">
								<?php if (get_field('quick_links', 'option')) : ?>
									<p class="subheading">Quick Links</p>
									
									<?php foreach(get_field('quick_links', 'option') as $link) : 
										$link = $link['link'];
										$ql_class = ($link['mobile_only']) ? 'd-lg-none' : '';
										?>
										<a class="<?php echo $ql_class; ?>" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" title="<?php echo $link['title']; ?>"><span><?php echo $link['title']; ?></span></a>
									<?php endforeach; ?>

								<?php endif; ?>
							</div>

							<?php if (get_field('newsletter_form', 'option')) : ?>
								<div class="footer__col footer__col--newsletter | col-lg-4">
									<p class="subheading">Newsletter</p>
									<?php 
										$form = 'newsletter_form';
										$portal_id = get_field($form, 'option')['portal_id'];
										$form_id = get_field($form, 'option')['form_id'];

										if ($portal_id && $form_id) : ?>
											<div class="footer__newsletter">
												<div class="c-hbspt-form js-hs-form-container" data-portal-id="<?php echo $portal_id; ?>" data-form-id="<?php echo $form_id; ?>"></div>
											</div>
										<?php endif; 
									?>
								</div>
							<?php endif; ?>
						</div>
					</div>
			
					<div class="footer-bottom | container-lg d-flex flex-column justify-content-end">
						<div class="row flex-column flex-lg-row">
							<div class="footer__socials | col-lg-3 col-xl-4 d-flex align-items-center">
								<?php 
									$socials = get_field('socials', 'option');

									foreach($socials as $soc) : ?>
										<a class="d-block" href="<?php echo $soc['url']; ?>" title="<?php echo $soc['account']; ?>" target="_blank">
											<img src="<?php echo $soc['icon']; ?>" alt="<?php echo $soc['account']; ?>" loading="lazy">
										</a>
									<?php endforeach;
								?>
							</div>
							<div class="tertiary-links | col-lg-9 col-xl-8 d-flex flex-row flex-wrap justify-content-lg-end align-items-center">
								<p class="mb-0">&copy; Clockwise <?php echo date('Y'); ?></p>
								
								<?php foreach(get_field('legal_links', 'option') as $link) : $link = $link['link'];?>
									<span class="line"></span>
									<a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" title="<?php echo $link['title']; ?>"><?php echo $link['title']; ?></a>
								<?php endforeach; ?>

								<span class="line"></span>

								<a class="mr-0" href="https://ignitecreates.com" target="_blank">Website by Ignite</a>
							</div>
						</div>
					</div>
					
				</div>

			</footer><!-- #colophon -->

		</div><!-- #primary -->
		
		<?php 
			// overlay nav
			include('components/nav/nav.php'); 
			
			// scroll-to-top sticky link
			include('components/scroll-to-top.php'); 

			// Brochure Form modal
			if (is_single() && get_post_type() == 'location') {
				include('components/modals/hs-brochure.php');
			}

			// Referral Form modal
			$referral_page_id = pll_get_post('771', pll_current_language());
			if (get_the_ID() == $referral_page_id) {
				include('components/modals/hs-referral.php');
			}
			
			// Cost Calculator modal
			$calculator_page_id = pll_get_post('1056', pll_current_language());
			if (get_the_ID() == $calculator_page_id) {
				include('components/modals/cost-calculator.php');
			}
		?>

	</div><!-- #content -->

	<?php 
		/** 
		 * Components to sit outside of Barba wrapper 
		 */

		// Cookie Banner
		include('components/cookie-banner.php');

		// Full-screen hubspot modals
		include('components/modals/hs-membership-enquiry.php');
		include('components/modals/hs-book-tour.php');

		// meeting room booking modal
		include('components/modals/meeting-room-modal.php');

		// Testimonials video modal
		include('components/modals/testimonials-video.php');

		// Barba animation html
		include('components/page-transition.php');
	?>

</div><!-- #page -->

<?php // Hubspot & Google Maps JS moved to footer to play well with Barba ?>
<!--[if lte IE 8]>
<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
<![endif]-->
<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/6003718.js"></script>

<?php $api_key = get_field('google_api_key', 'option'); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $api_key; ?>"></script>

<!-- <script src="<?php echo get_stylesheet_directory_uri(); ?>/library/js/iefix.js"></script> -->
<!-- <script src="<?php echo get_stylesheet_directory_uri(); ?>/library/js/gsap/DrawSVGPlugin.js"></script> -->

<?php wp_footer(); ?>


</body>
</html>
