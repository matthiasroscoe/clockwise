/**
 * Toggle nav overlay
 */

function toggleNav() {
    $('.js-nav-toggle').on('click', function(e) {
        e.preventDefault();
        
        $('.js-hamburger').toggleClass('is-active');
        $('.js-nav').toggleClass('nav-active');
        $('#site-header').toggleClass('nav-active');
        $('body').toggleClass('no-scroll no-topbar');

        // If closing nav, hide any opened sub-menus
        if (! $('.js-nav').hasClass('nav-active')) {
            $('.js-sub-menu').removeClass('is-active');
            $('.js-has-sub-menu').removeClass('is-active');

            setTimeout(function() {
                $('.js-sub-menu').hide();
            }, 600);
        };

        // If language switcher open, close it
        $('.js-lang-switcher, .js-langs').removeClass('is-active');
    })
}

/**
 * Toggle nav sub-menus
 */
function toggleNavSubMenus() {
    $('.js-has-sub-menu').on('click', function(e) {
        e.preventDefault();
        
        // Toggle arrow icon state
        $(e.target).toggleClass('is-active');
        
        const subMenu = $(e.target).next();
        // If closing sub-menu
        if (subMenu.hasClass('is-active')) {
            subMenu.removeClass('is-active');
            setTimeout(function() {
                subMenu.slideToggle('500', 'swing');
            }, 400)
        } 
        // If opening sub-menu
        else {
            subMenu.slideToggle('500', 'swing', function() {
                subMenu.addClass('is-active');
            });
        }
        
    });

    // Toggle sub-region dropdown
    $('.js-nav-sub-region').on('click', function(e) {
        e.preventDefault();

        $(this).parent().toggleClass('is-active');
    })
}

