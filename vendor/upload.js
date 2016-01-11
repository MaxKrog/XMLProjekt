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
        mapTypeControl: false
        }

    positionMap = new google.maps.Map( document.getElementById("locationMap"), mapOptions);

    positionMap.addListener("dragend", function(){
		newPosition(positionMap.getCenter());
	})
    
    userPositionMarker = new google.maps.Marker({
        position: {
            lat: userPosition.lat,
            lng: userPosition.lng
        },
        map: positionMap
    });

    if( getParameterByName("lat").length > 0 && getParameterByName("lng").length > 0){
    	//THIS IS CALLED IF POSITION IS SET IN URL
    	var position = {
    		coords: {
    			latitude: getParameterByName("lat"),
    			longitude: getParameterByName("lng")
    		}
    	};
    	newPosition(position);
    } else if (navigator.geolocation){
    	navigator.geolocation.getCurrentPosition(newPosition);
    }
    
}

function newPosition(position, k){

	userPosition.lat = position.coords ? position.coords.latitude : position.lat();
	userPosition.lng = position.coords ? position.coords.longitude : position.lng();

	positionMap.setCenter(new google.maps.LatLng(userPosition.lat, userPosition.lng));
	userPositionMarker.setPosition(new google.maps.LatLng(userPosition.lat, userPosition.lng));


};


//HELPER FUNCTIONS

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}


//FORM SCRIPTS HERE ON DOWNWARDS
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

		var image = $("#image")[0].files[0];

		if(typeof image === "undefined"){
			alert("You must choose an image before uploading");
			return;
		} else if (!image.name.match(/\.(png)$/)){
			alert("The image must be in png format!");
			return;
		}

		var formdata = new FormData();
		formdata.append("title", $("#title").val());
		formdata.append("caption", $("#caption").val());
		formdata.append("image", $("#image")[0].files[0]);
		formdata.append("lat", userPosition.lat);
		formdata.append("lng", userPosition.lng);
		formdata.append("tags", getTags());

		//Change button style to indicate transfer in progress.
		$("#submit").attr('disabled', true);
		$("#submit").removeClass("btn-success");
		$("#submit").addClass("btn-warning");
		$("#submit").text("Upload in progress");

	    $.ajax({
	        url: '../misc/postImage.php',  //Server script to process data
	        type: 'POST',
	        data: formdata,
			//ajax-settings
			processData: false,
			contentType: false,
			complete: function(){
				//Turn button back to normal
				$("#submit").removeClass("btn-warning");
				$("#submit").addClass("btn-success");
				$("#submit").text("Upload image");
				$("#submit").attr('disabled', false);
			},
		        //Ajax events
		    success: function( a){
				console.log(a);
				window.location = "./index.php";
			},
			error: function(a, b, c){ 
				console.log(a);
				console.log(b);
				console.log(c);
				alert("Something went wrong with your upload on the server-side. Description: \n" + c);
				
			}
	    });
	});
});


