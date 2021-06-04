/**
 * Hover banner module background transitions
 */

function hoverBannerBackgroundTransitions() {

    if ($('.hover-banner').length > 0) {
        $('.js-hover-banner-heading').on('mouseover', function() {
            if ( $(window).innerWidth() >= 992 ) {
                const contentIndex = $(this).data('content-index');
    
                if (! $(this).hasClass('is-active')) {
                    // Change bg img
                    $('.js-hover-banner-bg.is-active').removeClass('is-active');
                    $(`.js-hover-banner-bg[data-content-index="${contentIndex}"]`).addClass('is-active');

                    // Change active heading
                    $('.js-hover-banner-heading').removeClass('is-active');
                    $(`.js-hover-banner-heading[data-content-index="${contentIndex}"]`).addClass('is-active');

                    // Change active text
                    $('.js-hover-banner-text.is-active').removeClass('is-active');
                    $(`.js-hover-banner-text[data-content-index="${contentIndex}"]`).addClass('is-active');
                }
            }
        })
    }
}