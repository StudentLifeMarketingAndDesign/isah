

var geocoder;  // this object will handle the position<->address conversion
var x = $("#geo-message");
//var countyName;

function getLocation() {

  var options = {
  enableHighAccuracy: true,
  timeout: 5000,
  maximumAge: 0
};
  console.log(options);
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(locationSuccess, showError, options); // , {maximumAge:60000, timeout:5000, enableHighAccuracy:true}
    } else { 
        x.html("Geolocation is not supported by this browser.");
    }
}
function resetSearchForm(){
 
    x.hide();
    $('#results').hide();
    $('#directory-form').show();
    $("#Form_CountyForm_County").val("");
    if(history.pushState) {
        history.pushState(null, null, 'directory/');
    }
    else {
        window.location.hash = '';
    }
}
function loadFromHash(){
  x.hide();
  var countyHash = window.location.hash.substr(1);
 
  if(countyHash != ''){
    $('#loading').show();

    $('#Form_CountyForm_County').val(countyHash);
    $('#directory-form').hide();

    
    $('#results').load('directory/county/load/'+ countyHash, function(){
      $('#loading').hide();
      $('#results').show();
    });
    $('.open-feedback').magnificPopup({
      type: 'inline',
      preloader: false,
    });



    
  }else{
    resetSearchForm();
  }
}
function locationSuccess(position){
      x.hide();
      lat = position.coords.latitude;
      lon = position.coords.longitude;
      accuracy = position.coords.accuracy;

      latlon = new google.maps.LatLng(lat, lon);
      geocoder = new google.maps.Geocoder();
      geocoder.geocode({'latLng': latlon}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {

          if(accuracy < 10000){
            $('#loading').show();
            var county = getCounty(results[0]);
           // document.getElementById('County').innerHTML = 'County: ' + county;

            var countyName = convertToSlug(county);
            countyName = countyName.replace("-county", "");
            //countyName =  convertToSlug(countyName);
            $('#directory-form').hide();
            //alert(countyName);
          

            $('#results').load('directory/county/load/'+ countyName, function(){
              $('#loading').hide();
              $('#results').show();
            });

                if(history.pushState) {
                    history.pushState(null, null, 'directory/#'+ countyName);
                }
                else {
                    window.location.hash = '#'+ countyName;
                }
            }else{
              x.show();
              x.html("We couldn't get an accurate location from your device. Some desktops require Wi-Fi to be enabled for the most accurate results. Please select a county from the dropdown or <a href='directory/county/list'>view a list of counties &rarr;</a>");
            }
          

        }
      });
  //showPosition(position);
}
function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'')
        ;
}
function getGeocodedCountyNameFromPosition(position){
    
      lat = position.coords.latitude;
      lon = position.coords.longitude;
      latlon = new google.maps.LatLng(lat, lon);

      geocoder = new google.maps.Geocoder();
      geocoder.geocode({'latLng': latlon}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {

          var county = getCounty(results[0]);
         // document.getElementById('County').innerHTML = 'County: ' + county;

          countyName = county.replace("County", "");
          
        }
      });

}


function showPosition(position) {
    x.show();
    x.html("Location found.");
    lat = position.coords.latitude;
    lon = position.coords.longitude;
    latlon = new google.maps.LatLng(lat, lon);
    // okay, now we have the position (as a google maps latLng object), 
    // now we send this position to geocoder
    // @see  https://developers.google.com/maps/documentation/javascript/geocoding


    mapholder = document.getElementById('mapholder');
    mapholder.style.height = '250px';
    mapholder.style.width = '500px';

    var myOptions = {
      center:latlon,zoom:14,
      mapTypeId:google.maps.MapTypeId.ROADMAP,
      mapTypeControl:false,
      navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
    }
    var map = new google.maps.Map(document.getElementById("mapholder"), myOptions);
    var marker = new google.maps.Marker({
      position:latlon,
      map:map,
      title:"You are here!"
    });
}

function showError(error) {
    x.show();
    switch(error.code) {
        case error.PERMISSION_DENIED:
            x.html("Location services on this device/browser are not allowed. Please check your device's settings.");
            break;
        case error.POSITION_UNAVAILABLE:

            x.html("We couldn't find your location because your device/browser may not have allowed us to.");
            break;
        case error.TIMEOUT:
            x.html("The request to get your location has timed out.");
            break;
        case error.UNKNOWN_ERROR:
            x.html("An unknown error occurred when trying to get your location information. Give us feedback by clicking the link at the bottom of the page.");
            break;
    }
}

