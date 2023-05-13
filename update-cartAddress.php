<?php

    // Step 4: Handle form submission and update address in the database
    if ($_SERVER['REQUEST_METHOD'] === 'update') {
        $newAddress = $_POST['address'];
        $updateQuery = "UPDATE buyers SET address = '$newAddress' WHERE id = $userID";
        mysqli_query($con, $updateQuery);

    }
?>