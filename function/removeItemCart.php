<?php
session_start();
@$userID = $_SESSION['user_id'];
include_once("../connections/connect.php"); 
$con = connection();
// Check if the remove button is clicked
if (isset($_POST['remove'])) {
    // Get the product ID from the form
    $productID = $_POST['product_id'];

    // Remove the product from the cart table
    $sql = "DELETE FROM cart WHERE buyer_ID = '$userID' AND product_ID = '$productID'";
    mysqli_query($con, $sql);

    // Refresh the page to update the cart
    header('Location: ../cart.php');
    exit();
}
?>