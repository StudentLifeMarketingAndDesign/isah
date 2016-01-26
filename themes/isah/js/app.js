$(document).ready(function() {
	$('.open-feedback').magnificPopup({

		type: 'inline',
		preloader: false,
		
	});

	if(window.location.hash) {
		var countyHash = window.location.hash.substr(1);
		$('#Form_CountyForm_County').val(countyHash);
		$('#results').load('directory/county/load/'+ countyHash);
    $('.open-feedback').magnificPopup({
        type: 'inline',
        preloader: false,
   });
	} else {
	  // Fragment doesn't exist
	}	

	  $('#Form_CountyForm_County').on('change', function(e){
	      $('#results').load('directory/county/load/'+ $('#Form_CountyForm_County').val());
        $('.open-feedback').magnificPopup({
            type: 'inline',
            preloader: false,
       });
	      window.location.hash = '#'+$('#Form_CountyForm_County').val();
	  });
	  $('#get-location').on('click', function(e){
	      //$('#results').innerHTML = 'Loading...';
	      getLocation();
	  });
});


var geocoder;  // this object will handle the position<->address conversion
var x = document.getElementById("demo");
//var countyName;

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(locationSuccess, showError); // , {maximumAge:60000, timeout:5000, enableHighAccuracy:true}
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}


function locationSuccess(position){
      lat = position.coords.latitude;
      lon = position.coords.longitude;
      latlon = new google.maps.LatLng(lat, lon);

      geocoder = new google.maps.Geocoder();
      geocoder.geocode({'latLng': latlon}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {

          var county = getCounty(results[0]);
         // document.getElementById('County').innerHTML = 'County: ' + county;

          var countyName = convertToSlug(county);
          countyName = countyName.replace("-county", "");
          //countyName =  convertToSlug(countyName);

          //alert(countyName);

          $('#results').load('directory/county/load/'+ countyName);
          window.location.hash = '#'+ countyName;
          
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
    x.innerHTML = "Location found."
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
    switch(error.code) {
        case error.PERMISSION_DENIED:
            x.innerHTML = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:

            x.innerHTML = "Locatiotn information is unavailable."
            break;
        case error.TIMEOUT:
            x.innerHTML = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            x.innerHTML = "An unknown error occurred."
            break;
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