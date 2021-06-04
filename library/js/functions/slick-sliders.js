/**
 * Slick navigation
 */

function slickNavigation() {
	$(".js-slick-next").on("click", function(e) {
		e.preventDefault();
		$(this)
			.closest("section")
			.find(".slick-initialized")
			.slick("slickNext");
	});
	$(".js-slick-prev").on("click", function(e) {
		e.preventDefault();
		$(this)
			.closest("section")
			.find(".slick-initialized")
			.slick("slickPrev");
	});
}

/**
 * Pricing columns slider
 */
function pricingColumnsSlider() {
	let slickArgs = {
		arrows: false,
		dots: false,
		slidesToShow: 1,
		slidesToScroll: 1,
		infinite: true,
		mobileFirst: true
	};

	if ($(".js-pricing-cols-slider").length) {
		slickArgs.responsive = [
			{
				breakpoint: 768,
				settings: {
					dots: true,
					slidesToShow: 2
				}
			},
			{
				breakpoint: 992,
				settings: {
					dots: true,
					slidesToShow: 3
				}
			}
		];
		$(".js-pricing-cols-slider").slick(slickArgs);
	}

	if ($(".js-pricing-cols-slider--mobile-only").length) {
		slickArgs.responsive = [
			{
				breakpoint: 768,
				settings: {
					dots: true,
					slidesToShow: 2
				}
			},
			{
				breakpoint: 992,
				settings: "unslick"
			}
		];
		$(".js-pricing-cols-slider--mobile-only").slick(slickArgs);
	}
}

/**
 * Image slider
 */

function imageSlider() {
	if ($(".js-image-slider").length) {
		$(".js-image-slider").slick({
			arrows: false,
			dots: true,
			fade: true,
			speed: 850,
			autoplay: true,
			autoplaySpeed: 3000,
			pauseOnHover: false
		});
	}
}

/**
 * Image slider
 */

function clientLogosSlider() {
	if ($(".js-logos-slider").length) {
		$(".js-logos-slider").slick({
			arrows: false,
			dots: false,
			speed: 400,
			autoplay: true,
			autoplaySpeed: 1750,
			draggable: false,
			pauseOnHover: false,
			slidesToShow: 2,
			slidesToScroll: 1,
			mobileFirst: true,
			responsive: [
				{
					breakpoint: 400,
					settings: {
						slidesToShow: 3
					}
				},
				{
					breakpoint: 640,
					settings: {
						slidesToShow: 4
					}
				},
				{
					breakpoint: 800,
					settings: {
						slidesToShow: 5
					}
				},
				{
					breakpoint: 991,
					settings: "unslick"
				}
			]
		});
	}
}

/**
 * Team Members Slider
 */

function teamMembersSlider() {
	if ($(".js-team-slider").length) {
		$(".js-team-slider").slick({
			dots: false,
			arrows: false,
			speed: 750,
			autoPlay: true,
			autoplaySpeed: 4000,
			pauseOnHover: false
		});
	}
}

/**
 * Compare Plans mobile slider
 */

function comparePlansSlider() {
	if ($(".js-plans-slider").length) {
		const slider = $(".js-plans-slider");
		const sliderParent = slider.closest(".compare-plans__content");
		let deviceType = "desktop";

		// Init slick if on mobile
		if ($(window).innerWidth() < 992) {
			initSlider();
		}
		function initSlider() {
			slider.slick({
				arrows: false,
				dots: false,
				fade: true,
				mobileFirst: true,
				responsive: [
					{
						breakpoint: 992,
						settings: "unslick"
					}
				]
			});

			deviceType = "mobile";
		}

		// Window resize handler
		$(window).on("resize", function() {
			if ($(window).innerWidth() < 992) {
				$(".js-matchHeight-mob").matchHeight();
				if (deviceType == "desktop") {
					initSlider();
				}
			}

			if ($(window).innerWidth() >= 992) {
				deviceType = "desktop";
				$(".compare-plans__content").removeClass("u-bg-beige-2");
			}
		});

		// Change background colour on slide change
		slider.on("beforeChange", function(
			event,
			slick,
			currentSlide,
			nextSlide
		) {
			if (nextSlide == 1) {
				sliderParent.addClass("u-bg-beige-2");
			} else {
				sliderParent.removeClass("u-bg-beige-2");
			}
		});
	}
}

