/* Executed by callback-function of map-loader */

var positionMap;
var userPositionMarker;
var userPosition = {
	lat: 0,
	lng: 0
};

var createLocationMap = function(){

    var mapOptions = {
        center: {
            lat: 59.329323,
            lng: 18.068581
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
            lat: 59.329323,
            lng: 18.068581
        },
        map: positionMap
    });

	getLocation();
    
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position){
		userPosition.lat = position.coords.latitude;
		userPosition.lng = position.coords.longitude;
		console.log("haej");
		console.log(userPosition);

			positionMap.setCenter(new google.maps.LatLng(userPosition.lat, userPosition.lng));
			userPositionMarker.setPosition(new google.maps.LatLng(userPosition.lat, userPosition.lng));
		

        });
    } else {
        alert("You need to share your position to upload images.");
    }
}

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

$("#tags span").click(function(){
    $(this).toggleClass("label-default");
    $(this).toggleClass("label-success");
	getTags();
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
    $.ajax({
        url: './postImage.php',  //Server script to process data
        type: 'POST',
	//ajax-settings
	processData: false,
	contentType: false,
        //Ajax events
    success: function( a){
		window.location = "http://xml.csc.kth.se/~mkrog/DM2517/projekt/index.php";
	},
	error: function(a, b, c){ 
		console.log(a);
		console.log(b);
		console.log(c);
		window.location = "http://xml.csc.kth.se/~mkrog/DM2517/projekt/auth/login.php";
		
	},
        // Form data
        data: formdata


    });
});


