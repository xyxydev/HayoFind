<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/placeOrderPage.css">
    <link rel="shortcut icon" class="iconTab" href="images/cow.ico">
    <!----FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">

    <script src="script.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.1/css/bootstrap.min.css">
     <!-- Bootstrap CDN -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- JavaScript (optional) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <?php
        session_start();
        @$user_id = $_SESSION['user_id'];
        include_once("connections/connect.php"); 
        $con = connection();
       
        require_once('indexHeader.php'); 
    ?>

    <div class="container">
    <div class="inside-container">
        <a href="cart.php" class="btn btn-primary">Back to Cart</a>
        <h6 class="checkout">Checkout</h6>

        <div class="delivery-info">
        <div class="delivery-address">
            <h6 class="address">Address</h6>
            <form method="POST" action="">
            <div class="input-group mb-3">
                <input type="text" name="address" placeholder="Update Address" class="form-control">
                <button type="submit" class="btn btn-outline-secondary">Update Address</button>
            </div>
            </form>
        </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Seller</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Item Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Assuming you have established a database connection

                    // Query to fetch data from the cart table
                    $query = "SELECT * FROM cart";
                    $result = mysqli_query($con, $query);

                    // Check if there are any rows returned
                    if (mysqli_num_rows($result) > 0) {
                        $total_price = 0; // Initialize total price to 0
                        // Loop through each row and display the data
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Extract the relevant data from the row
                            $seller_Name = $row['seller_Name'];
                            $item_img = $row['item_img'];
                            $item_Name = $row['item_name'];
                            $item_price = $row['item_price'];
                            $quantity = $row['quantity'];

                            // Output the data in a table row
                            echo "<tr>";
                            echo "<td>$seller_Name</td>";
                            echo "<td>$item_Name</td>";
                            echo "<td>$quantity</td>";
                            echo "<td>$item_price</td>";
                            echo "</tr>";

                            // Add the price of the item to the total price
                            $total_price += $item_price;//* $quantity
                        }
                        // Display the total price below the table
                        echo "<tr><td colspan='3'></td><td>Total: $total_price</td></tr>";
                    } else {
                        // No data found in the cart table
                        echo "<tr><td colspan='4'>No items in the cart.</td></tr>";
                    }

                    // Close the database connection
                    ?>
                </tbody>
            </table>
        </div>


        <?php 
           
        ?>
        <div class="payment">
            <h5 class="payment-method">Payment method </h5>
            <p>Cash on delivery</p>
        </div>
        <div class="overall">
            <p class="items">Items Subtotal: <?php echo $total_price; ?> </p>
            <p class="shipping">Delivery Fee Total: 200</p>
            <p class="total-payment">Total Payment:  <?php echo $total_price; ?> </p>

        </div>
    </div>
    </div>



    
</body>
</html>
