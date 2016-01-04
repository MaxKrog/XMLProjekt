<?php header("Content-type: text/xml; charset=utf-8"); ?>
<?xml version="1.0" encoding="utf-8"?>
<?xml-stylesheet type="text/xsl" href="xsl/index.xsl"?>
<!DOCTYPE kriz SYSTEM "http://xml.csc.kth.se/~mkrog/DM2517/projekt/dtd/index.dtd">
<kriz>
	<userinfo>
    <?php
    	include "./auth/isLoggedIn.php";
    	if( isLoggedIn() ) {
    		echo("<authorized>true</authorized>");
    		echo("<username>" . $_COOKIE["username"] . "</username>" );
    	} else {
    		echo("<authorized>false</authorized>");
    	} 
	?>
    </userinfo>
	<posts>
		<?php

			include "./database/connection.php";

			$query = "SELECT A.post_id, image, title, caption, lat, lng, username, createdAt, tag
						FROM posts AS A
						JOIN post_tags AS B ON A.post_id = B.post_id
					ORDER BY post_id DESC";

			$result = mysqli_query($mysqli, $query);

			$returnstring = '';

			$line = $result->fetch_object();
			while ($line) {
				$post_id = $line->post_id;
				$title = $line->title;
				$image_medium = $line->image_medium;
				$image_thumb = $line->image_thumb;
				$caption = $line->caption;
				$lat = $line->lat;
				$lng = $line->lng;
				$user = $line->username;
				$createdAt = $line->createdAt;
				

				$returnstring .= "<post id='$post_id'>";
	            $returnstring .= "<title>$title</title>";
	            $returnstring .= "<caption>$caption</caption>";
				$returnstring .= "<imagemedium>$image_medium</imagemedium>";
				$returnstring .= "<imagethumb>$image_thumb</imagethumb>";
	            $returnstring .= "<location>";
	            $returnstring .= "<lat>$lat</lat>";
	            $returnstring .= "<lng>$lng</lng>";
	            $returnstring .= "</location>";
	            $returnstring .= "<user>$user</user>";
	            $returnstring .= "<createdat>$createdAt</createdat>";
	            $returnstring .= "<tags>";
	            do{
	            	$tag = $line->tag;
	            	$returnstring .= "<tag>$tag</tag>";
	            	$line = $result->fetch_object();
	            } while ( $line->post_id == $post_id );
	            $returnstring .= "</tags>";
	            $returnstring .= "</post>";

	        }
			mysqli_free_result($result);
        	echo($returnstring);

        ?>
    </posts>
</kriz>

