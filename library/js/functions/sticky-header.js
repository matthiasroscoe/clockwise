/**
 * Sticky header scroll toggle
 */

function stickyHeader() {
    let scrollTop, heroHeight;

    $(window).on('load resize scroll', function() {
        scrollTop = $(window).scrollTop();
        const footerTop = $('#main').outerHeight() - 70;

        if (scrollTop > 0) {
            $('.c-site-topbar').addClass('is-hidden');
            $('#site-header').addClass('is-fixed');
        } else {
            $('.c-site-topbar').removeClass('is-hidden');
            $('#site-header').removeClass('is-fixed');
        }

        // Remove header when scrolled onto footer
        if (scrollTop > footerTop) {
            $('#site-header').addClass('is-hidden');
        } else {
            $('#site-header').removeClass('is-hidden');
        }
    })
}