/**
 * SVG circle animation for buttons
 */

function buttonHoverAnimation() {
    
    if ($(window).innerWidth() >= 992) {
        gsap.utils.toArray('.c-btn').forEach(btn => {
            const circle = btn.querySelector('.fg-circle');
            
            gsap.set(circle, {
                drawSVG: '0%',
                opacity: 1,
            })
        });
        
        $(document.body).on('mouseenter', '.c-btn', function() {
            const circle = $(this).find('.fg-circle');
            gsap.to(circle, 1, {
                drawSVG: '100%',
            });
        })
        $(document.body).on('mouseleave', '.c-btn', function() {
            const circle = $(this).find('.fg-circle');
            gsap.to(circle, 1, {
                drawSVG: '0%',
            });
        })        
    }

}