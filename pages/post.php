<?php
if( $_SERVER['REQUEST_METHOD'] !== 'GET'){
	//Needs to be of type GET and an ID needs to be set.
	echo("You can only GET this url. Do you get it?");
	die();
}

//THIS BLOCK GETS THE POST
include "../database/connection.php";
$post_id = $_GET["id"];
$query = "SELECT * FROM posts WHERE post_id = '$post_id';";
$result = mysqli_query($mysqli, $query);

if( mysqli_num_rows($result) == 0){
	//IF NO RESULT, IT WAS A BAD ID.
	echo("No post was found for that ID. You now have to write an angry note.");
	die();
}
$line = $result->fetch_object();


header("Content-type: text/xml; charset=utf-8"); ?>
<?xml version="1.0" encoding="utf-8"?>


<!DOCTYPE post SYSTEM "http://xml.csc.kth.se/~mkrog/DM2517/projekt/dtd/post.dtd">
<kriz>
	<?php 
	include("../misc/userinfo.php");
	userinfo();
	?>
	<post>
		<title><?php echo($line->title); ?> </title>
		<caption><?php echo($line->caption); ?> </caption>
		<imagemedium><?php echo($line->imagemedium); ?> </imagemedium>
		<imagethumb><?php echo($line->imagethumb); ?> </imagethumb>
		<location>
			<lat><?php echo($line->lat); ?> </lat>
			<lng><?php echo($line->lng); ?> </lng>
		</location>
		<user><?php echo($line->user); ?> </user>
		<createdat><?php echo($line->createdat); ?> </createdat>
		<tags><?php //echo($line->tags); ?> </tags>

    </post>
</kriz>