<?php

include "../misc/isLoggedIn.php";

if( isLoggedIn() ) { // User allready is logged in
	header("Location: ./index.php");
	die();
}
$failedLogin = False;

if( isset($_POST["username"]) && isset($_POST["password"]) ){
	include "../database/connection.php";
	$username = $_POST["username"];
	$password = $_POST["password"];	
	$result = $mysqli->query("SELECT username, password, role FROM users WHERE BINARY username = '$username';"); //"BINARY" makes case-sensitive.
	$row = $result->fetch_row();
	
	if($password == $row[1]){
		//SÄTT COOKIE
		setcookie("username", $username, 0, "/");
		setcookie("role", $row[2], 0, "/");
		header("Location: ./index.php");
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
		<meta name="viewport" content="width=device-width initial-scale=1" />
		<link rel="stylesheet" type="text/css" href="../vendor/bootstrap.min.css">
	</head>
	<body>

		<section class="container-fluid">
			
			<form method="POST" class="form-horizontal jumbotron" style="margin-top:15px">
				<?php if($failedLogin) { echo('<div class="alert alert-danger" role="alert"> Invalid username/password, try again! </div>'); } ?>
				<h3 class="text-center">Login to Krizfeed!</h3>
				<br/><br/>
				<div class="form-group">
					<label for="username" class="col-sm-2 control-label">Username</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="username" name="username" autofocus>
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="password" name="password">
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button class="btn btn-default"> <a href="./index.php">Back</a></button>
						<button type="submit" class="btn btn-success">Login</button>
					</div>
				</div>
			</form>
	
		</section>



		<script src="../vendor/jquery.min.js" type="text/javascript"></script>

	</body>
</html>