function resources(){

  var resources = 0;
  var resourceLocations = [];

  $('.county-resource').each(function(index, element) {
    var resource = this;
    if (resource) {
      var lat = $(this).data("lat");
      var lng = $(this).data("lng");
      var address = $(this).data("address");
      var addressOnly = $(this).data("address-only");

      if (addressOnly.length != 0){
        
          if ((lat != 0) && (lng != 0)) {

            var title = $(this).data("title");
            
            var phone = $(this).data("phone");

            var website = $(this).data("website");
            var category = $(this).data("cat");

            if (website) {
              website = "<a href="+website+" target='_blank'>Website</a>"; 
            }
           
            resourceLocations[resources] = [title, lat, lng, address, phone, website, category];
            resources++;
          }
      }
    } 


  });
    console.log(resourceLocations);
    return resourceLocations;
}
function showCounty(position) {
   // x.innerHTML = "Location found."
      /*lat = position.coords.latitude;
      lon = position.coords.longitude;*/

    lat = -91.5378113;
    lon = 41.6635067;
    latlon = new google.maps.LatLng(lat, lon);
    // okay, now we have the position (as a google maps latLng object), 
    // now we send this position to geocoder
    // @see  https://developers.google.com/maps/documentation/javascript/geocoding
    var locations = resources();

    if(locations.length > 0) {

      mapholder = document.getElementById('mapholder');
      if(mapholder != null) {
          mapholder.style.height = '100%';
          mapholder.style.width = '100%';


          var myOptions = {
            center:latlon,zoom:14,
            mapTypeId:google.maps.MapTypeId.ROADMAP,
            mapTypeControl:false,
            navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
          }
          var map = new google.maps.Map(document.getElementById("mapholder"), myOptions);

          var infowindow = new google.maps.InfoWindow({
            maxWidth: 500
            
          });

          var icons = {};

          icons['Law Enforcement'] = {
              path: MAP_PIN,
              fillColor: '#F90000', //red
              fillOpacity: 1,
              strokeColor: '',
              strokeWeight: 0,
              scale: 0.75
            };
          icons['Campus Law Enforcement'] = {
              path: MAP_PIN,
              fillColor: '#F90000', //red
              fillOpacity: 1,
              strokeColor: '',
              strokeWeight: 0,
              scale: 0.75
            };


          icons['Legal'] = {
              path: MAP_PIN,
              fillColor: '#F9E300', //yellow
              fillOpacity: 1,
              strokeColor: '',
              strokeWeight: 0,
              scale: 0.75
            };
          icons['Legal Services'] = {
              path: MAP_PIN,
              fillColor: '#F9E300',  //yellow
              fillOpacity: 1,
              strokeColor: '',
              strokeWeight: 0,
              scale: 0.75
            };  


          icons['Medical Resources'] = {
              path: MAP_PIN,
              fillColor: '#0022F9',  //blue
              fillOpacity: 1,
              strokeColor: '',
              strokeWeight: 0,
              scale: 0.75
            };
          icons['Medica'] = {
              path: MAP_PIN,
              fillColor: '#0022F9', //blue
              fillOpacity: 1,
              strokeColor: '',
              strokeWeight: 0,
              scale: 0.75
            };
          icons['Mental Health Services'] = {
              path: MAP_PIN,
              fillColor: '#9155D6',  //purple
              fillOpacity: 1,
              strokeColor: '',
              strokeWeight: 0,
              scale: 0.75
            };
          icons['Therapy/Counseling Services'] = {
              path: MAP_PIN,
              fillColor: '#00DAF9',  //turquoise
              fillOpacity: 1,
              strokeColor: '',
              strokeWeight: 0,
              scale: 0.75
            };


          icons['Department of Human Services (DHS)'] = {
              path: MAP_PIN,
              fillColor: '#FF8A00',  //orange
              fillOpacity: 1,
              strokeColor: '',
              strokeWeight: 0,
              scale: 0.75
            };
          icons['Domestic Violence'] = {
              path: MAP_PIN,
              fillColor: '#1ECA39',  //green
              fillOpacity: 1,
              strokeColor: '',
              strokeWeight: 0,
              scale: 0.75
            };
          icons['Community Services'] = {
              path: MAP_PIN,
              fillColor: '#92289A',  //pink
              fillOpacity: 1,
              strokeColor: '',
              strokeWeight: 0,
              scale: 0.75
            };
          icons['SA Center'] = {
              path: MAP_PIN,
              fillColor: '#71ACFF',  //sky blue
              fillOpacity: 1,
              strokeColor: '',
              strokeWeight: 0,
              scale: 0.75
            };
          

          var mapLabels = {};


          mapLabels['Law Enforcement'] = [
              '<span class="map-icon map-icon-courthouse"></span>'
          ];
          mapLabels['Campus Law Enforcement'] = [
              '<span class="map-icon map-icon-courthouse"></span>'
          ];


          mapLabels['Legal'] = [
              '<span class="map-icon map-icon-courthouse"></span>'
          ];
          mapLabels['Legal Services'] = [
              '<span class="map-icon map-icon-lawyer"></span>'
          ];


          mapLabels['Medical Resources'] = [
              '<span class="map-icon map-icon-health"></span>'
          ];
          mapLabels['Medica'] = [
              '<span class="map-icon map-icon-health"></span>'
          ];
          mapLabels['Mental Health Services'] = [
              '<span class="map-icon map-icon-doctor"></span>'
          ];
          mapLabels['Therapy/Counseling Services'] = [
              '<span class="map-icon map-icon-insurance-agency"></span>'
          ];

          
          mapLabels['Department of Human Services (DHS)'] = [
              '<span class="map-icon map-icon-political"></span>'
          ];
          mapLabels['Domestic Violence'] = [
              '<span class="map-icon map-icon-postal-code-prefix"></span>'
          ];
          mapLabels['Community Services'] = [
              '<span class="map-icon map-icon-library"></span>'
          ];
          mapLabels['SA Center'] = [
              '<span class="map-icon map-icon-florist"></span>'
          ];
          
          
          var markers = new Array();

          for (var i = 0; i < locations.length; i++) {  
            var marker = new Marker ({
              position: new google.maps.LatLng(locations[i][1], locations[i][2]),
              map: map,
              icon: icons[locations[i][6]], 
              map_icon_label: mapLabels[locations[i][6]]
              
            });

            markers.push(marker);
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
              return function() {
                infowindow.setContent(
                  locations[i][0] + "<br>" + 
                  locations[i][3] + "<br>" + 
                  locations[i][4] + "<br>" + 
                  locations[i][5]
                  

                  );
                infowindow.open(map, marker);
              }
            })(marker, i));
            

          }

          function autoCenter() {
            //  Create a new viewpoint bound
            var bounds = new google.maps.LatLngBounds();
            //  Go through each...
            for (var i = 0; i < markers.length; i++) {  
              bounds.extend(markers[i].position);
            }
            //  Fit these bounds to the map
            map.fitBounds(bounds);
          }
          autoCenter();
      }
  }
  else {

    // document.getElementById('resourcemap').style.backgroundImage = "url('image.jpg')";

  }

}


