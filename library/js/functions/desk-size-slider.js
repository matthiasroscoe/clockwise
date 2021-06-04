/**
 * Drag/Drop range slider for the Desk Size module
 * Uses 'No UI Slider': https://refreshless.com/nouislider/
 */

function deskSizeRangeSlider() {
    if ($('.js-range-slider').length > 0) {

        let rangeSliderType;
        const rangeSlider = document.querySelector('.js-range-slider');
        const numSteps = parseInt(rangeSlider.getAttribute('data-num-steps'));
        
        // Init range slider
        if ($(window).innerWidth() >= 992) {
            initSlider('desktop');
        } else {
            initSlider();
        }
        $(rangeSlider).closest('.desk-size-slider__range').addClass('initialised');

        // On window resize, destroy and re-init slider when going from desk to mob
        $(window).on('resize', function() {
            if ($(window).innerWidth() >= 992 && rangeSliderType == 'mobile') {
                rangeSlider.noUiSlider.destroy();
                initSlider('desktop');
            }
            if ($(window).innerWidth() < 992 && rangeSliderType == 'desktop') {
                rangeSlider.noUiSlider.destroy();
                initSlider();
            }
        })

        function initSlider(device) {
            let direction   = 'ltr',
                orientation = 'horizontal';
                rangeSliderType = 'mobile';
                
            if (device == 'desktop') {
                direction = 'rtl';
                orientation = 'vertical';
                rangeSliderType = 'desktop';
            }

            const noUiOptions = {
                start: 2, // Start slider on second lowest step
                step: 1,
                range: {
                    'min': 1,
                    'max': numSteps,
                },
                
                // Adds colour to bar
                connect: [true, false],
    
                // Make vertical, with smallest value at bottom
                direction: direction,
                orientation: orientation,
            }

            noUiSlider.create(rangeSlider, noUiOptions);
        }



        // On slider change, update all content
        let updating = false;
        rangeSlider.noUiSlider.on('update', function(val) {
            const formattedVal = val[0].replace('.00', '');

            // Update main content
            $('.js-desk-size-content').removeClass('is-active');
            setTimeout(function() {
                $('.js-desk-size-content').removeClass('is-active');
                $(`.js-desk-size-content[data-step="${formattedVal}"]`).addClass('is-active');
            }, 450);

            // Update image
            $('.js-desk-size-img').removeClass('is-active');
            $(`.js-desk-size-img[data-step="${formattedVal}"]`).addClass('is-active');
            
            // Update desk size
            $('.js-desk-size').removeClass('is-active');
            $(`.js-desk-size[data-step="${formattedVal}"]`).addClass('is-active');

        });

    }
}