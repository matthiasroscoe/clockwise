/**
 * Load more buttons for location grids
 */

function locationsLoadMore() {

    $(document).on('click', '.js-loc-load-more', function(e) {
        e.preventDefault();

        const region = $(this).data('region'),
                offset = $(this).data('offset'),
                locations = $(this).closest('.js-locations-grid-container').data('locations');
        
        const data = {
            region: region,
            offset: offset,
            locations: locations,
            action: 'locations_load_more',
        }

        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: scriptVars.ajaxUrl,
            data: data,
            success: function(response) {
                $(`.js-locations-grid-container[data-region="${region}"]`).find('.js-locations-grid').append(response);
                $(`.js-loc-load-more-container[data-region="${region}"]`).addClass('d-none');
                
            },
        })
    })
}


/**
 * Meeting Rooms grid 'Load More' buttons
 */

function meetingRoomsLoadMore() {
    $(document).on('click', '.js-mr-load-more', function(e) {
        e.preventDefault();

        const location = $(this).data('location');
        const numSeats = $('.js-mr-num-seats').val();
        const offset = $(this).data('offset');
        const data = {
            location: location,
            num_seats: numSeats,
            offset: offset,
            action: 'meeting_rooms_grid_load_more',
        }

        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: scriptVars.ajaxUrl,
            data: data,
            success: function(response) {
                $(`.mr-grid__row[data-location="${location}"]`).append(response);
                $(`.mr-grid__load-more[data-location="${location}"]`).addClass('d-none');
                
            },
        })
    })
}