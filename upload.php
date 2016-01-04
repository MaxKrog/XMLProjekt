<?php
header("Content-type: text/xml; charset=utf-8");
?>
<?xml version="1.0" encoding="utf-8"?>
<?xml-stylesheet type="text/xsl" href="xsl/upload.xsl"?>
<!DOCTYPE kriz SYSTEM "./dtd/tags.dtd">

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
	<tags>

<?php
		include "./database/connection.php";

		$result = $mysqli->query("SELECT tag FROM tags;");
		while($row = $result->fetch_row()){
			echo("<tag>" . $row[0] . "</tag>" );
		}
?>
	</tags>
</kriz>


