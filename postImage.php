<?php

include "./auth/isLoggedIn.php";
include "./imageprocessing.php";

if( isLoggedIn() ) {
	header("Status: 200");

	$filename_medium  = getcwd() . "/uploadedImages/" . "medium_" . $_FILES["image"]["size"] . "_" . $_FILES["image"]["name"];
	$filename_thumb = getcwd() . "/uploadedImages/" . "thumb_" . $_FILES["image"]["size"] . "_" . $_FILES["image"]["name"];
	move_uploaded_file($_FILES["image"]["tmp_name"], $filename_medium);
	createThumb($filename_medium, $filename_thumb);
	createMedium($filename_medium, $filename_medium);

	$image_medium = $filename_medium;
	$image_thumb = $filename_thumb;
	$title = $_POST["title"];
	$caption = $_POST["caption"];
	$lat = $_POST["lat"];
	$lng = $_POST["lng"];
	$username = $_COOKIE["username"];
	$createdAt = date("Y-m-d H:i:s");
	$query =" 
		INSERT INTO posts
		(image_medium, image_thumb, title, caption, lat, lng, username, createdAt)
		VALUES('$image_medium','$image_thumb', '$title', '$caption', $lat, $lng, '$username', '$createdAt');";
		
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
	
	echo("success!");

	
} else {
	header('The goggles, they do nawtink!', true, 401);
}



?>
