var map;
var markers = [];

var infoWindow = new google.maps.InfoWindow();

function initializeMap() {

	var mapProp = {
		center: new google.maps.LatLng(51.508742,-0.120850),
		zoom: 15,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

	fetchData(map);
}
google.maps.event.addDomListener(window, 'load', initializeMap);

function fetchData(){
	$.ajax({
		type: "GET",
		url: "../misc/postAPI.php",
		success: function(data){
			addMarkers(data);
		}
	})
}

function addMarkers(data){

	data.map(function(item){

		var _this = this;
		
		var marker = new google.maps.Marker({
        	position: {
            	lat: parseFloat(item.lat),
            	lng: parseFloat(item.lng)
        	},
        	map: map
    	});

    	

    	marker.addListener("click", function(){
    		infoWindow.close();
    		infoWindow.setContent(item.title);
    		infoWindow.open(map, marker);
    	});

    	markers.push(marker);
    });

    var bounds = new google.maps.LatLngBounds();
	for(i=0;i<markers.length;i++) {
 		bounds.extend(markers[i].getPosition());
	}

	map.fitBounds(bounds);
};

//DESIGN JS

$(document).ready(function(){
	updateMapSize();
	$(window).resize(updateMapSize);

	function updateMapSize(){
		var height = window.innerHeight - $("#googleMap").offset().top;
		$("#googleMap").height(height);
	}
})
