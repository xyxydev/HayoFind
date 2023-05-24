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
    <link rel="stylesheet" href="buyer css/viewOrders.css">
    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    
</head>
<body>
   
    <?php
    session_start();
    include_once("connections/connect.php");
    $con = connection();
	require_once('indexHeader.php'); 
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        // Handle the case where the user ID is not set
        $error = "No user";
    }
    ?>

 <div class="container">
    <div class="table-title">
        <h2><i class="fas fa-list-ol order-icon" style="color:#5cb85c;"></i>  Order Details</h2>
    </div>
            
        <div class="table-wrapper" id="empty">
            <table class="table table-striped table-hover text-center">
                <thead  style="background-color: #5cb85c !important; color: white;">
                    <tr>
                        <th>Order ID</th>
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
                        $sql = "SELECT * FROM `order_details` WHERE `buyer_ID`= $user_id";
                        $result = mysqli_query($con, $sql);
                        $counter = 0;
                        while($row = mysqli_fetch_assoc($result)){
                            $order_ID = $row['order_ID'];
                            $amount = $row['amount'];
                            $payment_method = $row['payment_method'];
                            $order_date = $row['order_date'];
                            $orderStatus = $row['order_status'];

                            $que = "SELECT * FROM buyers WHERE id = $user_id";
                            $res = $con->query($que);
                            if ($res && $res->num_rows > 0) {
                                $row = $res->fetch_assoc();

                                $buyer_address = $row['address'];
                                $phoneNumber = $row['phoneNumber'];
                            }
                            
                            $counter++;
                            
                            echo '<tr>
                                    <td>' . $order_ID . '</td>
                                    <td>' . $buyer_address. '</td>
                                    <td>' . $phoneNumber . '</td>
                                    <td>₱ ' . $amount . '</td>
                                    <td>' . $payment_method . '</td>
                                    <td>' . $order_date . '</td>
                                    <td><a href="#" data-toggle="modal" data-target="#orderStatus' . $order_ID . '" class="view"><i class="material-icons">&#xE5C8;</i></a></td>
                                    <td><a href="#" data-toggle="modal" data-target="#orderItem' . $order_ID . '" class="view" title="View Details"><i class="material-icons">&#xE5C8;</i></a></td>
                                    
                                </tr>';
                        } 
                        
                        if($counter==0) {
                            ?><script> document.getElementById("empty").innerHTML = '<div class="col-md-12 my-5"><div class="card"><div class="card-body cart"><div class="col-sm-12 empty-cart-cls text-center"><h3 style="margin-top: 80px;"><strong>You have not ordered any items.</strong></h3><a href="index.php" class="continue" data-abc="true">continue shopping</a> </div></div></div></div>';</script> <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div> 
	
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>


	<!-- Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <?php 
    include '_orderItemModal.php';
    include '_orderStatusModal.php';
   ?> 
</body>

</html>