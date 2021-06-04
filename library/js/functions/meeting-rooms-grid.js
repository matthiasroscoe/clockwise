/**
 * Meeting rooms filter
 */

function meetingRoomsFilter() {

    if ($('.js-mr-posts').length) {
        let updating = false;
        const regionFilterBelow = $('.js-regions-filter-meeting-room'),
              container = $('.js-mr-posts');
    
        // Init filter on page load
        initFilter();
    
        // Update grid on filter submit
        $('.js-mr-filter-submit').on('click', function(e) {
            e.preventDefault();
        
            const region = $('.js-mr-regions').val(),
                  location = $('.js-mr-locations').val(),
                  numSeats = $('.js-mr-num-seats').val();
            
            if (location != null && location != 'all') {
                const data = {
                    location: location,
                    num_seats: numSeats,
                    posts_per_page: '-1',
                    is_ajax: true,
                    action: 'get_meeting_rooms_grid_section',
                };
                
                runFilter(data, region);
            }
    
            else if (location == null || location == 'all') {
                const data = {
                    region: region,
                    num_seats: numSeats,
                    posts_per_page: '3',
                    regions_ajax: true,
                    action: 'get_meeting_rooms_grid',
                };
    
                runFilter(data, region);
            }
    
            // If mobile, scroll down to grid
            if ($(window).innerWidth() < 992) {
                const gridOffset = $('.mr-grid__region-filter').offset().top;
                gsap.to(window, {
                    duration: 1.5,
                    scrollTo: gridOffset - 70,
                    ease: Power2.easeInOut,
                });
            }
        });
    
        // Update main filter when changing regions dropdown that sits below the filter. 
        $('.js-regions-filter-meeting-room').on('change', function() {
            if (! updating) {
                const region = $(this).val();
                
                $('.js-mr-regions').val(region).change().selectric('refresh');
                $('.js-mr-locations').val('all');
                $('.js-mr-filter-submit').trigger('click');
            }
        });
    
    
        // Reset filter button
        $('.js-mr-filter-reset').on('click', function(e) {
            if (! updating) {
                e.preventDefault();
                initFilter();
            }
        });
        
    
        function initFilter() {
            updating = true;
    
            const region = $('.js-mr-regions').val(),
                  numSeats = $('.js-mr-num-seats'),
                  locations = $('.js-mr-locations');
    
            numSeats.val(2).selectric('refresh');
            locations.val('all').selectric('refresh');
    
            const data = {
                region: region,
                num_seats: numSeats.val(),
                posts_per_page: '3',
                regions_ajax: true,
                action: 'get_meeting_rooms_grid',
            }
    
            const winWidth = $(window).innerWidth();
            if (winWidth < 768) {
                data.posts_per_page = '1';
            } else if (winWidth < 992) {
                data.posts_per_page = '2';
            }
            
            runFilter(data, region);
        }
    
    
        function runFilter(data, region) {
            updating = true;
    
            $.ajax({
                type: 'POST',
                dataType: 'html',
                url: scriptVars.ajaxUrl,
                data: data,
                success: function(response) {
                    container.addClass('is-faded');
                    setTimeout(function() {
                        container.empty();
                        container.append(response);
                        regionFilterBelow.val(region).change().selectric('refresh');
                        container.removeClass('is-faded');
                        $('.js-matchHeight').matchHeight();
                        
                        
                        updating = false;
                    }, 400);
                }
            })
        }
    }
    

}
