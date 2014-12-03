var map;
  var myOptions;
 
  function initialize(locations) {
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
	
	for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][7], locations[i][8]),
        map: map
      });
 
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][1]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  }
 
  function detectBrowser() {
    var useragent = navigator.userAgent;
    var mapdiv = document.getElementById("map_canvas");
 
    if (useragent.indexOf('iPhone') != -1 || useragent.indexOf('Android') != -1) {				
      mapdiv.style.width = '100%';
      mapdiv.style.height = '100%';
      myOptions = {
        navigationControlOptions: {
          style: google.maps.NavigationControlStyle.ANDROID
        },
        mapTypeControlOptions: {
          style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
        },
        disableDoubleClickZoom: true,
        scaleControl: false
      };
      map.setOptions(myOptions);
    } else {
      mapdiv.style.width = '100%';
      mapdiv.style.height = '100%';
    }
  }
 