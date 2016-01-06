<?php
if( isset($_COOKIE["username"]) AND isset($_COOKIE["role"]) ){
	if( $_COOKIE["role"] != "admin"){
		header('HTTP/1.1 401 Unauthorized', true, 401);
		die("You have no business here");
	}
} else {
		header('HTTP/1.1 401 Unauthorized', true, 401);	
		die("You have no business here");
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') { 

	header('Content-Type: application/json');
	
	include "../database/connection.php";
	$result = $mysqli->query("SELECT username, password, role FROM users;");

	$JSON = array();
	while($row = $result->fetch_row()){
		$UserJSON = array("username" => $row[0], "password" => $row[1], "role" => $row[2]);

		$JSON[] = $UserJSON;
	}

	echo(json_encode($JSON));
	die();

} else if ($_SERVER['REQUEST_METHOD'] === 'POST' AND $_POST["type"] === "POST") { //POST
	//Some admin wants to create a new user

	$username = $_POST["username"];
	$password = $_POST["password"];
	$role = $_POST["role"];

	include "../database/connection.php";
	$query = "INSERT INTO users(username, password, role) VALUES('$username', '$password', '$role');";

	if(!$mysqli->query($query)){
		//SOME ERROR
		header('HTTP/1.1 500 Internal Server Error', true, 500);
		die();
	} else {
		echo("Successfully inserted!");
		die();
	}

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST["type"] === "PUT") { //PUT


	$username = $_POST["username"];
	$password = $_POST["password"];
	$role = $_POST["role"];

	include "../database/connection.php";
	if(!$mysqli->query("UPDATE users SET password = '$password', role = '$role' WHERE username = '$username';")){
		header('HTTP/1.1 500 Internal Server Error', true, 500);
		die();
	} else {
		echo("Successfully updated on server");
		die();
	}


} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST["type"] === "DELETE") { //DELETE

	$username = $_POST["username"];

	include "../database/connection.php";
	if(!$mysqli->query("DELETE FROM users WHERE username = '$username';")){
		header('HTTP/1.1 500 Internal Server Error', true, 500);
		die();
	} else {
		echo("Successfully deleted on server");
		die();
	}
}



