
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


// Execute multi query
if ($mysqli->multi_query($query)) {
    do {
        // store first result set
        if ($result = $mysqli->store_result()) {
            while ($row = $result->fetch_row()) {
                printf("%s\n", $row[0]);
            }
            $result->free();
        }
        // print divider
        if ($mysqli->more_results()) {
            printf("-----------------\n");
        }
    } while ($mysqli->next_result());
}

$mysqli->close(); //Close DB-Connection
?>