/**
 * Close topbar
 */

function initTopbar() {
    if ($('.c-site-topbar').length) {
        $('.js-close-topbar').on('click', function() {
            $('.c-site-topbar').addClass('is-removed');
            
            setTimeout(function() {
                $('.c-site-topbar').remove();
            }, 1000);
        })
    }
}