<?php
session_start();
@$user_id = $_SESSION['user_id'];
include_once("../connections/connect.php");
require_once('../component.php'); 
$con = connection();
// search.php

// Retrieve the search query from the form input
$searchQuery = $_GET['search'];

// Perform the database query to fetch the relevant results based on the search query
$sql = "SELECT * FROM products WHERE item_Kind LIKE '%$searchQuery%'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Display the search results using the component function or custom HTML
        // Modify this part according to your requirements
        component($row['item_Name'], $row['item_Price'], $row['item_IMG'], $row['item_Kind'], $row['item_Weight'], $row['item_ID']);
    }
} else {
    echo "No results found";
}
?>