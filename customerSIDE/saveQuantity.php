<?php
// Step 2: Establish a database connection
include_once("connections/connect.php");
$con = connection();

// Step 3: Retrieve the quantity value from the form
$quantity = $_POST['quantity-input'];

// Step 4: Check which button was clicked
if (isset($_POST['submit']) && $_POST['submit'] === 'Apply') {
    // Step 5: Insert the quantity value into the database
    $sql = "INSERT INTO cart (quantity) VALUES ('$quantity')";
    if (mysqli_query($con, $sql)) {
        echo "Quantity saved successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
} elseif (isset($_POST['submit']) && $_POST['submit'] === 'Change') {
    // Step 6: Update the quantity value in the database
    $sql = "UPDATE cart SET quantity = '$quantity'";
    if (mysqli_query($con, $sql)) {
        echo "Quantity updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}

// Step 7: Close the database connection
mysqli_close($con);
?>
