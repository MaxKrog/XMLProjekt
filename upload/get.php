<?php
header("Content-type: text/xml; charset=utf-8");
?>
<?xml version="1.0" encoding="utf-8"?>
<?xml-stylesheet type="text/xsl" href="get.xsl"?>
<!DOCTYPE tags SYSTEM "http://xml.csc.kth.se/~mkrog/DM2517/projekt/upload/tags.dtd">

<tags>

<?php
include "../database/connection.php";

$result = $mysqli->query("SELECT tag FROM tags;");
while($row = $result->fetch_row()){
	echo("<tag>" . $row[0] . "</tag>" );
}
?>
</tags>


