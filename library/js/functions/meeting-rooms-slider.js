function meetingRoomsSlider() {
    
    let sliderType = '';
    
    if ($('.js-meeting-rooms-slider').length > 0) {

        /** 
         * On resize, init slick for mobile, custom for desktop
         */
        $(window).on('resize', function() {
            if ($(window).innerWidth() < 992) {
                if (sliderType != 'slick') {
                    initMeetingRoomsSlickSlider();
                }
            }
        })

        /**
         * Meeting rooms slick slider for mobile
         */
        if ($(window).innerWidth() < 992) {
            initMeetingRoomsSlickSlider();
        }

        function initMeetingRoomsSlickSlider() {

            const slider = $('.js-meeting-rooms-slider');

            // When changing to slick slider after resizing,
            // remove cloned slides and unwanted styling from custom slider
            if (sliderType == 'custom') {
                $('.slide--cloned').remove();
                slider.closest('.module').removeClass('js-meeting-rooms-slider--custom');
            }
            
            // Init slick
            sliderType = 'slick';
            slider.slick({
                arrows: false,
                dots: true,
                autoplay: false,
                fade: false,
                slidesToShow: 3,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2,
                        },
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            dots: false,
                            slidesToShow: 1,
                        },
                    }
                ]
            });

            $('.js-mr-arrow-prev').click(function() {
                slider.slick('slickPrev');
            })
            $('.js-mr-arrow-next').click(function() {
                slider.slick('slickNext');
            })

            slider.addClass('initialised');
        }

        
        /**
         * Meeting rooms custom slider for desktop
         */
        if ( $(window).innerWidth() >= 992 ) {
            initMeetingRoomsCustomSlider();
        }
        
        function initMeetingRoomsCustomSlider() {
            sliderType = 'custom';
            
            const slider = $('.js-meeting-rooms-slider'),
                animSpeed = .45,
                animEase = 'Power4.easeInOut';
            
            let   slides = $('.js-meeting-rooms-slide'),
                numSlides = slides.length,
                currSlide = 2,
                next = 3,
                prev = numSlides,
                animating = false,
                twoNext, 
                twoPrev,
                currentXPos,
                nextXPos,
                prevXPos;
                
            slider.closest('.module').addClass('js-meeting-rooms-slider--custom');
            
            // Don't setup slider if only one slide added
            if (numSlides <= 1) {
                slider.addClass('is-active no-slider');
            } 

            // Setup slider and init
            else {
                cloneFirstLastSlides();
                setupSlides();
                positionSlides();
                slider.addClass('is-active');
        
                // Change slide click events
                $(document).on('click', '.js-mr-next, .js-mr-arrow-next', function() {
                    if (! animating && sliderType == 'custom' ) {
                        changeSlide('next');
                    }
                });
                $(document).on('click', '.js-mr-prev, .js-mr-arrow-prev', function() {
                    if (! animating && sliderType == 'custom' ) {
                        changeSlide('prev');
                    }
                });
        
                // Resize listener
                $(window).on('resize', positionSlides);
        
                /**
                 * Clone first and last slide and append to end and start of slider respectively.
                 * Needed to create the infinite loop.
                 */
                function cloneFirstLastSlides() {
                    const firstSlide = slides[0].cloneNode(true);
                    slider.append(firstSlide);
                    
                    const lastSlide = slides[numSlides - 1].cloneNode(true);
                    slider.prepend(lastSlide);
                }
        
                /**
                 * Setup slide positions
                 */
                function setupSlides() {
                    slides = $('.js-meeting-rooms-slide');
                    
                    // Assign classes to cloned slides
                    slides[0].classList.add('slide--cloned');
                    slides[slides.length - 1].classList.add('slide--cloned');
        
                    // Assign classes to the initial current/prev/next slides.
                    slides[0].classList.add('js-mr-prev');
                    slides[1].classList.add('js-current');
                    slides[2].classList.add('js-mr-next');
        
                    // Position all slides off screen to start with.
                    slides.each(function(i, slide) {
                        gsap.set(slide, {
                            x:  -850,
                        })
                        slide.setAttribute('data-index', i + 1);
                    })
                }
        
                function positionSlides() {
                    // Get x position variables for transforming
                    currentXPos = ($(window).innerWidth() / 2) - 305, // Centered
                    nextXPos = $(window).innerWidth() - 150, // Negative margin to right
                    prevXPos = -240; // Negative margin to left
        
                    // Position current, previous and next slides on screen
                    gsap.set('.js-mr-prev', {
                        x: prevXPos,
                    });
                    gsap.set('.js-current', {
                        x: currentXPos,
                    });
                    gsap.set('.js-mr-next', {
                        x: nextXPos,
                    });   
                }
        
        
                /**
                 * Change slide animation
                 */
                function changeSlide(direction) {
                    updateNextPrevSlides();
                    
                    let newSlide, prevSlide, fourthSlide;
                    if (direction == 'next') {
                        newSlide = $('.js-mr-next');
                        prevSlide = $('.js-mr-prev');
                    } else {
                        newSlide = $('.js-mr-prev');
                        prevSlide = $('.js-mr-next');
                    }
        
                    // Run animation
                    animating = true;
                    const tl = gsap.timeline({onComplete: updateSlides, onCompleteParams: [direction]});
                    
                    // Fade out text
                    tl.to('.js-current .details', {
                        opacity: 0,
                        duration: animSpeed,
                        ease: animEase,
                    });
        
                    // Animate out current slide
                    const currSlideToXPos = (direction == 'next') ? prevXPos : nextXPos;
                    tl.to('.js-current', {
                        x: currSlideToXPos,
                        height: 390,
                        width: 390,
                        duration: animSpeed * 4,
                        ease: animEase,
                    }, 0);
        
                    // Animate in new slide
                    tl.to(newSlide, {
                        x: currentXPos,
                        height: 610,
                        width: 610,
                        duration: animSpeed * 4,
                        ease: animEase,
                    }, 0);
        
                    // Animate out the previous slide
                    const prevSlideXPos = (direction == 'next') ? prevXPos - 700 : nextXPos + 700;
                    tl.to(prevSlide, {
                        x: prevSlideXPos,
                        duration: animSpeed * 4,
                        ease: animEase,
                    }, 0);
        
                    // Animate in the fourth slide (the slide that has now become next in the queue)
                    if (direction == 'next') {
                        tl.fromTo(`.js-meeting-rooms-slide[data-index="${twoNext}"]`, {
                            x: nextXPos + 700,
                        }, {
                            x: nextXPos,
                            duration: animSpeed * 4,
                            ease: animEase,
                        }, 0);
                    } else {
                        tl.fromTo(`.js-meeting-rooms-slide[data-index="${twoPrev}"]`, {
                            x: prevXPos - 700,
                        }, {
                            x: prevXPos,
                            duration: animSpeed * 4,
                            ease: animEase,
                        }, 0);
                    }
        
                    // Animate in the text on the following slide
                    tl.to(newSlide.find('.details'), {
                        opacity: 1,
                        duration: animSpeed,
                        ease: animEase,
                    }, '-=.5');
                    
                } // End changeSlide()
        
        
                // Get next/prev slide relative to currSlide
                function updateNextPrevSlides() {
                    prev = (currSlide == 1) ? numSlides : currSlide - 1;
                    next = (currSlide == numSlides) ? 1 : currSlide + 1;
                    twoPrev = (prev == 1) ? numSlides : prev - 1; // Gets the slide two previous to current
                    twoNext = (next == numSlides) ? 1 : next + 1; // Gets the slide two after the current
                }
        
                // Updates slider variables and cloned slide positions
                function updateSlides(direction) {
                    currSlide = (direction == 'next') ? next : prev;
                    updateNextPrevSlides();
                    
                    // Update current/next/prev slide variables
                    $('.js-current').removeClass('js-current');
                    $(`.js-meeting-rooms-slide[data-index="${currSlide}"]`).addClass('js-current');
                    $('.js-mr-next').removeClass('js-mr-next');
                    $(`.js-meeting-rooms-slide[data-index="${next}"]`).addClass('js-mr-next');
                    $('.js-mr-prev').removeClass('js-mr-prev');
                    $(`.js-meeting-rooms-slide[data-index="${prev}"]`).addClass('js-mr-prev');
        
                    // Allow user to change slide again
                    animating = false;
                }
            }
                
        }
    }
}
