$(function () {
          var map = new GMaps({
          el: "#layer",
          lat: -33.8665433,
          lng: 151.1956316,
          zoom: 15
        });
        
        map.addLayer('places', {
          location : new google.maps.LatLng(-33.8665433,151.1956316),
          radius : 500,
          types : ['store'],
          search: function (results, status) {
            if (status == google.maps.places.PlacesServiceStatus.OK) {
              for (var i = 0; i < results.length; i++) {
                var place = results[i];
                map.addMarker({
                  lat: place.geometry.location.lat(),
                  lng: place.geometry.location.lng(),
                  title : place.name,
                  infoWindow : {
                    content : '<h2>'+place.name+'</h2><p>'+(place.vicinity ? place.vicinity : place.formatted_address)+'</p><img src="'+place.icon+'"" width="100"/>'
                  }
                });
              }
            } 
          }
        });
      });