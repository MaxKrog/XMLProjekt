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

		require_once './twitter/twitter.class.php';
		$consumerKey = "36SAF1xFsyzakSGazWwQgkabM";
		$consumerSecret = "SMA45qfZM8JyOfcXxMTVJvs9BTFb3fNaGOweXOriD0iDJsrqgV";
		$accessToken = "4774088265-mSNkU78lrEfXTQcvDtyhwunpM6X4cnIZcSvs5sf";
		$accessTokenSecret = "0cQtqqJmuPix8onmMSDmkNz24Re8oGyUO4xODFQo1Vbud";

		// ENTER HERE YOUR CREDENTIALS (see readme.txt)
		$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
		$twitterText = $title . "\n" . $caption . "\n" . "Uploaded by: " . $username;
		$twitterImage = getcwd() . $filename_medium;

		try {
			$tweet = $twitter->send($twitterText, $twitterImage);
		} catch (TwitterException $e) {
			echo 'Error: ' . $e->getMessage();
		}

		
		echo("success!");
	} catch (Exception $e) {
		header('X-PHP-Response-Code: 406', true, 406);

	}

	
} else {
	header('X-PHP-Response-Code: 401', true, 401);
}

