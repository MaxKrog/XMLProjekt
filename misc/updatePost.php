
<?php
include "./isLoggedIn.php";
include "../database/connection.php";

if( isLoggedIn() ) {
	
	$username = $_COOKIE["username"];
	$post_id = $_POST['id'];


	$title = htmlspecialchars($_POST['title']);
	$caption = htmlspecialchars($_POST['caption']);

	$query = "UPDATE posts SET title='$title', caption='$caption' WHERE post_id = $post_id";

	$retval = mysqli_query($mysqli, $query);

	if(! $retval ) {
		die('Could not update data: '.$mysqli->error);
	} else {
		echo("Funkade på servern!");
		die();
	}

}

$mysqli->close();

?>

