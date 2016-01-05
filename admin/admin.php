<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	//Some admin wants to create a new user

	$username = $_POST["username"];
	$password = $_POST["password"];
	$role = $_POST["role"];

	include "../database/connection.php";
	$query = "INSERT INTO users(username, password, role) VALUES('$username', '$password', '$role');";

	if(!$mysqli->query($query)){
		//SOME ERROR
		echo("Error");
		die();
	} else {
		echo("Successfully inserted!");
		die();
	}

 
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') { 

	header('Content-Type: application/json');


	include "../database/connection.php";
	$result = $mysqli->query("SELECT username, password, role FROM users;");

	$JSON = array();
	while($row = $result->fetch_row()){
		$UserJSON = array("username" => $row[0], "password" => $row[1], "role" => $row[2]);

		$JSON[] = $UserJSON;
	}

	echo(json_encode($JSON));

} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') { 

	header('Content-Type: application/json');

	$username = $_DELETE["username"];

	echo($username);
	die();


	include "../database/connection.php";
	$result = $mysqli->query("SELECT username, password, role FROM users;");



}