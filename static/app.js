/* Executed by callback-function of map-loader */
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

    var mainMap = new google.maps.Map( document.getElementById("map"), mapOptions);
    
    createLocationMap();
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

    var locationMap = new google.maps.Map( document.getElementById("locationMap"), mapOptions);
    
    var marker = new google.maps.Marker({
        position: {
            lat: 59.329323,
            lng: 18.068581
        },
        map: locationMap
    });
    
    getLocation(function(err, position){
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