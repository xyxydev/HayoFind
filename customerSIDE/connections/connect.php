<?php
function connection() {
    $host = "localhost"; // Your MySQL host name
    $username = "root"; // Your MySQL username
    $password = ""; // Your MySQL password
    $database = "hayofinddb"; // Your MySQL database name

    // Create a connection to the MySQL database
    $con = new mysqli($host, $username, $password, $database);

    // Check the connection and return an error message if it fails
    if ($con->connect_error) {
        echo $con->connect_error;
    }else{
        return $con; // Return the connection object
    }
}
?>