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
//HERE WE GOT THE MAIN POST-INFO
$post = $result->fetch_object();
mysqli_free_result($result);

$query = "SELECT tag FROM post_tags WHERE post_id = '$post_id';";
$result = mysqli_query($mysqli, $query);
$tags = "";

while($line = $result->fetch_object()){
	$tags .= "<tag>" . $line->tag . "</tag>";
}

header("Content-type: text/xml; charset=utf-8"); ?>
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE kriz SYSTEM "http://xml.csc.kth.se/~mkrog/DM2517/projekt/dtd/post.dtd">
<kriz>
	<?php 
	include("../misc/userinfo.php");
	userinfo();
	?>
	<post id='<?php echo($post_id) ?>'>
		<title><?php echo($post->title); ?> </title>
		<caption><?php echo($post->caption); ?> </caption>
		<imagemedium><?php echo($post->image_medium); ?> </imagemedium>
		<imagethumb><?php echo($post->image_thumb); ?> </imagethumb>
		<location>
			<lat><?php echo($post->lat); ?> </lat>
			<lng><?php echo($post->lng); ?> </lng>
		</location>
		<user><?php echo($post->username); ?> </user>
		<createdat><?php echo($post->createdAt); ?> </createdat>
		<tags><?php echo($tags); ?> </tags>

    </post>
</kriz>