
<?php
// Connect using host, username, password and databasename
$link = mysqli_connect('localhost', 'rsslab', 'rsslab', 'rsslab');

// Check connection
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

// The SQL query
$query = '
	DROP TABLE IF EXISTS "users" CASCADE;
	CREATE TABLE "users" (
		"username" text,
		"password" text,
		"role" text,
		Constraint "users_pkey" Primary Key ("username")
	);';

// Execute the query
if (($result = mysqli_query($link, $query)) === false) {
   printf("Query failed: %s<br />\n%s", $query, mysqli_error($link));
   exit();
}

// Loop over the resulting lines
while ($line = $result->fetch_object()) {
	print($line);

}
//Free the result from the database
mysqli_free_result($result);

?>