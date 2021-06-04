/**
 * Custom google map for the map_contact.php module
 */

const mapStyles = [
    {
      "featureType": "administrative",
      "elementType": "geometry",
      "stylers": [
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "landscape.natural",
      "elementType": "geometry",
      "stylers": [
        {
          "color": "#d3e2d8"
        }
      ]
    },
    {
      "featureType": "poi",
      "stylers": [
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "road",
      "elementType": "labels.icon",
      "stylers": [
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "road.arterial",
      "elementType": "labels",
      "stylers": [
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "road.highway",
      "elementType": "labels",
      "stylers": [
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "road.local",
      "stylers": [
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "transit",
      "stylers": [
        {
          "visibility": "off"
        }
      ]
    },
    {
      "featureType": "water",
      "elementType": "geometry",
      "stylers": [
        {
          "color": "#a9c1df"
        }
      ]
    }
];


function initGoogleMap() {

    const mapContainer = document.querySelector('.js-map-contact-container');
    let map;

    if (mapContainer > '') {
        const latlng = {
            lat: parseFloat(mapContainer.getAttribute('data-lat')),
            lng: parseFloat(mapContainer.getAttribute('data-lng')),
        }
    
        map = new google.maps.Map(mapContainer, {
            center: latlng,
            zoom: parseFloat(mapContainer.getAttribute('data-zoom')),
            styles: mapStyles,

            disableDefaultUI: true
        })
    
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            icon: mapContainer.getAttribute('data-marker'),
        })
    }

    if (mapContainer > '') {
      // Custom zoom controls
      $('.js-map-zoom-in').on('click', function(e) {
          map.setZoom(map.getZoom() + 1);
      })
      $('.js-map-zoom-out').on('click', function(e) {
          map.setZoom(map.getZoom() - 1);
      })
    }
    
}