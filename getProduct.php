<?php

    // Connect to the database
    include_once("connections/connect.php");

    $con = connection();

    // Retrieve the product ID from the request
    if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    } else {
    // If no ID is provided, return an error message
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => 'Product ID is required']);
    exit();
    }

    // Query the database for the product data
    $stmt = $db->prepare('SELECT * FROM products WHERE item_ID = :id');
    $stmt->bindParam(':id', $product_id);
    $stmt->execute();

    // Retrieve the product data as an associative array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // If no product is found, return an error message
    if (!$product) {
    header('HTTP/1.1 404 Not Found');
    echo json_encode(['error' => 'Product not found']);
    exit();
    }

    // Output the product data as JSON
    header('Content-Type: application/json');
    echo json_encode($product);
?>