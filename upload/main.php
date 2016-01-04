if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	include "./post.php";
	die();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET'){
	include "./get.php";
	die();
} 