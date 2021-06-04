function barbaInit() {
    
    barba.init({
        debug: false,
        timeout: 5000,
        preventRunning: true,
        prevent: ({href}) => href == '#' || href == window.location.href,
        
        transitions: [
            {
                name: 'default',
                leave(data) {
                    const done = this.async();

                    $('.c-page-transition .text').text(getAnimText(data.next.url)); 
                    
                    $('.c-page-transition').addClass('leave');
                    setTimeout(function() {
                        done();
                    }, 1200);
                },
                after() {
                    $('.c-page-transition').addClass('enter');
                    setTimeout(function() {
                        $('.c-page-transition').removeClass('leave');
                        $('.c-page-transition').removeClass('enter');
                    }, 800);
                }
            },
        ],
        views: [{
            namespace: 'default',
            beforeEnter() {                
                // Reset scroll
                $(window).scrollTop(0);

                // Destroy slick
                $('.slick-initialized').slick('unslick');

                // Reset modals
                $('.js-modal.is-active').removeClass('is-active');
                $('.js-modal').css({
                    'opacity': '0',
                    'visibility': 'hidden',
                });
                
                // Reset nav and body
                $('body').removeClass('no-scroll no-topbar');
                $('.js-nav').removeClass('is-active');
                
                // Restart autoplaying videos
                $('video[autoplay]').each(function(i, item) {
                    $(item).get(0).play();
                });
                
                // Re-init js
                init();                    
            },
        }]
    })
}


// TODO make translatable

// WHen language changed, change curr language attribute of body.
// Create array containing urls and translations and then look through urls and get text
function getAnimText(url) {
    // Get animation text from html
    // Animation text saved as data-animation-text on body element
    const path = url.path;
    
    if (path.indexOf('/meeting-rooms') > -1) {
        return 'Meeting Rooms';
    } else if (path.indexOf('/about') > -1) {
        return 'About Us';
    } else if (path.indexOf('/membership') > -1) {
        return 'Membership';
    } else if (path.indexOf('/community') > -1) {
        return 'Community';
    } else if (path.indexOf('/contact') > -1) {
        return 'Contact';
    } else if (path.indexOf('/refer-a-friend') > -1) {
        return 'Refer a Friend';
    } else if (path.indexOf('/team') > -1) {
        return 'Team';
    } else if (path.indexOf('/regions/') > -1 || path.indexOf('/locations/') > -1) {
        if (path.indexOf('/manchester') > -1) {
            return 'Manchester';
        } else if (path.indexOf('/bristol') > -1) {
            return 'Bristol'
        } else if (path.indexOf('/leeds') > -1) {
            return 'Leeds'
        } else if (path.indexOf('/cheltenham') > -1) {
            return 'Cheltenham'
        } else if (path.indexOf('/liverpool') > -1) {
            return 'Liverpool'
        } else if (path.indexOf('/brussels') > -1) {
            return 'Brussels'
        } else if (path.indexOf('/antwerp') > -1) {
            return 'Antwerp'
        } else if (path.indexOf('/glasgow') > -1) {
            return 'Glasgow'
        } else if (path.indexOf('/edinburgh') > -1) {
            return 'Edinburgh'
        } else if (path.indexOf('/belfast') > -1) {
            return 'Belfast'
        } else if (path.indexOf('/cardiff') > -1) {
            return 'Cardiff'
        } else if (path.indexOf('/wood-green') > -1 || path.indexOf('/holborn') > -1) {
            return 'London'
        } else {
            return 'Locations';
        }
    } else if (path == '/') {
        return 'Home';
    } else {
        return 'Clockwise';
    }
}