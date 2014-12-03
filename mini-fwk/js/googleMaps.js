var map, mapOptions;
	
	  function initialize() {
    var myLatlng = new google.maps.LatLng(49.8940670, 2.2957530); //Centrage sur Amiens
    myOptions =	{
      zoom: 13,
      center: myLatlng,
      disableDefaultUI: true,
      backgroundColor: '#efedbe',
      mapTypeControl: true,
      mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.DEFAULT
      },
      navigationControl: true,
      navigationControlOptions: {
        style: google.maps.NavigationControlStyle.DEFAULT
      },
      scaleControl: true,
      scaleControlOptions: {
        position: google.maps.ControlPosition.BOTTOM_LEFT
      },
      mapTypeId: google.maps.MapTypeId.TERRAIN
    };
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	
	var infowindow = new google.maps.InfoWindow();
    var marker, i;
	
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(49.8942788, 2.298752400000012),
        map: map
      });
 
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent('Australian Bar');
          infowindow.open(map, marker);
        }
      })(marker, i));
    
  }
      google.maps.event.addDomListener(window, 'load', initialize);