<?php

require_once './twitter.class.php';
$consumerKey = "36SAF1xFsyzakSGazWwQgkabM";
$consumerSecret = "SMA45qfZM8JyOfcXxMTVJvs9BTFb3fNaGOweXOriD0iDJsrqgV";
$accessToken = "4774088265-mSNkU78lrEfXTQcvDtyhwunpM6X4cnIZcSvs5sf";
$accessTokenSecret = "0cQtqqJmuPix8onmMSDmkNz24Re8oGyUO4xODFQo1Vbud";

// ENTER HERE YOUR CREDENTIALS (see readme.txt)
$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

try {
	$tweet = $twitter->send('I am fine'); // you can add $imagePath as second argument

} catch (TwitterException $e) {
	echo 'Error: ' . $e->getMessage();
}
