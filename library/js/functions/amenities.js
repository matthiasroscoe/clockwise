/**
 * Amenities module
 * Show all/Show less functionality
 */

function amenitiesToggleAll() {
    if ($('.js-toggle-all-amenities').length) {
        $('.js-toggle-all-amenities').on('click', function(e) {
            e.preventDefault();
    
            // Toggle amenities
            $('.js-extra-amenity').toggleClass('d-flex');
    
            // Change link text
            const text = ($(this).hasClass('is-active')) ? $(this).data('more') : $(this).data('less');
            $(this).text(text);
            $(this).toggleClass('is-active');
        })
    }
}