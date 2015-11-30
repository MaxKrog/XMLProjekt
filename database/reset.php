<?php

include "./connection.php";

// The SQL query
$queries = file_get_contents("reset.sql");

$mysqli->multi_query($queries);

//Impossible to get good error-feedback from multi_query.
//Make sure SQL-file is working or it's not gun be good.

print("Something happened! Go check with PHPMYADMIN to be sure.");

$mysqli->close(); 
?>