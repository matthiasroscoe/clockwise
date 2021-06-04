/**
 * Scroll to top sticky link
 */

function scrollToTop() {
    
    // Display sticky link after scrolling down the page 
    let scrollTop = 0;
    $(window).on('scroll load resize', function(e) {
        if ($(window).innerWidth() >= 992) {
            scrollTop = $(window).scrollTop();
            if (scrollTop > 50) {
                $('.scroll-to-top').addClass('is-active');
            } else {
                $('.scroll-to-top').removeClass('is-active');
            }
        }
    })

    // Scroll to top on click
    $('.scroll-to-top').on('click', function(e) {
        e.preventDefault();

        // Increase animation duration if the user is further down the page.
        const offsetTop  = $(this).offset().top;
        let duration = 1.25;
        if (offsetTop > 4000) {
            duration = 2.5;
        }

        gsap.to(window, {
            duration: duration,
            scrollTo: 0,
            ease: Power4.easeInOut,
        })
    })
}