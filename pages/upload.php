<?php
	include "../misc/isLoggedIn.php";
	if(!isLoggedIn()){
		header("Location: ./login.php");
		die();
	}


	header("Content-type: text/xml; charset=utf-8"); ?>
<?xml version="1.0" encoding="utf-8"?>

<?php
/* Detect if mobile and use mobile stylesheet or desktop stylesheet */
include("../misc/Mobile_Detect.php");
$detect = new Mobile_Detect();

if($detect->isMobile()){
	print '<?xml-stylesheet type="text/xsl" href="../xsl/mobile/upload.xsl"?>';
} else {
	print '<?xml-stylesheet type="text/xsl" href="../xsl/upload.xsl"?>';
}
?>


<!DOCTYPE kriz SYSTEM "../dtd/tags.dtd">
<kriz>
	<?php 
	include("../misc/userinfo.php");
	userinfo();
	?>

	<tags>

<?php
		include "../database/connection.php";

		$result = $mysqli->query("SELECT tag FROM tags;");
		while($row = $result->fetch_row()){
			echo("<tag>" . $row[0] . "</tag>" );
		}
?>
	</tags>
</kriz>
