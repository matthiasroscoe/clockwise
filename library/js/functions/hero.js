/**
 * Scroll down links
 */

function heroScrollDownLinks() {
    if ($('.hero__scroll-down').length) {
        $('.hero__scroll-down').on('click', function(e) {
            e.preventDefault();
    
            let belowHeroOffset = $('.hero').outerHeight();
    
            gsap.to(window, {
                duration: 1.5,
                scrollTo: belowHeroOffset,
                ease: Power4.easeInOut,
            });
        })
    }
}


/**
 * Full screen video toggle
 */

function toggleFullScreenVideo() {
    if ($('.hero__video').length) {
        const video = document.querySelector('.js-hero-video'),
              hero = $('.hero'),
              content = $('.js-hero-content'),
              overlay = $('.js-hero-overlay'),
              mobileCloseBtn = $('.hero__video-close'),
              header = $('#site-header');

        let fullscreen = false,
            animating = false;

        $('.hero__video, .js-hero-overlay, .js-mob-video-toggle').on('click', function(e) {

            if ($(window).innerWidth() < 992) {
                if (e.target.classList.contains('js-hero-overlay')) {
                    return;
                }
            }

            // Toggle on video
            if (! fullscreen && ! animating) {
                animating = true;
                
                // Fade out content, fade in overlay
                hero.addClass('has-video');
                content.removeClass('is-active');
                overlay.addClass('is-opaque');
                header.addClass('is-hidden');
                mobileCloseBtn.addClass('is-active');
                

                // Set video to start, unmute video and play
                setTimeout(function() {
                    video.pause();
                    video.currentTime = 0;
                    
                    setTimeout(function() {
                        overlay.removeClass('is-active is-opaque');
                        video.play();
                        $(video).prop('muted', false);
                        // video.setAttribute('controls', true);

                        // Update cursor
                        $('.js-cursor-wrap').addClass('close-cursor');
                        $('.js-cursor-wrap').removeClass('play-cursor');
                        
                        animating = false;
                        fullscreen = true;
                    }, 500)
                }, 500)
            }
            
            // Toggle off video
            if (fullscreen && ! animating) {
                animating = true;

                // Fade in overlay
                overlay.addClass('is-active is-opaque');
                mobileCloseBtn.removeClass('is-active');

                // Reset video to start, mute audio and play
                setTimeout(function() {
                    video.pause();
                    video.currentTime = 0;
                    $(video).prop('muted', true);
                    // video.setAttribute('controls', false);
                    header.removeClass('is-hidden');
                    
                    setTimeout(function() {
                        overlay.removeClass('is-opaque');
                        content.addClass('is-active');
                        hero.removeClass('has-video');
                        video.play();

                        // Update cursor
                        $('.js-cursor-wrap').removeClass('close-cursor');
                        $('.js-cursor-wrap').addClass('play-cursor');

                        fullscreen = false;
                        animating = false;
                    }, 500)
                }, 500)
            }
        })
    }
}



/**
 * Regions dropdown
 */

function heroRegionsDropdown() {
    if ($('.js-hero-loc-select').length) {
        $('.js-hero-loc-select').on('change', function(e) {
            const href = $(this).find(':selected').data('url');
    
            if ($(window).innerWidth() >= 992) {
                if (isBrowserIE()) {
                    window.location.href = href;
                } else {
                    barba.go(href);
                }
            } else {
                $('.selectric').removeClass('loading');
                $('.js-view-location-btn').attr('href', href);
            }
        })
    }
}


/**
 * Article Hero parallax effect
 */

function heroImgParallax() {
    if ($('.js-hero-img-prlx').length > 0) {
        const heroHeight = $('.hero').outerHeight(),
              prlxImg = $('.js-hero-img-prlx');
        
        let scrollTop;
        
        $(window).on('load scroll resize', function(e) {
            scrollTop = $(window).scrollTop();
            if (scrollTop < heroHeight) {
                prlxImg.css('transform', `translateY(${scrollTop / 2}px)`);
            }
        })
    }
}