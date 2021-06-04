/**
 * Get users location co-ords with geolocation
 */

function getUserCoordinates() {
    
    if ($('.js-find-location').length || $('.js-find-region').length) {
        // Reset error messages
        $('.find-location__error').remove();

        // Get users current region
        $('.js-find-region').on('click', function(e) {
            e.preventDefault();    
            if (navigator.geolocation) {
                // Add loading spinner
                $('.selectric-js-hero-loc-select .selectric').addClass('loading');
                
                // Get user co-ordinates
                navigator.geolocation.getCurrentPosition(getUserRegion, geolocationError, geolocationOptions);
            }
        });
    
        // Get users nearest location
        $('.js-find-location').on('click', function(e) {
            e.preventDefault();    
            if (navigator.geolocation) {
                // Add loading spinner
                $('.selectric-js-hero-loc-select .selectric').addClass('loading');
                
                navigator.geolocation.getCurrentPosition(getUsersNearestLocation, geolocationError, geolocationOptions);
            }
        });
    }
}

const geolocationOptions = {
    enableHighAccuracy: false,
    timeout: 8000,
    maximumAge: Infinity,
};

function geolocationError(err) {
    $('.selectric-js-hero-loc-select .selectric').removeClass('loading');
    console.warn(`Geolocation - error ${err.code}: ${err.message}`);

    // If regions dropdown, default to England on fail
    if ($('.js-hero-loc-select--regions').length) {
        $('.js-hero-loc-select').val(15).change().selectric('refresh');
    }
}



/**
 * Gets users nearest Clockwise location 
 * by comparing user latlong to location latlong stored in ACF field
 */

function getUsersNearestLocation(position) {
    console.log(position);
    data = {
        lat: position.coords.latitude,
        long: position.coords.longitude,
        region: $('.js-find-location').data('region'),
        action: 'get_user_nearest_location',
    }

    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: scriptVars.ajaxUrl,
        data: data,
        success: function(response) {
            if (response > '') {
                $('.js-hero-loc-select').val(response).change().selectric('refresh');
            }
        }
    })
}



/**
 * Get users nearest Clockwise region by using user's coords
 * Depends on Google Geocoding API
 */
function getUserRegion(position) {
    const lat = position.coords.latitude,
          long = position.coords.longitude,
          selectric = $('.selectric-js-hero-loc-select'),
          select = $('.js-hero-loc-select');
    
    if (lat && long) {
        $.ajax({
            'type': 'POST',
            'url': scriptVars.ajaxUrl,
            'data': {
                action: 'get_current_user_location',
                'lat': lat,
                'long': long,
            },
            success: function(response) {
                const responseJson = JSON.parse(response)
                const results = responseJson.results;
                const status = responseJson.status;
                
                if (status == 'OK') {
                    // Get country
                    let country;
                    country = getLocationType(results, 'country');
                    
                    // Remove loading wheel anim
                    selectric.find('.selectric').removeClass('loading');
    
                    // If user is in UK, set selectric to the home nation
                    if (country == 'United Kingdom') {
                        country = getLocationType(results, 'administrative_area_level_1');    
                        
                        switch (country) {
                            case 'Northern Ireland':
                                select.val(155).change().selectric('refresh');
                                break;
                            case 'England':
                                select.val(15).change().selectric('refresh');
                                break;
                            case 'Scotland':
                                select.val(151).change().selectric('refresh');
                                break;
                            case 'Wales':
                                select.val(148).change().selectric('refresh');
                                break;
                        
                            default:
                                break;
                        }
                    } else {
                        // If country not in UK or Europe, redirect to England
                        select.val(15).change().selectric('refresh');

                        // If user not in UK, check if they are in Europe
                        // const countriesInEurope = ['Albania', 'Andorra', 'Armenia', 'Austria', 'Azerbaijan', 'Belarus', 'Belgium', 'Bosnia and Herzegovina', 'Bulgaria', 'Croatia', 'Cyprus', 'Czech Republic', 'Denmark', 'Estonia', 'Finland', 'France', 'Georgia', 'Germany', 'Greece', 'Hungary', 'Iceland', 'Ireland', 'Italy', 'Kosovo', 'Latvia', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Macedonia', 'Malta', 'Moldova', 'Monaco', 'Montenegro', 'The Netherlands', 'Norway', 'Poland', 'Portugal', 'Romania', 'Russia', 'San Marino', 'Serbia', 'Slovakia', 'Slovenia', 'Spain', 'Sweden', 'Switzerland', 'Turkey', 'Ukraine', 'United Kingdom', 'Vatican City'];
                        // const inEurope = (countriesInEurope.includes(country)) ? true : false;
                        
                        // If in europe, set select to Mainland Europe
                        // if (inEurope) {
                        //     select.val(153).change().selectric('refresh');
                        // } else {
                            // If country not in UK or Europe, redirect to England
                            // select.val(15).change().selectric('refresh');
                        // }
                    }
                } else {
                    console.log('error in response');
                }

            }
        })
    }


    function getLocationType(results, type) {
        let data;
        
        results.forEach(i => {
            i.address_components.forEach(i => {
                if (i.types.includes(type)) {
                    data = i.long_name;
                }
            })
        })

        return data;
    }
}