<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="">
    <title>HayoFind</title>

    <!----FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="shortcut icon" class="iconTab" href="cow.ico">
    <link rel="stylesheet" href="buyer css/index.css">
    <link rel="stylesheet" href="buyer css/cart.css">
    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


    <!--- --->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>


<body>
    <?php
        session_start();
        @$user_id = $_SESSION['user_id'];
        include_once("connections/connect.php"); 
        $con = connection();

        //
        $cartcart = true;
        require_once('indexHeader.php');    
    ?>

   <!-- MY CART -->
   <div class="container-fluid">
   <a class="mb-3 button" href="index.php" id="backtohome">Back to Home</a>
    <div class="row">
        <div class="col-md-7">
            <div class="shopping-cart">
                <h6 class="shopcart-title"><i class="fas fa-shopping-cart" id="titleicon-cart"></i> Shopping Cart</h6>
                <hr>
                
                <?php 
                    $total = 0;
                    @$userID = $_SESSION['user_id'];

                    // Fetch products from the cart table for the current user
                    $sql = "SELECT products.item_IMG, products.item_Name, products.item_Price, products.merchantsID_fk, cart.product_ID, cart.quantity
                    FROM products
                    INNER JOIN cart ON products.item_ID = cart.product_ID
                    WHERE cart.buyer_ID = '$userID'";


                    // Execute the SQL query and fetch the data
                    $result = mysqli_query($con, $sql);

                    // Check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        // Output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            $seller_ID = $row['merchantsID_fk'];
                            $productID = $row['product_ID'];
                            $productImage = $row['item_IMG'];
                            $productname = $row['item_Name'];
                            $productprice = $row['item_Price'];
                            $quantity = $row['quantity'];
                            $total = $total + (int)$row['item_Price'] *$quantity;

                            $cartquantity = $productprice *  $quantity;

                            $query2 = "SELECT * FROM merchants WHERE id = $seller_ID";
                            $result2 = $con->query($query2);
                            $row2 = $result2->fetch_assoc();
                            $fname = $row2['fname'];
                            $lname = $row2['lname'];

                            //THE COMPONENT CARTELEMENT
                            // Display the data in a new cart-items container
                            echo '<div class="cart-items">';
                                echo '<div class="cart-card">';
                                    echo '<div class="col-md-3 pl-0">';
                                    echo '<img src="'.$productImage.'" alt="Image1" class="img-fluid" style="height: 140px; width: 75%;">';
                                    echo '</div>';

                                    echo '<div class="infoCartDiv">';
                                        echo '<h6 class="pt-2">Seller: '.$fname.' '.$lname.'</h6>';
                                        echo '<h5 class="pt-2">'.$productname.'</h5>';
                                        echo '<h5 class="pt-2">&#8369; '.$cartquantity.'</h5>';

                                        echo '<form method="post" action="function/removeItemCart.php">';
                                            echo '<input type="hidden" name="product_id" value="'.$productID.'">';
                                            echo '<button type="submit" class="btn btn-danger mx-2"  id="remove-btn" name="remove">Remove</button>';
                                        echo '</form>';
                                    echo '</div>';


                                    echo '<form method="post" action="function/update_quantityCart.php">';
                                    echo '<div class="quantity-cont">';
                                        echo '<h5 class="quantity">Quantity</h5>';
                                        echo '<div class="quantity-item">';
                                        echo '<input type="number" name="qty" value="'.$quantity.'" class="form-control" id="input-qty" min="1">';
                                        echo '<input type="hidden" name="productID" value="'.$productID.'">';
                                        echo '<button type="submit" class="btn btn-secondary" id="editButton" name="update">Change</button>';
                                    echo '</div>';
                                    echo '</form>';

                                    echo '</div>';
                                echo '<hr>';
                                echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<h5 class="cart-empty"> Cart is empty!</h5>';
                    }
                ?>
                
            </div>
        </div>

        <!------ CARD OF PRICE DETAILS IN THE LEFT-->
        <div class="col-md-4 border rounded mt-5 bg-white h-25">
            <div class="pt-4" id="pt-4ID">
                <h6 class="mb-3 price-detailsH6">PRICE DETAILS</h6>
                
                <hr>
                <div class="row price-details">
                    <div class="col-md-6" id="price-div-col">
                        <?php 
                            if (isset($_SESSION['user_id'])) {
                                $userID = $_SESSION['user_id'];
                                $sql = "SELECT COUNT(*) AS count FROM cart WHERE buyer_ID = '$userID'";
                                $result = mysqli_query($con, $sql);
                                $count = mysqli_fetch_assoc($result)['count'];
                                echo "<h6>Price ($count items)</h6>";
                            } else {
                                echo "<h6>Price(0 items)</h6>";
                            }
                        ?>
                        <h6>Standard delivery fee</h6>
                        <hr>
                        <h6>Amount Payable</h6>
                        
                    </div>
    
                    <div class="col-md-6" id="price-div-col">
                        <h6>
                            <?php 
                                echo "&#8369; $total";
                            ?>
                        </h6>
                            <h6 class="text-success">₱ 200</h6>
                            <hr>
                            <h6>
                                <?php 
                                    $fee = "200.00";
                                    $numericFee = floatval($fee);
                                    $feeTotal = $total + $numericFee;
                                    echo "&#8369; $feeTotal";
                                ?>
                            </h6>
                    </div>
                </div>
                <div class="checkout-BTN-div">
                    <a class="checkout-BTN" href="placeOrderPage.php">Checkout</a>
                </div>
            </div>
        </div>
    </div>
   </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>