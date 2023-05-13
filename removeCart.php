<?php
session_start();
    
include_once("connections/connect.php"); 
$con = connection();
$userID = $_SESSION['user_id'];

if (isset($_POST['remove'])) {
    if ($_GET['action'] == 'remove') {
        $productID = $_GET['id'];
        $userID = $_SESSION['user_id'];

        // Delete the product from the cart table
        $sql = "DELETE FROM cart WHERE buyer_ID = '$userID' AND product_ID = '$productID'";
        mysqli_query($con, $sql);

        //echo "<script>alert('Product removed!')</script>";
        //echo "<script>window.location = 'cart.php'</script>";
    }
}
?>