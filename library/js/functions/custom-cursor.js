function customCursor() {
    
    let cursorInit = false;

    // Init cursor
    $(document).on('mousemove', function(e) {
        if (! cursorInit) {
            gsap.to('.js-cursor-default', {
                duration: .5,
                scale: 1,
            })
            
            cursorInit = true;
        }

        gsap.set('.js-cursor-wrap', {
            x: e.clientX,
            y: e.clientY,
        })
    })

    // Hover effect.
    const hoverElems = 
        'a, .selectric, .selectric-items li, input, textarea, select, .noUi-connects, .noUi-origin, .js-hov, .slick-dots button, .slick-arrows .arrow';
    $(document).on('mouseenter', hoverElems, function() {
        gsap.to('.js-cursor-default', {
            duration: .35,
            scale: 2,
        });
        // $('body').addClass('no-cursor');
    })
    $(document).on('mouseleave', hoverElems, function() {
        gsap.to('.js-cursor-default', {
            duration: .35,
            scale: 1,
        });
        // $('body').removeClass('no-cursor');
    })

    // Hero video hover effect.
    const playIconHoverElems = '.js-hero-video, .js-hero-overlay';
    $(playIconHoverElems).on('mouseenter', function() {
        if ($('.hero').hasClass('has-video')) {
            $('.js-cursor-wrap').addClass('close-cursor');
        } else {
            $('.js-cursor-wrap').addClass('play-cursor');
        }
    })
    $(playIconHoverElems).on('mouseleave', function() {
        $('.js-cursor-wrap').removeClass('play-cursor close-cursor');
    })
        
}
