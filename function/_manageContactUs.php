<?php
session_start();

 include_once("connections/connect.php"); 
 $con = connection();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $orderId = $_POST["orderId"];
    $message = $_POST["message"];


    // Check user password is match or not
    $passSql = "SELECT * FROM buyers WHERE id='$user_id'"; 
    $passResult = mysqli_query($con, $passSql);
    $passRow=mysqli_fetch_assoc($passResult);
    
        $sql = "INSERT INTO `contact` (`user_ID`, `email`, `phoneNumber`, `order_ID`, `message`, `time`) VALUES ('$user_id', '$email', '$phone', '$orderId', '$message', current_timestamp())";
        $result = mysqli_query($con, $sql);
        $contactId = $con->insert_id;
       
    
}
?>