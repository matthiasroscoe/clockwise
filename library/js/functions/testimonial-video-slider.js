/**
 * Trigger autoplay when testimonials video slider appears in window
 * Helps page load speed time as the videos don't get preloaded on page-load
 */

function triggerTestimonialVideoAutoplay() {
    if ($('.js-testimonial-intro-video').length) {
        
        let scrollTop, testimonialsTopOffset, autoPlayStarted = false;
        const videos = $('.js-testimonial-intro-video');

        $(window).on('resize load scroll', function(e) {
            if (!autoPlayStarted) {
                scrollTop = $(window).scrollTop() + $(window).height();
                testimonialsTopOffset = $('.testimonials-slider').offset().top;
    
                if (scrollTop > (testimonialsTopOffset - 300)) {
                    videos.each(function(i, item) {
                        $(item).get(0).load();
                        $(item).prop('autoplay', true);
                        $(item).get(0).play();
                        autoPlayStarted = true;
                    })
                }
            }
        })
    }

}


/**
 * Toggle on/off videos on testimonials video slider module
 */
function toggleTestimonialVideoModals() {
    
    if ($('.js-play-testimonial-video').length < 1) {
        return;
    }

    const testModal = $('.js-test-modal'),
          video = document.querySelector('.js-test-modal-vid');

    // Open video
    $('.js-play-testimonial-video').on('click', function(e) {
        e.preventDefault();

        const videoSrc = $(this).data('href');

        if (! videoSrc > '') {
            console.error('No video available');
        } else {
            video.src = videoSrc;
            video.load();
            video.play();
    
            gsap.to(testModal, {
                autoAlpha: 1,
                duration: 1.25,
                ease: Power3.easeOut,
            });

            // testModal.addClass('is-active');
            $('body').addClass('no-scroll');
            $('.js-cursor-wrap').addClass('close-cursor');
        }
    });

    // Close video
    function closeTestVideo() {
        video.pause();
        
        gsap.to(testModal, {
            autoAlpha: 0,
            duration: 1.25,
            ease: Power3.easeOut,
        });

        // testModal.removeClass('is-active');
        $('body').removeClass('no-scroll');
        $('.js-cursor-wrap').removeClass('close-cursor');
    }
    
    $('.js-test-modal-vid, .js-test-modal-close').on('click', function(e) {
        e.preventDefault();
        closeTestVideo();
    });
    
    $(document).on('keydown', function(e) {
        if (e.keyCode == 27) {
            closeTestVideo();
        }
    })

}