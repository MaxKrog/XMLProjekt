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



	var infocontent = '<div class="media" style="width:300px">';
		var infocontent = infocontent +  '<div class="media-left">';
			var infocontent = infocontent +  '<a href="'+item.image_medium+'" target="_new">';
				var infocontent = infocontent +  '<img class="media-object" src="' + item.image_thumb + '" />';
			var infocontent = infocontent +  '</a>';
		var infocontent = infocontent +  '</div>';
		var infocontent = infocontent +  '<div class="media-body" style="width:170px; word-wrap:break-word">';
			var infocontent = infocontent +  '<h5 class="media-heading" style="width:170px">' + item.title + '</h5>';
			var infocontent = infocontent +  '<p style="width:170px">' + item.caption + '</p>';
			var infocontent = infocontent + '<i style="font-size: 10px; width:170px">Uploaded by: '+ item.username +'</i>';
		var infocontent = infocontent +  '</div>';
	var infocontent = infocontent +  '</div>';

    	marker.addListener("click", function(){
    		infoWindow.close();
    		infoWindow.setContent(infocontent);
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
