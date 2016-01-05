function reset(){

	$.ajax({
		url: "./admin.php",
		data: {},
		dataType: "json",
		success: function(users){
			console.log(users);
			updateTable(users);
		}
	});
}

function updateTable(users){
	$("#tbody").empty();

	users.map(function(user){

		var $username = user.username;
		var $password = $("<input type='text' class='form-control' value='" + user.password + "'/>");
		var $admin = $("<input type='checkbox' class='form-control' value=''/>");
		var $delete = $("<button type='button' class='btn btn-danger' aria-label='Left Align'> Delete </button>")
		var $update = $("<button type='button' class='btn btn-default' aria-label='Left Align'> Update </button>")

		if( user.role === "admin") $admin.prop("checked", true);

		var $userRow = $("<tr></tr>");

		$userRow.append( $("<td></td>").append( $username));
		$userRow.append( $("<td></td>").append( $password));
		$userRow.append( $("<td></td>").append( $admin));
		$userRow.append( $("<td></td>").append( $delete));
		$userRow.append( $("<td></td>").append( $update));
		$("#tbody").append($userRow);

		$delete.click(function(){ //DELETE
			$.ajax({
				url: "./admin.php",
				type: "POST",
				data: {username: user.username, type: "DELETE"},
				success: function(a){
					console.log("Success delete on client");
					console.log(a);
					reset();
				},
				error: function(a, b, c) {
					console.log(a);
					console.log(b);
					console.log(c);
				}
			})
		})

		$update.click(function(){ //UPDATE
			var data = {
				username: user.username,
				password: $password.val(),
				role: $admin.prop("checked") ? "admin" : "user",
				type: "PUT"
			};
			$.ajax({
				url: "./admin.php",
				type: "POST",
				data: data,
				success: function(a){
					console.log("Success update on client");
					console.log(a);
					reset();
				},
				error: function(a, b, c) {
					console.log(a);
					console.log(b);
					console.log(c);
				}
			})
		})

	})
}

$("#add").click(function(){

	var $username = $("<input type='text' class='form-control'/>");
	var $password = $("<input type='text' class='form-control' />");
	var $admin = $("<input type='checkbox' class='form-control' value=''/>");
	var $cancel = $("<button type='button' class='btn btn-warning' aria-label='Left Align'> Cancel </button>")
	var $save = $("<button type='button' class='btn btn-default' aria-label='Left Align'> Add </button>")

	var $userRow = $("<tr></tr>");

	$userRow.append( $("<td></td>").append( $username));
	$userRow.append( $("<td></td>").append( $password));
	$userRow.append( $("<td></td>").append( $admin));
	$userRow.append( $("<td></td>").append( $cancel));
	$userRow.append( $("<td></td>").append( $save));
	$("#tbody").append($userRow);
	$username.focus();

	$cancel.click(function(){
		$userRow.remove();
	})

	$save.click(function(){
		var user = {
			username: $username.val(),
			password: $password.val(),
			role: $admin.prop("checked") ? "admin" : "user",
			type: "POST"
		};

		$.ajax({
			url: "./admin.php",
			type: "POST",
			data: user,
			success: function(a){
				console.log("success!");
				console.log(a);
				reset();
			},
			error: function(a){
				console.log("Error!");
			}
		})
	})

})

$("#adminpanel").click(function(){
	$("#modal").modal();
	reset();
})