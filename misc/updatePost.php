
<?php
include "./isLoggedIn.php";


if( !isLoggedIn() ) {
	header('HTTP/1.1 401 Unauthorized', true, 401);	
	die("You have no business here");
} else {
	include "../database/connection.php";

	$username = $_COOKIE["username"];
	$role = $_COOKIE["role"];
	$post_id = $_POST['id'];


	if(!$role == "admin"){
		$query = "SELECT username FROM posts WHERE post_id = '$post_id';";
		$result = mysqli_query($mysqli, $query);
		$line = $result->fetch_object();
		if(!$username == $line->username){
				header('HTTP/1.1 401 Unauthorized', true, 401);	
				die("You have no business here");
		}
	}

	//AT THIS POINT WE KNOW THE USER IS AUTHORIZED TO CHANGE THE POST.
	if ($_SERVER['REQUEST_METHOD'] === 'POST' AND $_POST["type"] === "PUT") { //USER WANTS TO UPDATE INFO

		$title = htmlspecialchars($_POST['title']);
		$caption = htmlspecialchars($_POST['caption']);

		$query = "UPDATE posts SET title='$title', caption='$caption' WHERE post_id = $post_id";

		mysqli_query($mysqli, $query);
		die();

	} elseif( $_SERVER['REQUEST_METHOD'] === 'POST' AND $_POST["type"] === "DELETE"){

		$query = "DELETE FROM posts WHERE post_id = '$post_id';";
		$result = mysqli_query($mysqli, $query);
		echo("Success delete on server");

	}

}
?>

