<?php header("Content-type: text/xml; charset=utf-8"); ?>
<?xml version="1.0" encoding="utf-8"?>


<?php
/* Detect if mobile and use mobile stylesheet or desktop stylesheet */
include("../misc/Mobile_Detect.php");
$detect = new Mobile_Detect();

if($detect->isMobile()){
	print '<?xml-stylesheet type="text/xsl" href="../xsl/mobile/index.xsl"?>';
} else {
	print '<?xml-stylesheet type="text/xsl" href="../xsl/index.xsl"?>';
}
?>


<!DOCTYPE kriz SYSTEM "http://xml.csc.kth.se/~mkrog/DM2517/projekt/dtd/index.dtd">
<kriz>
	<?php 
	include("../misc/userinfo.php");
	userinfo();
	?>
	<posts>
		<?php
			include "../database/connection.php";


			$searchstring = isset($_GET["searchstring"]) ? $_GET["searchstring"] : "";

			$query = "
				SELECT O.post_id, image_medium, image_thumb, title, caption, lat, lng, O.username, O.createdAt, tags, count(comment) AS commentCount
    			FROM(
        			SELECT A.post_id, image_medium, image_thumb, title, caption, lat, lng, username, createdAt, GROUP_CONCAT(tag) as tags
        			FROM posts AS A
        			LEFT JOIN post_tags AS B 
            		ON A.post_id = B.post_id
        			GROUP BY post_id) AS O 
    			LEFT JOIN comments AS comments
    			ON O.post_id = comments.post_id
    			WHERE title LIKE '%$searchstring%' OR O.username LIKE '%$searchstring%' OR caption LIKE '%searchstring%' OR tags LIKE '%$searchstring%'
    			GROUP BY O.post_id

				ORDER BY post_id DESC;";

			$result = mysqli_query($mysqli, $query);

			$returnstring = '';

			while ($line = $result->fetch_object()) {
				$post_id = $line->post_id;
				$title = $line->title;
				$image_medium = $line->image_medium;
				$image_thumb = $line->image_thumb;
				$caption = $line->caption;
				$lat = $line->lat;
				$lng = $line->lng;
				$user = $line->username;
				$createdAt = $line->createdAt;
				$tags = explode(",", $line->tags);
				$commentCount = $line->commentCount;


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
	            foreach( $tags as $tag){
	            	$returnstring .= "<tag>$tag</tag>";
	            }
	            $returnstring .= "</tags>";
	            $returnstring .= "<commentcount>$commentCount</commentcount>";
	            $returnstring .= "</post>";

	        }
			mysqli_free_result($result);
        	echo($returnstring);

        ?>
    </posts>
</kriz>

