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

    	marker.addListener("click", function(){
    		$(_this).fadeIn(100).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);

    		var container = $("#posts");
			var scrollTo = $(_this);

			container.animate({
				scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop()
			});
    	})

    	markers.push(marker);

    	$(this).find("#goto").click(function(){
    		map.setCenter(marker.getPosition());
    		map.setZoom(14);
    	})

    	$(this).find("#update").click(function(){
    		$("#updatemodal").modal();

            $("#updatemodal").on("hidden.bs.modal", function(){
                $("#save").unbind();
                $("#delete").unbind();
            })


    		$("#title").val( $(_this).data("title"));
    		$("#caption").val( $(_this).data("caption"));

    		$("#save").click(function(){
    			console.log("KLICKADE SAVE!");

    			var data = {
    				id: $(_this).data("id"),
    				title: $("#title").val(),
    				caption: $("#caption").val(),
                    type: "PUT"
    			};
    			console.log(data);

    			$.ajax({
    				type: "POST",
    				url: "../misc/postAPI.php",
    				data: data,
    				success: function(a){
                        console.log(a);
    					console.log("Success på klient");
    					$(_this).find(".spanTitle").text(data.title);
    					$(_this).find(".spanCaption").text(data.caption);
 						$("#updatemodal").modal("hide");


    				},
    				error: function(a, b, c){
                        console.log(a);
                        console.log(b);
                        console.log(c);
    					$("#updatemodal").modal("hide");
    					console.log("Error på klient");

    				}

    			})
    		});

            $("#delete").click(function(){

                $.ajax({
                    type: "POST",
                    url: "../misc/postAPI.php",
                    data: {type: "DELETE", id: $(_this).data("id")},
                    success: function(a){
                        console.log("Success delete on client");
                        $(_this).remove();
                        marker.setMap(null);
                        $("#updatemodal").modal("hide");
                        console.log(a);
                    },
                    error: function(){
                        console.log("Error delete on client");
                        console.log(a);
                        console.log(b);
                        console.log(c);
                    }
                })
            });

    	})



	})

	var bounds = new google.maps.LatLngBounds();
	for(i=0;i<markers.length;i++) {
 		bounds.extend(markers[i].getPosition());
	}

	map.fitBounds(bounds);
};

//UPDATING A POST




// DESIGN JS FROM HERE AND DOWNWARDS

$(document).ready(function() {
	keepMapHeight();
	$(window).resize(function(){
		keepMapHeight();
	})
});

function keepMapHeight() {
	if($(document).width() >= 992 ){
		var height = window.innerHeight - $("#googleMap").offset().top - 20;
		$("#googleMap").height(height);
		var height = window.innerHeight - $("#posts").offset().top - 20;
		$("#posts").height(height);
	} else {
		$("#googleMap").height(window.screen.availHeight-200);
	}
}


