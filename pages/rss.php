<?php 
	header("Content-type: text/xml; charset=utf-8");

	include "../database/connection.php";



	$query = "
		SELECT post_id, title, caption, username, createdAt
		FROM posts
		ORDER BY post_id DESC
		LIMIT 10;";

	$result = mysqli_query($mysqli, $query);

	$items = "";
	while ($line = $result->fetch_object()) {
		$post_id = $line->post_id;
		$title = $line->title;
		$caption = $line->caption;
		$username = $line->username;
		$createdAt = $line->createdAt;
		$createdAt = date_create_from_format("Y-m-d H:i:s", $createdAt); //Convert to date
        $createdAt = date_format($createdAt, 'r'); //Get requested format from date

		$item ="
			<item>
				<title>$title</title>
				<description>$username uploaded a new post.</description>
				<link>http://xml.csc.kth.se/~mkrog/DM2517/projekt/pages/index.php</link>
				<guid>http://xml.csc.kth.se/~mkrog/DM2517/projekt/pages/index.php/$post_id</guid>
				<pubDate>$createdAt</pubDate>
			</item>
			";
		$items .= $item;

	}

?>
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
	<channel>
		<title>Krizfeed RSS Feed</title>
		<link>http://xml.csc.kth.se/~mkrog/DM2517/projekt/pages/index.php/</link>
		<description>A live feed of photos</description>
		<?php echo($items); ?>
	</channel>
</rss>