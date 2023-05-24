<?php
    // Retrieve the values from the FormData object
    session_start();
    @$userID = $_SESSION['user_id'];
    include_once("../connections/connect.php"); 
    $con = connection();

    // Check if the remove button is clicked
    if (isset($_POST['update'])) {
        // Get the product ID from the form
        $quantity = $_POST['qty'];
        $productID = $_POST['productID'];

        $sql = "UPDATE cart SET quantity ='$quantity' WHERE product_ID ='$productID'";
        mysqli_query($con, $sql);

        // Refresh the page to update the cart
        header('Location: ../cart.php');
        exit();
    }

?>