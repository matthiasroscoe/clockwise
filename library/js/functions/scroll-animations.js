/**
 * Scrolling Animation
 */

function fadeInOnScroll() {

    // Check if internet explorer or mobile and turn off scrolling animations if so.
    if (isBrowserIE() || $(window).innerWidth() < 992) {
        $('.js-hidden').addClass('js-visible');
        // return;
    }

    const hiddenSections = document.querySelectorAll('.js-hidden');

    function fadeInVisible() {
      hiddenSections.forEach(function(s,i) {
          if (s.getBoundingClientRect().top <= window.innerHeight - 30) {
              s.classList.add('js-visible');
          }
      })
    }
    
    $(window).on('scroll resize load', function(e) {
        fadeInVisible();
    })

}