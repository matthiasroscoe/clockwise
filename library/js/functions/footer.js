/**
 * Footer parallax effect on scroll
 */

function initFooterReveal() {

    if (isBrowserIE()) {
        $('#primary, #site-footer').addClass('browser-is-ie');
        return;
    }

    let winHeight = $(window).height(),
          docHeight = $(document).height(),
          footer    = $('#site-footer'),
          header    = $('#site-header');

    let scrollTop;

    setFooterAnimClasses();
    $(window).on('scroll resize', function() {        
        setFooterAnimClasses();
        winHeight = $(window).height();
        docHeight = $(document).height();
    })

    function setFooterAnimClasses() {
        scrollTop = $(window).scrollTop();
        if ( scrollTop > (docHeight - (winHeight * 2) - 600) ) {
            footer.addClass('is-active');

            if ( scrollTop >= (docHeight - winHeight - 70)) {
                header.addClass('is-hidden');
            } else {
                header.removeClass('is-hidden');
            }
        }
        else {
            footer.removeClass('is-active');
        }
    }
}