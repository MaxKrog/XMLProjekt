/* Executed by callback-function of map-loader */
var mainMap;
var locationMap;
var userLocation;
var createMainMap = function(){
    var mapOptions = {
        center: {
            lat: 59.329323,
            lng: 18.068581
        },
        zoom: 14,
        streetViewControl: false,
        panControl: false,
        mapTypeControl: false
        }

    mainMap = new google.maps.Map( document.getElementById("map"), mapOptions);
    
    createLocationMap();
	loadMarkers();
}

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

    locationMap = new google.maps.Map( document.getElementById("locationMap"), mapOptions);
    
    var marker = new google.maps.Marker({
        position: {
            lat: 59.329323,
            lng: 18.068581
        },
        map: locationMap
    });
    
    getLocation( function(err, position){
        if(err) return console.log(err);
        var userPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        locationMap.setCenter(userPosition);
        marker.setPosition(userPosition);
        
    })
    
}

function getLocation(callback) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position){
            callback(null, position);
        });
    } else {
        callback("Geolocation not supported!");
    }
}


/* Show Modal */
$('#addImageModal').modal();

$("#addImage").click(function(){
    $("#addImageModal").modal();
})


$("#form-tags span").click(function(){
    $(this).toggleClass("label-default");
    $(this).toggleClass("label-success");
})

$('#submit').click(function(){
	console.log("Submit clicked!");

	var formdata = new FormData();
	formdata.append("title", $("#title").val());
	formdata.append("caption", $("#caption").val());
	formdata.append("image", $("#image")[0].files[0]);
	formdata.append("lat", "50.5000");
	formdata.append("lng", "25.1231");
	formdata.append("tags", "Mord", "Djur", "Bajs");
    $.ajax({
        url: '../upload.php',  //Server script to process data
        type: 'POST',
	//ajax-settings
	processData: false,
	contentType: false,
        //Ajax events
        success: function( a){console.log(a)},
	error: function(a, b, c){ 
		console.log(a);
		console.log(b);
		console.log(c);
	},
        // Form data
        data: formdata


    });
});

var markers = [
	{"title": "hej",
	"caption": "hejsan",
	"lat": 59.1,
	"lng": 18.1},

	{"title": "hej",
	"caption": "hejsan",
	"lat": 59.2002,
	"lng": 18.2002},

	{"title": "hej",
	"caption": "hejsan",
	"lat": 59.3002,
	"lng": 18.3002}
];
function loadMarkers(){
	markers.map(function(obj){
		var marker = new google.maps.Marker({
			position: {
				title: obj.title,
			    lat: obj.lat,
			    lng: obj.lng
			},
			map: mainMap
	   	});
	});
};



