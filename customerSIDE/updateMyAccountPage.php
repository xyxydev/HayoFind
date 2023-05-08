<?php
    // Retrieve the values from the FormData object
    
   
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $gender = $_POST['gender'];
    $username = $_POST['username'];
    $id = $_POST['id'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $documents = $_POST['documents'];
    $image = $_POST['image'];
    $merchantType = $_POST['merchantType'];
    

    include_once("connections/connect.php");

    $con = connection();
    session_start();
    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE merchants SET fname='$fname', lname='$lname', email='$email', phoneNumber='$phoneNumber',  gender='$gender', dob='$dob', 
    address='$address',  merchantType='$merchantType',  username='$username', password='$password', documents='$documents', img='$image' WHERE id='$user_id'";

    if (mysqli_query($con, $sql)) {
    echo 'Profile updated successfully';
    } else {
    echo 'Error updating profile: ' . mysqli_error($con);
    }

    mysqli_close($con);
?>