<?php header("Content-type: text/xml; charset=utf-8"); ?>
<?xml version="1.0" encoding="utf-8"?>

<?php
/* Detect if mobile and use mobile stylesheet or desktop stylesheet */
include("../misc/Mobile_Detect.php");
$detect = new Mobile_Detect();

if($detect->isMobile()){
	print '<?xml-stylesheet type="text/xsl" href="../xsl/mobile/map.xsl"?>';
} else {
	print '<?xml-stylesheet type="text/xsl" href="../xsl/map.xsl"?>';
}
?>

<!DOCTYPE map SYSTEM "http://xml.csc.kth.se/~mkrog/DM2517/projekt/dtd/map.dtd">
<kriz>
	<?php 
	include("../misc/userinfo.php");
	userinfo();
	?>

</kriz>