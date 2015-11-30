
<?php
// Connect using host, username, password and databasename
$mysqli = new mysqli('localhost', 'mkrog', 'mkrog-xmlpub13', 'mkrog');

// Check connection
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

// The SQL query
$query = file_get_contents("reset.sql");
print($query);

// Execute the query
if( $mysqli->multi_query($query)) {
	print("Successfully reseted database!");
} else {
	print("There was an error when reseting the database!");
}

$mysqli->close(); //Close DB-Connection
?>