/**
 * Toggle full screen modals on/off
 */

function toggleFullScreenModals() {

    // Opening modals
    $(document).on('click', '.js-modal-open', function(e) {
        e.preventDefault();

        const modalType = $(this).data('modal-type'),
              modal = $(`.js-modal[data-modal-type="${modalType}"]`);
        
        if (modalType) {
            modal.scrollTop(0);

            gsap.to(modal, {
                autoAlpha: 1,
                duration: 1.25,
                ease: Power3.easeOut,
            });

            modal.addClass('is-active');
            $('body').addClass('no-scroll');
        } else {
            console.error('No modal type assigned to link.');
        }

    });

    // Close modals
    function closeModal() {
        if ($('.js-modal').hasClass('is-active')) {
            gsap.to('.js-modal.is-active', {
                autoAlpha: 0,
                duration: 1.25,
                ease: Power3.easeOut,
            });

            $('.js-modal.is-active').removeClass('is-active');
    
            if (! $('.js-nav').hasClass('nav-active')) {
                $('body').removeClass('no-scroll');
            }
        }
    }

    $('.js-modal-close').on('click', function(e) {
        e.preventDefault();
        closeModal();
    })

    $(document).on('keydown', function(e) {
        if (e.keyCode == 27) {
            closeModal();
        }
    })
}



/**
 * Toggle meeting rooms booking modals
 */

function initMeetingRoomModals() {

    $(document).on('click', '.js-mr-modal-open', function(e) {
        e.preventDefault();

        const telEl = $('.js-mr-modal-tel');
        const emailEl = $('.js-mr-modal-email');
        const telText = $(this).data('tel')
        const emailText = $(this).data('email');

        // Update telephone number
        if (telText > '') {
            $('.js-mr-modal-tel-text').text(telText);
            $('.js-mr-modal-tel-text').attr('href', 'tel:' + telText);
            telEl.show();
        } else {
            telEl.hide();
        }

        // Update email
        if (emailText > '') {
            $('.js-mr-modal-email-text').text(emailText);
            $('.js-mr-modal-email-text').attr('href', 'mailto:' + emailText);
            emailEl.show();
        } else {
            emailEl.hide();
        }

        // Show modal
        gsap.to('.js-mr-modal', {
            autoAlpha: 1,
            duration: 1.25,
            ease: Power3.easeOut,
        });

        $('body').addClass('no-scroll');

        modalOpen = true;
    })


    // Close modal
    function closeMrModal() {
        gsap.to('.js-mr-modal', {
            autoAlpha: 0,
            duration: 1.25,
            ease: Power3.easeOut,
            onComplete: function() {
                // Reset active tabs and content
                $('.js-mr-modal-tab, .js-mr-modal-content').removeClass('is-active');
                $(`.js-mr-modal-tab[data-content-type="member"], .js-mr-modal-content[data-content-type="member"]`).addClass('is-active');
            }
        });


        if (! $('.js-nav').hasClass('nav-active')) {
            $('body').removeClass('no-scroll');
        }
    }

    $('.js-mr-modal-close').on('click', function(e) {
        e.preventDefault();
        closeMrModal();
    })

    $(document).on('keydown', function(e) {
        if (e.keyCode == 27) {
            closeMrModal();
        }
    })


    // Member/Non-member tabs
    $('.js-mr-modal-tab').on('click', function() {
        if (! $(this).hasClass('is-active')) {
            const contentType = $(this).data('content-type');
            
            $('.js-mr-modal-content.is-active').removeClass('is-active');
            $(`.js-mr-modal-content[data-content-type="${contentType}"]`).addClass('is-active');

            $('.js-mr-modal-tab').removeClass('is-active');
            $(this).addClass('is-active');
        }
    })
}