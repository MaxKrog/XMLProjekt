$(document).ready(function(){
	enableComments();
	enableDelete();

	$("#toggleImage").click(function(){
		$(this).parent().find("img").toggleClass("hidden");
	})
})


function enableComments(){
	if( $("#addComment").length ){ //Checks that the div exists, if not the user is not logged in.

		$("#submit").click(function(){
			var comment = $("#comment").val();
			var id = window.location.search.split("=").pop(); //Gets the id of the post from the searchstring in url.
			if(comment.length < 5){
				alert("You need to enter atleast 5 characters in your comment.");
			}else{
				$.ajax({
					url: "../misc/commentAPI.php",
					type: "POST",
					data: {
						comment: comment,
						id: id,
						type: "POST"
					},
					success: function(a){
						console.log("Successfully added comment on client");
						console.log(a);
						window.location.reload();

					},
					error: function(a, b, c){
						console.log("Error when adding comment on client");
						console.log(a);
						console.log(c);
						alert("Something went wrong.");


					}

				})
			}
		})
	}
}

function enableDelete(){
	$(".deleteComment").click(function(){
		var id = $(this).data("id");
		$.ajax({
			url: "../misc/commentAPI.php",
			type: "POST",
			data: {
				id: id,
				type: "DELETE"
			},
			success: function(a){
				console.log("Successfully deleted on client");
				window.location.reload();
			},
			error: function(a, b, c){
				console.log("Error when deleting. On client");
				console.log(a);
				console.log(b);
				console.log(c);
				alert("Something went wrong!");
			}

		})

	})
}