var markers = [];
var latitudSitio = 0.0;
var longitudSitio = 0.0;

function initMap() {
    deleteMarkers();
    navigator.geolocation.getCurrentPosition(coordenadas);
    var geocoder = new google.maps.Geocoder();

    document.getElementById('btnBuscar').addEventListener('click', function () {
        geocodeAddress(geocoder);
    });
}//Fin de la funcion initMap.

function geocodeAddress(geocoder) {
    var address = document.getElementById('nombreLugar').value;

    geocoder.geocode({'address': address}, function (results, status) {
        if (status === 'OK') {
            
            var latitud = results[0].geometry.location.lat();
            var longitud = results[0].geometry.location.lng(); 
            
            document.getElementById('latitud').value = latitud;
            document.getElementById('longitud').value = longitud;

        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}

function coordenadas(position) {
    var directionsService = new google.maps.DirectionsService
    var directionsDisplay = new google.maps.DirectionsRenderer;
    var lat = position.coords.latitude;
    var lon = position.coords.longitude;
    var waypts = [{
        location: {
            lat: lat,
            lng: lon
        },
        stopover: true
    }, {
        location: {
            lat: latitudSitio,
            lng: longitudSitio
        }, stopover: true
    }];
    var map = new google.maps.Map(document.getElementById('map'),
        {
            zoom: 35,
            mapTypeId: google.maps.MapTypeId.HYBRID,
            center: {
                lat: waypts[0].location.lat,
                lng: waypts[0].location.lng
            }
        });

    var marker = new google.maps.Marker({
        position: { lat: lat, lng: lon },
        map: map,
        title: 'Nuestra ubicación'
    });
    markers.push(marker);

    var marker2 = new google.maps.Marker({
        position: {
            lat: waypts[0].location.lat,
            lng: waypts[0].location.lng
        },
        map: map,
        title: 'Tu ubicación'
    });
    markers.push(marker2);

    directionsDisplay.setMap(map);
    directionsService.route({
        origin: {
            lat: waypts[0].location.lat,
            lng: waypts[0].location.lng
        },
        destination: {
            lat: waypts[0].location.lat,
            lng: waypts[0].location.lng
        },
        waypoints: waypts,
        travelMode: google.maps.TravelMode.WALKING
    },
    function (response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        } else {
            window.alert('Ha fallado la comunicación con el mapa a causa de: ' + status);
        }
    });
}//Fin de la función coordenadas.

function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}
function deleteMarkers() {
    setMapOnAll(null);
    markers = [];
}