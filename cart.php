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

    <link rel="shortcut icon" class="iconTab" href="customerSIDE/cow.ico">
    <link rel="stylesheet" href="customerSIDE/index.css">
    <link rel="stylesheet" href="cart.css">
    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

</head>


<body>
    <?php

    session_start();
   
    include_once("connections/connect.php"); 
    require_once("customerSIDE/component.php");
    $con = connection();

    if(isset($_POST['remove'])){
        if($_GET['action'] == 'remove'){
            foreach($_SESSION['cart'] as $key => $value){
                if($value["product_ID"] == $_GET['id']){
                    unset($_SESSION['cart'][$key]);

                    echo "<script>alert('Product removed!')</script>";
                    echo "<script>window.location = 'cart.php'</script>";
                }
            }
        }
    }
    ?>

   
    <?php
        require_once('indexHeader.php'); 
    
    ?>

   <!-- MY CART -->
   <div class="container-fluid">
    <div class="row">
        <div class="col-md-7">
            <div class="shopping-cart">
                <h6 class="shopcart-title"><i class="fas fa-shopping-cart" id="titleicon-cart"></i> Shopping Cart</h6>
                <hr>
                
                <?php 
                    $total = 0;
                    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
                        $product_ID = array_column($_SESSION['cart'], 'product_ID');

                        //get data from database
                        $sql = "SELECT * FROM products";

                        //execute the SQL query and fetch the data
                        $result = mysqli_query($con, $sql);

                        //check if there are any results
                        if (mysqli_num_rows($result) > 0) {
                            //output data of each row
                            while($row = mysqli_fetch_assoc($result)) {
                                foreach($product_ID as $id){
                                    if($row['item_ID'] == $id){
                                        cartElement($row['item_IMG'], $row['item_Name'], $row['item_Price'], $row['item_ID']);
                                        $total = $total + (int)$row['item_Price'];
                                    }
                                }
                            }
                        } else {
                            echo "0 results";
                        }
                    } else {
                        echo "<h5> Cart is empty!</h5>";
                    }
                ?>
            </div>
        </div>
        
        <div class="col-md-4 border rounded mt-5 bg-white h-25" >
            <div class="pt-4" id="pt-4ID">
                <h6 class="price-detailsH6">PRICE DETAILS</h6>
                <div class="backhome-btn">
                <a class="button-link" href="index.php">Back to Home</a>
</div>
                
                <hr>
                <div class="row price-details">
                    <div class="col-md-6" id="price-div-col">
                        <?php 
                            if(isset($_SESSION['cart'])){
                                $count = count($_SESSION['cart']);
                                echo "<h6>Price ($count items)</h6>";
                            } else {
                                echo "<h6>Price(0 items)</h6>";
                            }
                        ?>
                        <h6>Delivery Fee</h6>
                        <hr>
                        <h6>Amount Payable</h6>
                        
                    </div>
    
                    <div class="col-md-6" id="price-div-col">
                        <h6>
                            <?php 
                                echo "&#8369; $total"; 
                            ?> 
                        </h6>
                        <h6 class="text-success">&#8369; 200</h6>
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
                            <a class="checkout-BTN" href="orders.php">Checkout</a>
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