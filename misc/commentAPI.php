<?php
// THIS SCRIPT SUPPORTS
// POST:ing a new comment. Supply comment and the post_id. Make sure user is logged in.

if ( ($_SERVER['REQUEST_METHOD'] === 'POST') AND ($_POST["type"] === "POST") ) { 
	
	if(!(isset($_COOKIE["username"]))){ //Check that user is logged in.

		header('HTTP/1.1 401 Unauthorized', true, 401);	
		die("You have no business here");
	}

	$comment = $_POST["comment"];
	$post_id = $_POST["id"];
	$username = $_COOKIE["username"];
	$createdAt = date("Y-m-d H:i:s");
	
	$query = "INSERT INTO comments (post_id, comment, username, createdAt) VALUES ('$post_id', '$comment', '$username', '$createdAt');";
	include "../database/connection.php";

	if( $mysqli->query($query)){
		echo("Successfully added on server");
		die();
	}else{
		header('HTTP/1.1 500 Internal Server Error', true, 500);
		die();
	}


	echo(json_encode($JSON));
	die();

}  elseif ( ($_SERVER['REQUEST_METHOD'] === 'POST') AND ($_POST["type"] === "DELETE") ) { 

	$username = $_COOKIE["username"];
	$comment_id = $_POST["id"];

	include "../database/connection.php";
	if(!$mysqli->query("DELETE FROM comments WHERE username = '$username' AND comment_id = '$comment_id';")){
		header('HTTP/1.1 500 Internal Server Error', true, 500);
		die();
	} else {
		echo("Successfully deleted on server");
		die();
	}

} else {
	header('HTTP/1.1 501 Not implemented', true, 501);
	die("Not implemented");
}


