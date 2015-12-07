<?php

//WHEN LOGGED IN username-cookie is set to the username. Not very secure.

if( $_GET["username"] && $_GET["password"] ){
	$username = $_GET["username"];
	$password = $_GET["password"];
	
	include "../database/connection.php";

	$result = $mysqli->query("SELECT username, password FROM users WHERE username = '$username';");
	$row = $result->fetch_row();
	if($password == $row[1]){
		//SÄTT COOKIE
		setcookie("username", $username, 0, "/");
		echo("success");
	} else {
		echo("Bad credentials!");
	}

	
} else {
	echo("No username or password provided");
}

?>
