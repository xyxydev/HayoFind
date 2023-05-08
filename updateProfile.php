<?php
    // Retrieve the values from the FormData object
    $merchantType = $_POST['merchantType'];
    $merchantID = $_POST['merchantID'];
    $username = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['pNumber'];
    
    $dob = $_POST['dob'];
    $address = $_POST['address'];

    

    include_once("connections/connect.php");

    $con = connection();
    session_start();
    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE merchants SET merchantType='$merchantType', username='$username', fname='$fname', lname='$lname', email='$email', 
    phoneNumber='$phoneNumber',  dob='$dob', address='$address' WHERE id='$user_id'";

    if (mysqli_query($con, $sql)) {
    echo 'Profile updated successfully';
    } else {
    echo 'Error updating profile: ' . mysqli_error($con);
    }

    mysqli_close($con);
?>