<?php
// Connect to the database
include_once("connections/connect.php");

$con = connection();

// Get the product ID from the AJAX request
$id = $_POST['id'];

// Prepare and execute the SQL statements to delete the product from both tables
$stmt1 = $con->prepare("DELETE FROM products WHERE item_ID = ?");
$stmt1->bind_param("i", $id);
$stmt1->execute();

$stmt2 = $con->prepare("DELETE FROM product_kind WHERE id = ?");
$stmt2->bind_param("i", $id);
$stmt2->execute();

$stmt1->close();
$stmt2->close();

// Close the database connection
$con->close();

// Return a success message
echo "Product deleted successfully";
?>