// more info, see my post on http://stackoverflow.com/questions/27203977/google-api-address-components
function getCounty(geocodeResponse) {
  var type = "administrative_area_level_2";  //the function will look through the results and find a component with type = 'locatily'.  Then it returns that
  for(var i=0; i < geocodeResponse.address_components.length; i++) {
    for (var j=0; j < geocodeResponse.address_components[i].types.length; j++) {
      if (geocodeResponse.address_components[i].types[j] == type) {
        return geocodeResponse.address_components[i].long_name;
      }
    }
  }
  return '';
}

/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
     // Show/Hide the directory navigation on-click
      $('.open-feedback').magnificPopup({

        type: 'inline',
        preloader: false,
        
      });
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'IsahProjectDirectory': {
      init: function() {

        window.onpopstate = function (event) {
          loadFromHash();
        }
        if(window.location.hash) {
          loadFromHash();
        } else {
          // Fragment doesn't exist
        } 

          //New search, reset everything.
          $("body").on('click', '#new-search-btn', function(e) {
              resetSearchForm();

          });
          //User selected something from the dropdown.
          $('#Form_CountyForm_County').on('change', function(e){
              x.hide();
              $('#loading').show();
              $('#directory-form').hide();
              $('#results').load('directory/county/load/'+ $('#Form_CountyForm_County').val(), function(){
                $('#loading').hide();
                $('#results').show();
              });
              $('.open-feedback').magnificPopup({
                  type: 'inline',
                  preloader: false,
             });
    
              if(history.pushState) {
                  history.pushState(null, null, 'directory/#'+$('#Form_CountyForm_County').val());
              }
              else {
                  window.location.hash = '#'+$('#Form_CountyForm_County').val();
              }
              
          });
          $('#get-location').on('click', function(e){
              //$('#results').innerHTML = 'Loading...';
              getLocation();
          });
      }
    },
    'County' : {
      init: function() {

        showCounty();

      }


    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');

   

    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.

