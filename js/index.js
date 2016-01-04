console.log("bla");

var map;
var markers = [];
function initializeMap() {
	var mapProp = {
	center: new google.maps.LatLng(51.508742,-0.120850),
	zoom: 15,
	mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

	addMarkers(map);
}
google.maps.event.addDomListener(window, 'load', initializeMap);

function addMarkers(map){
	$(".list-group-item").each(function(item){
		var _this = this;
		
		var marker = new google.maps.Marker({
        	position: {
            	lat: parseFloat($(this).data("lat")),
            	lng: parseFloat($(this).data("lng"))
        	},
        	map: map
    	});

    	$(this).click(function(){
    		map.setCenter(marker.getPosition());
    		map.setZoom(14);
    	})

    	marker.addListener("click", function(){
    		$(_this).fadeIn(100).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
    	})

    	markers.push(marker);
	})

	var bounds = new google.maps.LatLngBounds();
	for(i=0;i<markers.length;i++) {
 		bounds.extend(markers[i].getPosition());
	}

	map.fitBounds(bounds);
};

