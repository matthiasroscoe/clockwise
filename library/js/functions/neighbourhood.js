/**
 * Sticky introduction section for the Neighbourhood module
 * Uses GSAP ScrollTrigger: https://greensock.com/docs/v3/Plugins/ScrollTrigger
 */
/*
function neighbourhoodStickyIntro() {
    if (! $('.js-neighbourhood-intro').length) {
        $(window).off('scroll resize load', initAnimation);
    }
    
    if ($('.js-neighbourhood-intro').length > 0 && $(window).innerWidth() > 992) {
        $(window).on('scroll resize load', initAnimation);     
    }   
}

// Sets top padding of module to allow space for the intro to be placed absolutely.
function setTopPadding(padding) {
    $('.neighbourhood').css('padding-top', padding);
}

// Neighbourhood intro scrolling anim
function initAnimation() {
    const intro = $('.js-neighbourhood-intro'),
          neighbourhood = $('.neighbourhood');

    let device = 'mobile';

    let scrollTop, introTopOffset, isStuck = false;

    if ($(window).innerWidth() > 992) {
        if ($('.js-neighbourhood-intro').length) {

            if (device == 'mobile') {
                setTopPadding(intro.outerHeight());
                device = 'desktop';
            }
            
            scrollTop = $(window).scrollTop();
            introTopOffset = $('.neighbourhood').offset().top - 190;
    
            if (scrollTop > introTopOffset) {
                if (!isStuck) {
                    intro.css({
                        'position': 'fixed',
                        'top': '190px',
                    });
                    isStuck = true;
                }
    
                // scrollTop val of the neighbourhood module, starting from the offset top of the module.
                let scrollTopFromIntroPos = scrollTop - introTopOffset,
                    opacity = 1;
                
                // The amount of pixels after the element is fixed by which the element is completely faded
                const fadeElAfter = 350
    
                // Apply fade effect
                if (scrollTopFromIntroPos < (fadeElAfter * 2)) {
                    opacity = 1 - scrollTopFromIntroPos / fadeElAfter;
                    intro.css('opacity', opacity);
                }
                
            } else {
                if (isStuck) {
                    intro.css({
                        'position': 'absolute',
                        'top': '0',
                    })
                    isStuck = false;
                }
            }
        }
    } else {
        if (device == 'desktop') {
            intro.css({
                'position': 'relative',
                'left': 'auto',
                'top': '0',
                'opacity': '1',
            })
            device = 'mobile';

            setTopPadding(0);
        }
    }
}
*/