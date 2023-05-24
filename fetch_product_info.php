<?php
// fetch_product_info.php

        include_once("connections/connect.php");
        require_once('component.php'); 
        $con = connection();



// Retrieve the product ID from the AJAX request
$productID = $_POST['productID'];

// Query the database to fetch the product information
$sql = "SELECT * FROM products WHERE item_ID = '$productID'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // Output the product information
    $row = $result->fetch_assoc();
    echo "<p>Name: " . $row['item_Name'] . "</p>";
    echo "<p>Price: " . $row['item_Price'] . "</p>";
    echo "<p>Kind: " . $row['item_Kind'] . "</p>";
} else {
    echo "No product found.";
}

$conn->close();
?>
