<?php
    // Retrieve the values from the FormData object
    
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $username = $_POST['username'];
   

    

    include_once("../connections/connect.php");

    $con = connection();
    session_start();
    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE buyers SET fname='$fname', lname='$lname', email='$email', phoneNumber='$phoneNumber',  gender='$gender', dob='$dob', 
    address='$address',  username='$username' WHERE id='$user_id'";

    if (mysqli_query($con, $sql)) {
    echo 'Profile updated successfully';
    } else {
    echo 'Error updating profile: ' . mysqli_error($con);
    }

    mysqli_close($con);
?>
