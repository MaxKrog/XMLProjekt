<?php

//WHEN LOGGED IN username-cookie is set to the username. Not very secure.
include "./isLoggedIn.php";

if( isLoggedIn() ) { // User allready is logged in
	header("Location: ../index.php");
	die();
}
$failedLogin = False;

if(isset($_POST["username"]) && isset($_POST["password"]) ){
	$username = $_POST["username"];
	$password = $_POST["password"];
	include "../database/connection.php";
	$result = $mysqli->query("SELECT username, password FROM users WHERE username = '$username';");
	$row = $result->fetch_row();
	
	if($password == $row[1]){
		//SÄTT COOKIE
		setcookie("username", $username, 0, "/");
		header("Location: ../index.php");
		die();
	} else {
		$failedLogin = True;
	} 
	
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Krizfeed </title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	</head>
	<body>

		<section class="container-fluid">
			<?php if($failedLogin) { echo('<div class="alert alert-danger" role="alert"> Invalid username/password, try again! </div>'); } ?>
			<form method="POST">
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" id="username" name="username">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password">
				</div>

				<button class="btn btn-warning"> <a href="../index.php">Back</a></button>
				<button type="submit" class="btn btn-success">Login</button>
			</form>
	
		</section>



		<script src="../js/jquery.min.js" type="text/javascript"></script>

	</body>
</html>
