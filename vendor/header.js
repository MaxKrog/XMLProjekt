$(document).ready(function(){
	var href = window.location.pathname;
	href = href.split("/");
	var activeUrl = href[href.length - 1];
	$("a[href$='" + activeUrl + "']").css("color", "white");
})