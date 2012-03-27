// JavaScript Document

// JavaScript Document

jQuery(document).ready(function() {
	//Lightbox.init();						   
	//khoi tao gmap
	var geocoder;
	var map;
	
	if(jQuery("#adminForm #lat").val() != "" && jQuery("#adminForm #lat").val() != 0 && jQuery('#adminForm #long').val() !='' && jQuery('#adminForm #long').val() != 0){
		initMap();
	}else{
		initMap1();
	}
	
	//if(jQuery("#adminForm #default_gmap_address").val() != "" && typeof(jQuery("#adminForm #default_gmap_address").val()) != "undefined") initMap1();
	//else initMap();
	//gmap					   
	//khoi tao gmap theo toa do lat long
	function initMap(){
	
			var	geocoder = new google.maps.Geocoder();
			var latlng = new google.maps.LatLng(jQuery("#adminForm #lat").val(),jQuery("#adminForm #long").val());
			var myOptions = {
			  zoom: 14,
			  center: latlng,
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			}
			map = new google.maps.Map(document.getElementById("load_gmap"), myOptions);
			latlng	= new google.maps.LatLng(jQuery("#adminForm #lat").val(),jQuery("#adminForm #long").val());
			//geocoder.getLocations(latlng, showAddress);
			geocoder.geocode({'latLng': latlng}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
			  if (results[1]) {
				map.setZoom(14);
				marker = new google.maps.Marker({
					position: latlng, 
					map: map
				}); 
				//infowindow.setContent(results[1].formatted_address);
				//infowindow.open(map, marker);
			  }
			} else {
				//alert("Địa điểm nA y chưa được cập nhật trA�n bản đồ.");
			}
			});
	}
	//khoi tao gmap theo dia chi
	function initMap1(){
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(0, 0);
		var myOptions = {
		  zoom: 15,
		  center: latlng,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		}
    	map = new google.maps.Map(document.getElementById("load_gmap"), myOptions);
		if (geocoder) {
		  var address	= jQuery("#adminForm #default_gmap_address").val();
		  geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
			  map.setCenter(results[0].geometry.location);
			  var marker = new google.maps.Marker({
				  map: map, 
				  draggable: false,
				  position: results[0].geometry.location
			  });
			  google.maps.event.addListener(marker, "dragstart", function() {
				  map.closeInfoWindow();
				});			
			  google.maps.event.addListener(marker, "dragend", function() {												
					var lt =marker.position.lat().toString();
					var lng=marker.position.lng().toString();
					jQuery.lat	= lt;
					jQuery.long	= lng;
					jQuery("#adminForm #gmap_position").val(lt + "," + lng);
					var infowindow = new google.maps.InfoWindow(
					  { content: "NhA  của bạn được xA�c định tại đA�y trA�n bản đồ",
						size: new google.maps.Size(10,10)
					  });
					infowindow.open(map,marker);
				});
				//map.addOverlay(marker);	
			} else {
			  //alert("Địa điểm nA y chưa được cập nhật trA�n bản đồ.");
			}
			
		  });  
		}//if
	}
});						   