/**
 * Accordion for Hubspot Form module
 */

function hubspotFormAccordion() {
    if ($('.hs-form-wrapper.has-dropdown').length > 0) {
        $('.js-hs-form-toggle').on('click', function() {
            $(this).closest('.hs-form-wrapper').toggleClass('is-active');
        })
    }
}

/**
 * Load hubspot form via AJAX
 * We're using ajax rather than adding HS code inline in the html in order to be compatible with Barba
 */

function getHubspotForm() {

    const forms = $('.js-hs-form-container');
    
    if (forms.length) {
        // Foreach form container, insert hubspot form within
        forms.each(function(i, item) {

            if (! $(item).children().length) { // Only add form to container if form doesn't already exist
            
                $(item).attr('data-form-index', i);
                const portalID = $(item).data('portal-id');
                const formID = $(item).data('form-id');
                let refereePageUrl;
    
                if (portalID > '' && formID > '') {
                    hbspt.forms.create({
                        portalId: portalID,
                        formId: formID,
                        target: '.js-hs-form-container[data-form-index="' + i + '"]',

                        // Triggers after the form is placed in the DOM
                        onFormReady: function() {
                            // If form is referral form, populate the referral code hidden field with a random code
                            if ($(item).data('form') == 'referal_form') {
                                const refereePageUrlBase = scriptVars.siteUrl + '/referral/';
                                const refereePageCode = createID(7) + '-' + createID(7) + '-' + createID(7);
                                refereePageUrl = refereePageUrlBase + refereePageCode;
                                
                                $('input[name="referee_form_url"]').val(refereePageUrl);
                                $(item).attr('data-referee-form-code', refereePageCode);                                
                            }

                            // Set hubspot select element text colour
                            const selects = $('select.hs-input');
                            selects.each(function(i, item) {
                                if ($(item).val() == null) {
                                    $(item).addClass('is-placeholder');
                                }
                            })
                            selects.on('change', function() {
                                $(this).removeClass('is-placeholder');
                            })

                            // If form is referee form, populate referrer hidden field with referrer's email address saved in ACF
                            if ($(item).data('form') == 'referee_form') {
                                const referrerEmail = $(item).data('referrer-email');
                                $('input[name="referrer_s_email"]').val(referrerEmail)
                            }
                        },
                        
                        // Triggers after the form is validated but before it's sent to Hubspot
                        onFormSubmit: function() {
                            // If submitting referral form, create the referral post in WP
                            if ($(item).data('form') == 'referal_form') {
                                console.log('Creating referral page...');
                                $.ajax({
                                    type: 'POST',
                                    dataType: 'html',
                                    url: scriptVars.ajaxUrl,
                                    data: {
                                        first_name: $('input[name="firstname"').val(),
                                        last_name: $('input[name="lastname"]').val(),
                                        email: $('input[name="email"]').val(),
                                        referral_code: $(item).data('referee-form-code'),
                                        action: 'create_referral_post',
                                    },
                                    success: function(response) {
                                        if (response == 'success') {
                                            console.log('Referral page created: ' + refereePageUrl);
                                        } else {
                                            console.error(response);
                                        }
                                    }
                                })
                            }
                        },
                        
                        // Triggers after the data is actually sent to Hubspot and confirmation message is shown
                        onFormSubmitted: function() {

                            // If form is referral form, show the referral page link
                            if (refereePageUrl) {
                                const shareLinkHtml = '<div class="referee-sharing | u-rel"><input name="referee-sharing-link" readonly class="referee-sharing__link js-copy-referee-link" value="' + refereePageUrl + '"><div class="referee-sharing__actions"><a href="#" class="js-copy-referee-link">Copy</a></div></div>';
                                $('.submitted-message').after(shareLinkHtml);
                            } 

                            // If form is in modal, wait 5 seconds then close modal.
                            if ($(item).closest('.js-modal').length) {
                                if ($(item).closest('.js-modal').data('modal-type') != 'referal_form') {
                                    setTimeout(function() {
                                        gsap.to('.js-modal.is-active', {
                                            autoAlpha: 0,
                                            duration: 1.25,
                                            ease: Power3.easeOut,
                                        });
                        
                                        $('.js-modal.is-active').removeClass('is-active');
                                
                                        if (! $('.js-nav').hasClass('nav-active')) {
                                            $('body').removeClass('no-scroll');
                                        }
                                    }, 5000)
                                }
                            }
                            
                            // Reset footer animation
                            initFooterReveal();
                        } 
                    });
                } else {
                    console.error('Portal ID and Form ID are required to show Hubspot Form');
                }

            }
        })
    }
}