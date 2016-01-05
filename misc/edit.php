<?php
include "./auth/isLoggedIn.php";
include "./database/connection.php";

if( isLoggedIn() ) {
	
	$username = $_COOKIE["username"];

	$query = "SELECT * FROM posts WHERE username = '$username'";
	$result = mysqli_query($mysqli, $query);

	$returnstring = '';

	
	while ($line = $result->fetch_object()) {
		$post_id = $line->post_id;
		$title = $line->title;
		$caption = $line->caption;
		$user = $line->username;
		$createdAt = $line->createdAt;

		$returnstring .= "<a href='edit_post.php?id=$post_id'>$caption</a> ";

	}


	mysqli_free_result($result);
	print utf8_encode($returnstring);
	$mysqli->close();
}
?>