/**
 * Quote Bubbles mobile slider
 */

function quotesSlider() {
	if ($(window).innerWidth() < 992 && $(".js-quotes-slider").length) {
		$(".js-quotes-slider").slick({
			arrows: false,
			dots: false,
			autoplay: true,
			// fade: true,
			autoPlaySpeed: 7000,
			mobileFirst: true,
			responsive: [
				{
					breakpoint: 992,
					settings: "unslick"
				}
			]
		});
	}
}

/**
 * Neighbourhood mobile slider
 */

function neighbourhoodSlider() {
	if ($(".js-neighbourhood-slider").length) {
		$(".js-neighbourhood-slider").slick({
			arrows: false,
			dots: false,
			autoplay: true,
			autoPlaySpeed: 7000,
			mobileFirst: true,
			responsive: [
				{
					breakpoint: 576,
					settings: {
						slidesToShow: 2
					}
				},
				{
					breakpoint: 992,
					settings: "unslick"
				}
			]
		});
	}
}

/**
 * Image Hover Banner module mobile slider
 */

function hoverBannerMobileSlider() {
	if ($(".js-hover-banner-slider").length) {
		$(".js-hover-banner-slider").slick({
			slidesToShow: 2,
			arrows: false,
			dots: false,
			autoplay: true,
			autoplaySpeed: 5000,
			responsive: [
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 1
					}
				}
			]
		});

		$(".js-hover-banner-slider").on("beforeChange", function(
			event,
			slick,
			currSlide,
			nextSlide
		) {
			const next = "0" + (nextSlide + 1);
			$(this)
				.next()
				.find(".js-current-slide")
				.text(next);
		});
	}
}

/**
 * Testimonials Video slider
 */

function testimonialVideoSlider() {
	if ($(".js-testimonials-video-slider").length > 0) {
		$(".js-testimonials-video-slider").slick({
			dots: true,
			arrows: false,
			autoPlay: false,
			fade: true,
			speed: 800
		});

		$(".js-testimonials-video-slider").on("beforeChange", function(
			e,
			slick,
			currSlide,
			nextSlide
		) {
			// Make next slide start autoplaying
			const nextSlideVideo = $(
				`.testimonials-slider__slide[data-slick-index="${nextSlide}"]`
			).find("video");
			nextSlideVideo.prop("autoplay", true);
			nextSlideVideo.get(0).play();

			// Make current slide stop autoplaying
			const currSlideVideo = $(
				`.testimonials-slider__slide[data-slick-index="${currSlide}"]`
			).find("video");
			currSlideVideo.prop("autoplay", false);
			currSlideVideo.get(0).pause();
		});
	}
}

/**
 * Hero Slider
 * Has two connected slick sliders, thumbnail slider and the main bg image slider
 */

function heroSlider() {
	// Init main slider
	if ($(".js-hero-slider").length) {
		$(".js-hero-slider").slick({
			fade: true,
			speed: 750,
			dots: false,
			arrows: false,
			autoplay: true,
			pauseOnHover: false,
			autoplaySpeed: 4000,
			asNavFor: ".js-hero-thumbs"
		});
	}

	// Init thumbnail slider
	if ($(".js-hero-thumbs").length) {
		$(".js-hero-thumbs").slick({
			speed: 750,
			dots: false,
			arrows: false,
			autoplay: false,
			slidesToShow: 3,
			slidesToScroll: 1,
			draggable: false,
			infinite: true,
			focusOnSelect: false,
			asNavFor: ".js-hero-slider"
		});
	}
}
