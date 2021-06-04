/**
 * Update locations dropdown options, when regions dropdown is changed
 * Used in filter
 */

function updateLocationsDropdownFilter() {
    $('.js-reg-dropdown-update').on('change', function() {
        const locationsSelect = $('.js-loc-dropdown-update');
    
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: scriptVars.ajaxUrl,
            data: {
                action: 'update_locations_dropdown_options',
                region: $(this).val(),
            },
            success: function(response) {
                $('.js-loc-dropdown-update option').remove();
                locationsSelect.append(response);
                locationsSelect.selectric('refresh');
            }
        })
    })
}