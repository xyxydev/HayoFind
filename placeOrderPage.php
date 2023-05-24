<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="buyer css/placeOrderPage.css">
    <link rel="shortcut icon" class="iconTab" href="cow.ico">
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

    <?php
        //GET DATA FROM THE BUYERS TABLE
        $sql = "SELECT * FROM buyers WHERE id = $user_id"; // Change "1" to the ID of the user you want to retrieve data for
        $result = $con->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $fname = $row["fname"];
            $lname = $row["lname"];
            $phoneNumber = $row["phoneNumber"];
            $address = $row["address"];
            $id = $row["id"];
        }
    ?>
    <div class="container">
    <a href="cart.php" class="btn btn-primary back-BTN" id="backtocart">Back to Cart</a>
    <div class="inside-container">
        <h6 class="checkout">Checkout</h6>
        <hr>

        <div class="delivery-address">
            <h6 class="address"><i class="fas fa-map-marker-alt" style="color:#91C788;"></i> Delivery Address</h6>

                    <input type="hidden" name="buyer_id" value="<?php echo $id; ?>" class=" input-address" >
                    <input type="text" name="name" value="<?php echo $fname." ".$lname; ?>" class="input-address" id="left-input" disabled>
                    <input type="text" name="phone" value="<?php echo $phoneNumber; ?>" class="input-address" disabled>
                    <input type="text" name="address" value="<?php echo $address; ?>" class="input-address" id="addressChange" readonly>

                    <button type="submit" class="btn btn-primary" id="saveButton" name="saveData">Save</button> 
                    <button type="submit" class="btn btn-secondary" id="editButton" name="edit">Change</button>
    
        </div>
    </div>
    <div class="container-2">
        <h5 class="order">Products ordered </h5>
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
                    $total_price = 0;
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
                            $product_ID = $row['product_ID'];
                            $seller_ID = $row['seller_ID'];
                            $quantity = $row['quantity'];

                            //Fetch the data from the products table referring to cart
                            $query2 = "SELECT * FROM products WHERE item_ID = $product_ID";
                            $result2 = $con->query($query2);
                            $row2 = $result2->fetch_assoc();
                            //
                            $item_img = $row2['item_IMG'];
                            $item_Name = $row2['item_Name'];
                            $item_price = $row2['item_Price'];

                            //Fetch the data from the merchants to get seller name
                            $query3 = "SELECT * FROM merchants WHERE id = $seller_ID";
                            $result3 = $con->query($query3);
                            $row3 = $result3->fetch_assoc();
                            //
                            $seller_Name = $row3['fname'].' '.$row3['lname'];
                
                            // Output the data in a table row
                            echo "<tr>";
                            echo "<td>$seller_Name</td>";
                            echo "<td>$item_Name</td>";
                            echo "<td>$quantity</td>";
                            echo "<td>&#8369; $item_price</td>";
                            echo "</tr>";

                            // Add the price of the item to the total price
                            $total_price += $item_price * $quantity;
                        }
                        // Display the total price below the table
                        echo "<tr><td colspan='3'></td><td>Total: &#8369; $total_price</td></tr>";
                    } else {
                        // No data found in the cart table
                        echo "<tr><td colspan='4'>No items in the cart.</td></tr>";
                    }

                    // Close the database connection
                    ?>
                </tbody>
            </table>
        </div>


    </div>
    <div class="container-3">
        <div class="payment-cont" style="text-align: right; margin-right: 50px;">
            <div class="payment">
                <h5 class="payment-method">Payment method </h5>
                <p class="cod">Cash on delivery</p>
                <p class="change">CHANGE</p>
            </div>
            <hr>
            <?php 
                $totalPayment = 0;
                define('DELIVERY_FEE', 200.00);
                $numericFee = DELIVERY_FEE;
                $totalPayment = $total_price + $numericFee;
            ?>
            <div class="overall">
                <p class="items"> <span class="items">Items Subtotal:</span> &#8369; <?php echo $total_price; ?> </p>
                <p class="shipping"> <span class="del" >Delivery Fee Total:</span> &#8369; <?php echo DELIVERY_FEE; ?> </p>
                <p class="total"> <span class="total" >Total Payment:</span> &#8369; <?php echo $totalPayment; ?></p>
            </div>
            <hr>
            <?php 
                 define('Payment_Method', "Cash on delivery");
                 $paymentMethod = Payment_Method;
            ?>
            <form method="post" action="function/placeOrder.php">
           
                <input type="hidden" name="buyer_id" value="<?php echo $id; ?>">
                <input type="hidden" name="seller_id" value="<?php echo $seller_ID; ?>">
                <input type="hidden" name="address" value="<?php echo $address; ?>">
                <input type="hidden" name="method" value="<?php echo $paymentMethod; ?>">
                <input type="hidden" name="phoneNumber" value="<?php echo $phoneNumber; ?>">
                <input type="hidden" name="total_payment" value="<?php echo $totalPayment; ?>">
                <button type="submit" class="btn btn-primary place-order" name="placeOrder" id="placeOrder">Place Order</button>
            </form>

                
        </div>
    </div>
    </div>



    <!--- THIS IS FOR EDITING THE ADDRESS IN PLACE ORDER PAGE--->
    <script>
        // Get the input fields
        const inputFields = document.querySelectorAll('input[type="text"]');

        // Get the edit button
        const editButton = document.querySelector('#editButton');

        // Get the save button
        const saveButton = document.querySelector('#saveButton');

        // Add event listener to the edit button
        editButton.addEventListener('click', (event) => {
        event.preventDefault();
        // Loop through the input fields and remove the "readonly" attribute
        inputFields.forEach(input => {
            input.removeAttribute('readonly');
        });
        });

        saveButton.addEventListener('click', (event) => {
        event.preventDefault();

        // Disable the input fields by adding the "readonly" attribute
        inputFields.forEach(input => {
            input.setAttribute('readonly', 'readonly');
        });

        // Loop through the input fields and save the new values to a FormData object
        const formData = new FormData();
        inputFields.forEach(input => {
            formData.append(input.name, input.value);
        });

        // Use AJAX to send the FormData object to the PHP script that will update the database
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'function/checkoutAddress.php');  //CHANGE THIS FOR EDIT FILE
        xhr.send(formData);
        });
    </script>



    
</body>
</html>
