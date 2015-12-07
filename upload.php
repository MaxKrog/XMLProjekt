<?php

include "./auth/isLoggedIn.php";
if( isLoggedIn() ) {
	header("Status: 200");

	$filename  = "/uploadedImages/" . $_FILES["image"]["size"] . "_" . $_FILES["image"]["name"];
	$dest = getcwd() . $filename;
	move_uploaded_file($_FILES["image"]["tmp_name"], $dest);
	

	$image = $filename;
	$title = $_POST["title"];
	$caption = $_POST["caption"];
	$lat = $_POST["lat"];
	$lng = $_POST["lng"];
	$username = $_COOKIE["username"];
	$createdAt = date("Y-m-d H:i:s");
	$query =" 
		INSERT INTO posts
		(image, title, caption, lat, lng, username, createdAt)
		VALUES('$image', '$title', '$caption', $lat, $lng, '$username', '$createdAt');";
	include "./database/connection.php";
	if(!$mysqli->query($query)){
		
		echo($mysqli->error);
		
	} elseif( isset($_POST["tags"]) && strlen($_POST["tags"]) > 0 ) {
		//Connect post to tags
		$post_id = $mysqli->insert_id;
		echo($_POST["tags"]);
		$tags = explode(",", $_POST["tags"]);
		echo($tags);

		foreach($tags as $tag){
			$mysqli->query("INSERT INTO post_tags VALUES($post_id, '$tag');");
			}
		
	}

	
} else {
	header("Status: 401");
	echo("Not logged in!"); 
}



?>
