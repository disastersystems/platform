(function ($) {
  Drupal.behaviors.organizations_map = {
    attach: function (context, settings) {
      var tid = settings.tid;
      $('body').once('organization-map').each(function() {
        google.maps.event.addDomListener(window, 'load', function() {
          initialize();
        });
      });

      function initialize() {
        getOrganizations(tid, function(organizations) {
          var markers = []
          var latlngbounds = new google.maps.LatLngBounds();
          var infowindow = new google.maps.InfoWindow({
            maxWidth: 300,
            content: "holding..."
          });

          map = new google.maps.Map(document.getElementById('organizations-map'), {
            zoom: 13,
            scrollwheel: false,
          });

          for (var i = 0; i < organizations.length; i++) {
            var marker = new google.maps.Marker({
              map: map,
              position: new google.maps.LatLng(organizations[i].latitute, organizations[i].longitude),
            });

            marker.content = '<div class="popup-wrapper">' + 
            '<div class="title">' + organizations[i].title + '</div>' +
            '<div class="address">Address: ' + organizations[i].address + '</div>' +
            '<div class="path"><a href="' + organizations[i].url + '">Learn More</a></div>' +
            '</div>';

            markers.push(marker);
            marker.addListener('click', function(){
              infowindow.setContent(this.content);
              infowindow.open(map, this);
            });
            
            latlngbounds.extend(marker.getPosition());
          }
          map.fitBounds(latlngbounds);
        });
      }

      function getOrganizations(tid, callback) {
        $('.view-community-search-list').before('<div class="overlay"></div><div class="loader"></div>');
        $.ajax({
          url: '/api/v1/organizations/' + tid,
          type: 'get',
          success: function (response) {
            if(callback) {
              callback(response);
            }
          }
        });
      }
    }
  }
})(jQuery)