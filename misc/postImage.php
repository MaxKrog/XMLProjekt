<?php

include "./isLoggedIn.php";
include "./imageprocessing.php";

if( isLoggedIn() ) {

	try {
		$filename_medium  = "/uploadedImages/" . "medium_" . $_FILES["image"]["size"] . "_" . $_FILES["image"]["name"];
		$filename_thumb = "/uploadedImages/" . "thumb_" . $_FILES["image"]["size"] . "_" . $_FILES["image"]["name"];
		move_uploaded_file($_FILES["image"]["tmp_name"], getcwd() . $filename_medium);
		createThumb(getcwd() . $filename_medium, getcwd() . $filename_thumb);
		createMedium(getcwd() . $filename_medium, getcwd() . $filename_medium);


		$image_medium = "../misc" . $filename_medium ;
		$image_thumb = "../misc" . $filename_thumb;
		$title = htmlspecialchars($_POST["title"]);
		$caption = htmlspecialchars($_POST["caption"]);
		$lat = $_POST["lat"];
		$lng = $_POST["lng"];
		$username = $_COOKIE["username"];
		$createdAt = date("Y-m-d H:i:s");
		$query =" 
			INSERT INTO posts
			(image_medium, image_thumb, title, caption, lat, lng, username, createdAt)
			VALUES('$image_medium','$image_thumb', '$title', '$caption', $lat, $lng, '$username', '$createdAt');";
			
		include "../database/connection.php";
		
		if(!$mysqli->query($query)){
			
			throw new Exception($mysqli->error);
			
		} elseif( isset($_POST["tags"]) && strlen($_POST["tags"]) > 0 ) {
			//Connect post to tags
			$post_id = $mysqli->insert_id;

			$tags = explode(",", $_POST["tags"]);


			foreach($tags as $tag){
				$mysqli->query("INSERT INTO post_tags VALUES($post_id, '$tag');");
				}
			
		}
		
		echo("success!");
	} catch (Exception $e) {
		header('X-PHP-Response-Code: 406', true, 406);

	}

	
} else {
	header('X-PHP-Response-Code: 401', true, 401);
}
