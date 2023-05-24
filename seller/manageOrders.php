<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="seller css/manageOrders.css">
    <link rel="shortcut icon" class="iconTab" href="seller images/cow.ico">
    <!----FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="test.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <title>Manage Orders</title>
</head>
<?php 
        include_once("connections/connect.php");
        $con = connection();
        session_start();
        $user_id = $_SESSION['user_id'];
    ?>
<body>
    
    <?php
        $myorders = true;
        require_once('sellerHeader.php'); 
    
    ?>
<div class="manageOrder-cont">
<div class="container" style="margin-top:98px;">
    <div class="table-title">
        <h2><i class="fas fa-list-ol order-icon"></i>  Order Details</h2>
    </div>
    <div class="table-wrapper">
        <table class="table table-striped table-hover text-center" id="NoOrder">
            <thead style="background-color: #5cb85c !important; color: white;">
                <tr>
                    <th>Order ID</th>
                    <th>Buyer</th>
                    <th>Address</th>
                    <th>Phone No.</th>
                    <th>Amount</th>						
                    <th>Payment</th>
                    <th>Date</th>
                    <th>Status</th>						
                    <th>Items</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $sql = "SELECT * FROM `order_details` WHERE seller_ID = '$user_id'";
                    $result = mysqli_query($con, $sql);
                    $counter = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        $buyer_ID = $row['buyer_ID'];
                        $order_ID = $row['order_ID'];
                        //$buyer_address = $row['buyer_address'];
                        //$phoneNumber = $row['phoneNumber'];
                        $amount = $row['amount'];
                        $order_date = $row['order_date'];
                        $payment_method = $row['payment_method'];
                        $order_status = $row['order_status'];
                        $counter++;

                        $itemsql1 = "SELECT * FROM `buyers` WHERE id = $buyer_ID";
                        $itemresult1 = mysqli_query($con, $itemsql1);
                        $itemrow1 = mysqli_fetch_assoc($itemresult1);
                        //array null 76 to 76 when @ is removed
                        @$fname = $itemrow1['fname'];
                        @$lname = $itemrow1['lname'];
                        @$buyer_address = $itemrow1['address'];
                        @$phoneNumber = $itemrow1['phoneNumber'];

                        
                        echo '<tr>
                                <td>' . $order_ID . '</td>
                                <td>' . $fname .' '. $lname . '</td>
                                <td>' . $buyer_address . '</td>
                             
                                <td>' . $phoneNumber . '</td>
                                <td>₱ ' . $amount . '</td>
                                <td>' . $payment_method . '</td>
                                <td>' . $order_date . '</td>
                                <td><a href="#" data-toggle="modal" data-target="#orderStatus' . $order_ID . '" class="view"><i class="material-icons">&#xE5C8;</i></a></td>
                                <td><a href="#" data-toggle="modal" data-target="#orderItem' . $order_ID . '" class="view" title="View Details"><i class="material-icons">&#xE5C8;</i></a></td>
                            </tr>';
                    }
                    if($counter==0) {
                        ?><script> document.getElementById("NoOrder").innerHTML = '<div class="alert alert-info alert-dismissible fade show" role="alert" style="width:100%; background-color: #5cb85c !important; color: white !important;"> You have not received any orders yet.	</div>';</script> <?php
                    } 
                ?>
            </tbody>
        </table>
    </div>
</div> 
</div>
<?php 
    include 'function/_orderItemModal.php';
    include 'function/_orderStatusModal.php';
?>

</body>
</html>

