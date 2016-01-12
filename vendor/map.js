var map;
var markers = [];

var infoWindow = new google.maps.InfoWindow();

function initializeMap() {

	var mapProp = {
		center: new google.maps.LatLng(51.508742,-0.120850),
		zoom: 15,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		draggableCursor:"url(http://www.clker.com/cliparts/e/3/F/I/0/A/google-maps-marker-for-residencelamontagne-hi.png)"
	};

	map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

	fetchData(map);
	addMarkerWindow();
}
google.maps.event.addDomListener(window, 'load', initializeMap);


function fetchData(){
	$.ajax({
		type: "GET",
		url: "../misc/postAPI.php",
		success: function(data){
			console.log(data);
			addMarkers(data);
		},
		error: function(a, b, c){
			console.log(a);
			console.log(b);
			console.log(c);
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
			var infocontent = infocontent +  '<a href="http://xml.csc.kth.se/~mkrog/DM2517/projekt/pages/post.php?id=' + item.post_id + '" >';
				var infocontent = infocontent +  '<h5 class="media-heading" style="width:170px">' + item.title + '</h5>';
			var infocontent = infocontent +  '</a>';
			var infocontent = infocontent +  '<p style="width:170px">' + item.caption + '</p>';
			var infocontent = infocontent + '<i style="font-size: 10px; width:170px">Uploaded by: '+ item.username +'</i>';
			var infocontent = infocontent + '<br/><i style="font-size: 10px; width:170px">'+ item.created_at +'</i>';
			var infocontent = infocontent + '<br/><i style="font-size: 10px; width:170px">Comments: '+ item.commentcount +'</i>';
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

//ADD POST JS
function addMarkerWindow(){

	if(!(document.cookie.indexOf("username") >= 0)){ //If they're not logged in, dont show this window.
		return;
	}
	//IF LOGGED IN

	var $addPinWindow = $('<div style="position:fixed; top: 5px; right: 5px; height:35px; background-color:white"></div>');
	$addPinWindow.css("margin","10px 10px 0 0");
	$addPinWindow.css("border-radius","5px");
	$addPinWindow.css("line-height","50px");
	$addPinWindow.css("font-size","20px");
	$addPinWindow.css("text-align","center");
	$addPinWindow.css("background-color","#5cb85c");
	$addPinWindow.css("cursor","pointer");
	$addPinWindow.index = 1;
	$addPinButton = $('<button type="button" class="btn btn-success">Add Post</button>');
	$addPinWindow.append($addPinButton);

	$addPinButton.click(function(){
		$(this).text("Select a location by clicking");
		$(this).removeClass("btn-success");
		$(this).addClass("btn-warning");

		var marker = new google.maps.Marker({
	    	map: map,
	    	title:"Drag me!",
	    	clickable: false
		});

		google.maps.event.addListener(map, 'mousemove', function(e) {
			marker.setPosition(e.latLng);
		});

		google.maps.event.addListener(map, "click", function(e){

			window.location = "./upload.php?lat=" + e.latLng.lat() + "&lng=" + e.latLng.lng();
		})
	});

	map.controls[google.maps.ControlPosition.TOP_RIGHT].push($addPinWindow[0]);

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
