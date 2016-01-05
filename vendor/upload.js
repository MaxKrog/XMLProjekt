/* Executed by callback-function of map-loader */

var positionMap;
var userPositionMarker;
var userPosition = {
	lat: 59.329323,
	lng: 18.068581
};

var createLocationMap = function(){

    var mapOptions = {
        center: {
            lat: userPosition.lat,
            lng: userPosition.lng
        },
        zoom: 16,
        streetViewControl: false,
        panControl: false,
        mapTypeControl: false,
        draggable: false
        }

    positionMap = new google.maps.Map( document.getElementById("locationMap"), mapOptions);
    
    userPositionMarker = new google.maps.Marker({
        position: {
            lat: userPosition.lat,
            lng: userPosition.lng
        },
        map: positionMap
    });

	getLocation();
    
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(newPosition, enableDrag);
    } else {
        enableDrag();
    }
}

function enableDrag(){

	positionMap.setOptions({draggable: true});
	positionMap.addListener("dragend", function(){
		newPosition(positionMap.getCenter());
	})
};

function newPosition(position, k){

	userPosition.lat = position.coords ? position.coords.latitude : position.lat();
	userPosition.lng = position.coords ? position.coords.longitude : position.lng();

	positionMap.setCenter(new google.maps.LatLng(userPosition.lat, userPosition.lng));
	userPositionMarker.setPosition(new google.maps.LatLng(userPosition.lat, userPosition.lng));


};

function getTags() {
	var tags = $("#tags span");
	var usedTags = [];
	tags.each(function(){
		if($(this).hasClass("label-success")){
			usedTags.push($(this).text());
		}
	});
	return usedTags;
}

$(document).ready(function(){

	$("#tags span").click(function(){
	    $(this).toggleClass("label-default");
	    $(this).toggleClass("label-success");
	})

	$('#submit').click(function(){
		console.log("Submit clicked!");

		var formdata = new FormData();
		formdata.append("title", $("#title").val());
		formdata.append("caption", $("#caption").val());
		formdata.append("image", $("#image")[0].files[0]);
		formdata.append("lat", userPosition.lat);
		formdata.append("lng", userPosition.lng);
		formdata.append("tags", getTags());
		console.log(formdata);
	    $.ajax({
	        url: '../misc/postImage.php',  //Server script to process data
	        type: 'POST',
	        data: formdata,
			//ajax-settings
			processData: false,
			contentType: false,
		        //Ajax events
		    success: function( a){
				console.log(a);
				window.location = "./index.php";
			},
			error: function(a, b, c){ 
				console.log(a);
				console.log(b);
				console.log(c);
				alert("Something went wrong!")
				
			}
	    });
	});
});


