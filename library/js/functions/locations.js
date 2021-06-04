/**
 * Different filters for location grid
 */

function locationsGridFilter() {
    if ($('.js-locations-grid-container').length > 0) {

        const container = $('.js-locations-grid-container');

        function filterLocations(region) {
            const data = {
                region: region,
                posts_per_page: container.data('posts-per-page'),
                locations: container.data('locations'),
                action: 'filter_locations_by_region',
            };

            $.ajax({
                type: 'POST',
                dataType: 'html',
                data: data,
                url: scriptVars.ajaxUrl,
                success: function(response) {
                    container.addClass('is-faded');
                    setTimeout(function() {
                        container.empty();
                        container.append(response);
                        container.removeClass('is-faded');
                    }, 400);
                }
            })

            
        }

        // On initial page load, show locations
        if (container.hasClass('js-load-grid')) {
            filterLocations(container.data('region'));
        }

        // On dropdown change
        $('.js-regions-filter-location').on('change', function() {
            const regionToShow = $(this).val();
            filterLocations(regionToShow);
        });

        // On pill button click
        $('.js-regions-filter-pill').on('click', function(e) {
            e.preventDefault();

            if (! $(this).hasClass('is-active')) {
                const regionToShow = $(this).data('term-id');
                if (regionToShow) {
                    $('.js-regions-filter-pill').removeClass('is-active');
                    $(this).addClass('is-active');
    
                    filterLocations(regionToShow);
                }
            }
        })

    }
}

/**
 * All locations mobile accordions
 */

function showAllLocationsAccordions() {
    if ($('.js-loc-accordion').length) {
        $('.js-loc-accordion').on('click', function(e) {
            e.preventDefault();
    
            if ($(window).innerWidth() < 992) {
                const termID = $(this).data('term-id');
        
                $(this).toggleClass('is-active');
                $(this).next().toggleClass('is-active');
            }
        })
    }
}