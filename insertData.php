<?php 
    
include_once("connections/connect.php");

$con = connection();
//Merchant Registration Form
if(isset($_POST['submit'])) {
    // Get the input values from the form
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $phoneNumber = $_POST['pNumber'];
    $merchantType = $_POST['choice'];
    $password = $_POST['password'];
    
    
    
    // Construct the SQL INSERT statement
    $sql = "INSERT INTO merchants (fname, lname, phoneNumber, merchantType, password) 
            VALUES ('$firstName', '$lastName', '$phoneNumber', '$merchantType', '$password')";
    
    // Execute the INSERT statement
    if (mysqli_query($con, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
    
    // Close the database connection
    mysqli_close($con);
}

//Customer Registration Form
if(isset($_POST['submit'])) {
    // Get the input values from the form
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $phoneNumber = $_POST['pNumber'];
    $password = $_POST['password'];
    
    
    
    // Construct the SQL INSERT statement
    $sql = "INSERT INTO merchants (fname, lname, phoneNumber, password) 
            VALUES ('$firstName', '$lastName', '$phoneNumber', '$password')";
    
    // Execute the INSERT statement
    if (mysqli_query($con, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
    
    // Close the database connection
    mysqli_close($con);
}
?>