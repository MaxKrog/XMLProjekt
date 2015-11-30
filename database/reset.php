
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

// Execute the query
$mysqli->multi_query($query);

$result = $mysqli->fetch_all();
print($result);

$mysqli->close(); //Close DB-Connection
?>