/**
 * Cost Calculator modal
 */

function costCalculatorModal() {

    // Open calculator
    $('.js-calc-open').on('click', function(e) {
        e.preventDefault();

        // Reset errors
        $('.selectric-js-calc-locations').removeClass('error');

        // Get filter vars
        const location = $('.js-calc-locations').val(),
              numPeople = $('.js-num-people').val(),
              timePeriod = $('.js-time-period').val();

        // If no location picked, prompt user.
        if (location == null) {
            $('.selectric-js-calc-locations').addClass('error');
            return;
        }

        const modal = $('.js-calc-modal'),
              data = {
                action: 'get_cost_calculator_content',
                location: location,
                num_people: numPeople,
                num_years: timePeriod,
            };

        // AJAX and create modal content
        // On AJAX success, open modal
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: scriptVars.ajaxUrl,
            data: data,
            success: function(response) {
                $('.js-calc-content').remove();
                $('.js-calc-header').after(response);

                modal.scrollTop(0);
    
                gsap.to(modal, {
                    autoAlpha: 1,
                    duration: 1.25,
                    ease: Power3.easeOut,
                });

                updateHubspotCalculatorFields();
        
                modal.addClass('is-active');
                $('body').addClass('no-scroll');
            }
        })
    })


    // Close modals
    function closeModal() {
        if ($('.js-modal').hasClass('is-active')) {
            resetCalculator();

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

    $(document).on('click', '.js-modal-close', function(e) {
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
 * Cost calculator reset filter
 */

function costCalculatorFilterReset() {
    $('.js-calc-filter-reset').on('click', function(e) {
        e.preventDefault();
        resetCalculator();
    })
}

function resetCalculator() {
    $('.js-calc-regions').val('').selectric('refresh');
    $('.js-calc-locations').val('').selectric('refresh');
    $('.js-num-people').val(10).selectric('refresh');
    $('.js-time-period').val(1).selectric('refresh');
}


/**
 * Update calculator filter locations when region changed
 */

function updateCalculatorFilterLocations() {
    $('.js-calc-regions').on('change', function() {
        const regionID = $(this).val();

        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: scriptVars.ajaxUrl,
            data: {
                action: 'get_calculator_locations_by_region',
                region_id: regionID,
            },
            success: function(response) {
                $('.js-calc-locations option').remove();
                $('.js-calc-locations').append(response);
                $('.js-calc-locations').selectric('refresh');
            }
        })
    })
}



/**
 * Cost calculator mobile tabs
 */

function costCalculatorTabs() {
    $(document).on('click', '.js-calc-tab', function(e) {        
        if (! $(this).hasClass('is-active')) {
            const columnType = $(this).data('type');
            
            // Update tabs
            $(this).siblings().removeClass('is-active');
            $(this).addClass('is-active');
            
            // Update costs
            $('.js-setup-content').removeClass('is-active');
            $(`.js-setup-content[data-type="${columnType}"]`).addClass('is-active');
            
            // Update totals
            $('.js-totals').removeClass('is-active');
            $(`.js-totals[data-type="${columnType}"]`).addClass('is-active');
        }
    })

}


/**
 * Adds the cost calculator table HTML to the modal hubspot form hidden field
 * Needed so that the email notification sent from Hubspot also includes the cost calculator results.
 */

function updateHubspotCalculatorFields() {
    if ($('.c-calc-modal__newsletter').length) {
        if ($('.js-cost-calculator-vars').length) {
            const data = $('.js-cost-calculator-vars').data('cost-calculator-vars');
            console.log(data);
            /**
             * Update form fields with data
             */

            // General info
            $('input[name="cost_calculator_years"]').val(data.years);
            $('input[name="cost_calculator_people"]').val(data.people);
            $('input[name="cost_calculator_location"]').val(data.location);
            
            // Setup costs
            $('input[name="cost_calculator_setup_transaction"]').val(data.setup_costs.transaction);
            $('input[name="cost_calculator_setup_furniture"]').val(data.setup_costs.furniture);
            $('input[name="cost_calculator_setup_fit_out"]').val(data.setup_costs.fit_out);
            $('input[name="cost_calculator_setup_dilapidations"]').val(data.setup_costs.dilapidations);
            
            // Operating costs
            $('input[name="cost_calculator_operating_rent"]').val(data.operating_costs.rent);
            $('input[name="cost_calculator_operating_business_rates"]').val(data.operating_costs.business_rates);
            $('input[name="cost_calculator_operating_utility"]').val(data.operating_costs.utility_costs);
            $('input[name="cost_calculator_operating_reception"]').val(data.operating_costs.reception_staff);
            $('input[name="cost_calculator_operating_repairs_maintenance"]').val(data.operating_costs.repairs_maintenance);
            $('input[name="cost_calculator_operating_cleaning"]').val(data.operating_costs.cleaning);
            $('input[name="cost_calculator_operating_other_fees"]').val(data.operating_costs.other_fees);
            
            // Traditional model costs
            $('input[name="cost_calculator_traditional_total_costs_per_month"]').val(data.tm_total_costs.per_month);
            $('input[name="cost_calculator_traditional_total_costs"]').val(data.tm_total_costs.total);

            // Clockwise operating costs
            $('input[name="cost_calculator_clockwise_desk_rate_per_month"]').val(data.clockwise_costs.desk_rate_per_month);
            $('input[name="cost_calculator_clockwise_meeting_room_hire"]').val(data.clockwise_costs.meeting_room_hire);
            $('input[name="cost_calculator_clockwise_rent_per_month"]').val(data.clockwise_costs.rent_per_month);
            $('input[name="cost_calculator_clockwise_total_costs"]').val(data.clockwise_costs.total_costs);
            $('input[name="cost_calculator_clockwise_total_costs_per_month"]').val(data.clockwise_costs.total_costs_per_month);
            
            // Total savings
            $('input[name="cost_calculator_savings_percentage"]').val(data.savings.savings_percentage);
            $('input[name="cost_calculator_total_savings"]').val(data.savings.total_savings);

            // HS location field 
            // Needed to route email notifications to correct location general manager.
            let hubspotLocationTerm = data.location;
            if ($('.js-cost-calculator-vars').data('hubspot-location-name') != '') {
                hubspotLocationTerm = $('.js-cost-calculator-vars').data('hubspot-location-name');
            }
            $('.hs_location input[name="location"]').val(hubspotLocationTerm)
        }
    }
}