<?php header("Content-type: text/xml; charset=utf-8"); ?>
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE kriz SYSTEM "http://xml.csc.kth.se/~mkrog/DM2517/projekt/dtd/main.dtd">
<kriz>
	<posts>
		<?php

			include "./database/connection.php";

			$query = "SELECT * FROM posts ORDER BY post_id DESC;";

			$result = mysqli_query($mysqli, $query);

			$returnstring = '';

			while ($line = $result->fetch_object()) {
				$post_id = $line->post_id;
				$title = $line->title;
				$image = $line->image;
				$caption = $line->caption;
				$lat = $line->lat;
				$lng = $line->lng;
				$user = $line->user;

				$returnstring .= "<post id='$post_id'>";
	            $returnstring .= "<title>$title</title>";
	            $returnstring .= "<caption>$caption</caption>";
				$returnstring .= "<image>$image</image>";
	            $returnstring .= "<location>";
	            $returnstring .= "<lat>$lat</lat>";
	            $returnstring .= "<lng>$lng</lng>";
	            $returnstring .= "</location>";
	            $returnstring .= "<user>$user</user>";
	            $returnstring .= "<tags></tags>";
	            $returnstring .= "</post>";

	        }
			mysqli_free_result($result);
        	echo($returnstring);

        ?>
    </posts>
</kriz>
