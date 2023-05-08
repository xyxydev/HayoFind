<?php
// Connect to the database
include_once("connections/connect.php");

$con = connection();

// Get the product ID from the AJAX request
$id = $_POST['id'];

// Prepare and execute the SQL statement to delete the product
$stmt = $con->prepare("DELETE FROM products WHERE item_ID = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

// Close the database connection
$con->close();

// Return a success message
echo "Product deleted successfully";
?>