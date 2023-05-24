<?php
    // Establish database connection
    include_once("../connections/connect.php");
    $con = connection();

    // Check if the form has been submitted
    //-------------------------------------------------
    if(isset($_POST['placeOrder'])) {
        // Get the buyer ID from the hidden input field in the form
        $buyer_id = $_POST['buyer_id'];
        $seller_id = $_POST['seller_id'];
        $address = $_POST['address'];
        $paymentMethod = $_POST['method'];
        $phoneNumber = $_POST['phoneNumber'];
        $amount = $_POST['total_payment'];
        $dateAdd = date('Y-m-d'); // Get the current date
        $order_status = 'Pending'; // Change to the desired initial status of the order
        
        //insert data to table
        $passSql = "SELECT * FROM buyers WHERE id='$buyer_id'"; 
        $passResult = mysqli_query($con, $passSql);
        $passRow=mysqli_fetch_assoc($passResult);

            $sql = "INSERT INTO `order_details` (`seller_ID`, `buyer_ID`, `amount`, `payment_method`, `order_date`, `order_status`) 
            VALUES ('$seller_id', '$buyer_id', '$amount', '$paymentMethod', '$dateAdd', '0')";
            $result = mysqli_query($con, $sql);
            $order_ID = $con->insert_id;
            if ($result){
                $addSql = "SELECT * FROM `cart` WHERE buyer_ID ='$buyer_id'"; 
                $addResult = mysqli_query($con, $addSql);
                while($addrow = mysqli_fetch_assoc($addResult)){
                    $seller_ID = $addrow['seller_ID'];
                    $product_ID = $addrow['product_ID'];
                    $itemQuantity = $addrow['quantity'];
                    $itemSql = "INSERT INTO `orders` (`order_ID`, `seller_ID`, `product_ID`, `product_quantity`) VALUES ('$order_ID', '$seller_ID', '$product_ID', '$itemQuantity')";
                    $itemResult = mysqli_query($con, $itemSql);
                }
                // Clear the cart table for the current buyer
                $deletesql = "DELETE FROM cart WHERE buyer_id = $buyer_id";   
                $deleteresult = mysqli_query($con, $deletesql);

                // Redirect to the order confirmation page
                header("Location: ../viewOrders.php");
                exit();
            }    
    }

    // Close database connection
    $con->close();
?>
