<?php
    // Retrieve the values from the FormData object
    
    $address = $_POST['address'];

    include_once("../connections/connect.php");

    $con = connection();
    session_start();
    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE buyers SET address='$address' WHERE id='$user_id'";

    if (mysqli_query($con, $sql)) {
    echo 'Profile updated successfully';
    } else {
    echo 'Error updating profile: ' . mysqli_error($con);
    }

    mysqli_close($con);
?>
