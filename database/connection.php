<?php
// Exports $mysqli as a fully setup database-connection

// Connect using host, username, password and databasename
$mysqli = new mysqli('localhost', 'mkrog', 'mkrog-xmlpub13', 'mkrog');
$mysqli->set_charset("utf8");

// Check connection
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


?>
