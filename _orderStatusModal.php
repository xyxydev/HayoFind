<head>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

</head>
<style>
    /* .modal-body {
        background-color: #eeeeee;
        font-family: 'Open Sans', serif
    } */

    .card {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    .card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1)
    }

    .track {
        position: relative;
        background-color: #ddd;
        height: 7px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 60px;
        margin-top: 50px
    }

    .track .step {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        width: 25%;
        margin-top: -18px;
        text-align: center;
        position: relative
    }

    .track .step.active:before {
        background: green;
    }

    .track .step::before {
        height: 7px;
        position: absolute;
        content: "";
        width: 100%;
        left: 0;
        top: 18px
    }

    .track .step.active .icon {
        background: green;
        color: #fff
    }

    .track .step.deactive:before {
        background: #030303;
    }

    .track .step.deactive .icon {
        background: #030303;
        color: #fff
    }

    .track .icon {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        position: relative;
        border-radius: 100%;
        background: #ddd
    }

    .track .step.active .text {
        font-weight: 400;
        color: #000
    }

    .track .text {
        display: block;
        margin-top: 7px
    }

    .btn-warning {
        color: #ffffff;
        background-color: green;
        border-color: green;
        border-radius: 1px
    }

    .btn-warning:hover {
        color: #ffffff;
        background-color: #ff2b00;
        border-color: #ff2b00;
        border-radius: 1px
    }
    
    h5.modal-title{
        color: green;
        margin-left: 330px;
    }
    button.close{
        text-decoration: none;
        outline: none;
    }
</style>
<?php

    include_once("connections/connect.php");
    $con = connection();
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        // Handle the case where the user ID is not set
        $error = "No user";
    }
    ?>
<?php 
    $statusmodalsql = "SELECT * FROM `order_details`  WHERE `buyer_ID`= $user_id";
    $statusmodalresult = mysqli_query($con, $statusmodalsql);
    while($statusmodalrow = mysqli_fetch_assoc($statusmodalresult)){
        $orderid = $statusmodalrow['order_ID'];
        $status = $statusmodalrow['order_status'];
        if ($status == 0) 
            $tstatus = "Order Placed.";
        elseif ($status == 1) 
            $tstatus = "Order Confirmed.";
        elseif ($status == 2)
            $tstatus = "Preparing your Order.";
        elseif ($status == 3)
            $tstatus = "Your order is on the way!";
        elseif ($status == 4) 
            $tstatus = "Order Delivered.";
        elseif ($status == 5) 
            $tstatus = "Order Denied.";
        else
            $tstatus = "Order Cancelled.";

        if($status >= 1 && $status <= 4) {
            $deliveryDetailSql = "SELECT * FROM `delivery_details` WHERE `order_ID`= $orderid";
            $deliveryDetailResult = mysqli_query($con, $deliveryDetailSql);
            $deliveryDetailRow = mysqli_fetch_assoc($deliveryDetailResult);
            $trackId = @$deliveryDetailRow['id'];
            $deliveryBoyName = @$deliveryDetailRow['deliveryName'];
            $deliveryBoyPhoneNo = @$deliveryDetailRow['deliveryPhoneNumber'];
            $deliveryTime = @$deliveryDetailRow['deliveryTime'];
            if($status == 4)
                $deliveryTime = 'xx';
        }
        else {
            $trackId = 'xxxxx';
            $deliveryBoyName = '';
            $deliveryBoyPhoneNo = '';
            $deliveryTime = 'xx';
        }
?>
<!-- Modal -->
<div class="modal fade" id="orderStatus<?php echo $orderid; ?>" tabindex="-1" role="dialog" aria-labelledby="orderStatus<?php echo $orderid; ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="orderStatus<?php echo $orderid; ?>">Order Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="text-decoration: none;">
                    <span aria-hidden="true" style="text-decoration: none;">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="printThis">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <h6><strong>Order ID:</strong> #<?php echo $orderid; ?></h6>
                            <div class="row">
                                <div class="col-md-3"> <strong>Estimated Delivery time:</strong> <br><?php echo $deliveryTime; ?> minutes </div>
                                <div class="col-md-3"> <strong>Shipping By:</strong> <br> <?php echo $deliveryBoyName; ?> | <i class="fa fa-phone"></i> <?php echo $deliveryBoyPhoneNo; ?> </div>
                                <div class="col-md-3"> <strong>Status:</strong> <br> <?php echo $tstatus; ?> </div>
                                <div class="col-md-3"> <strong>Tracking #:</strong> <br> <?php echo $trackId; ?> </div>
                            </div>
                        </div>
                    </div>
                    <div class="track">
                        <?php
                            if ($status == 0) {
                                echo '
                                <div class="step active">
                                    <span class="icon"><i class="fa fa-check"></i></span>
                                    <span class="text">Order Placed</span>
                                </div>
                                <div class="step">
                                    <span class="icon"><i class="fa fa-times"></i></span>
                                    <span class="text">Order Confirmed</span>
                                </div>
                                <div class="step">
                                    <span class="icon"><i class="fa fa-times"></i></span>
                                    <span class="text">Preparing your Order</span>
                                </div>
                                <div class="step">
                                    <span class="icon"><i class="fa fa-truck"></i></span>
                                    <span class="text">On the way</span>
                                </div>
                                <div class="step">
                                    <span class="icon"><i class="fa fa-box"></i></span>
                                    <span class="text">Order Delivered</span>
                                </div>';
                            } elseif ($status == 1) {
                                echo '
                                <div class="step active">
                                    <span class="icon"><i class="fa fa-check"></i></span>
                                    <span class="text">Order Placed</span>
                                </div>
                                <div class="step active">
                                    <span class="icon"><i class="fa fa-check"></i></span>
                                    <span class="text">Order Confirmed</span>
                                </div>
                                <div class="step">
                                    <span class="icon"><i class="fa fa-times"></i></span>
                                    <span class="text">Preparing your Order</span>
                                </div>
                                <div class="step">
                                    <span class="icon"><i class="fa fa-truck"></i></span>
                                    <span class="text">On the way</span>
                                </div>
                                <div class="step">
                                    <span class="icon"><i class="fa fa-box"></i></span>
                                    <span class="text">Order Delivered</span>
                                </div>';
                            } elseif ($status == 2) {
                                echo '
                                <div class="step active">
                                    <span class="icon"><i class="fa fa-check"></i></span>
                                    <span class="text">Order Placed</span>
                                </div>
                                <div class="step active">
                                    <span class="icon"><i class="fa fa-check"></i></span>
                                    <span class="text">Order Confirmed</span>
                                </div>
                                <div class="step active">
                                    <span class="icon"><i class="fa fa-check"></i></span>
                                    <span class="text">Preparing your Order</span>
                                </div>
                                <div class="step">
                                    <span class="icon"><i class="fa fa-truck"></i></span>
                                    <span class="text">On the way</span>
                                </div>
                                <div class="step">
                                    <span class="icon"><i class="fa fa-box"></i></span>
                                    <span class="text">Order Delivered</span>
                                </div>';
                            } elseif ($status == 3) {
                                echo '
                                <div class="step active">
                                    <span class="icon"><i class="fa fa-check"></i></span>
                                    <span class="text">Order Placed</span>
                                </div>
                                <div class="step active">
                                    <span class="icon"><i class="fa fa-check"></i></span>
                                    <span class="text">Order Confirmed</span>
                                </div>
                                <div class="step active">
                                    <span class="icon"><i class="fa fa-check"></i></span>
                                    <span class="text">Preparing your Order</span>
                                </div>
                                <div class="step active">
                                    <span class="icon"><i class="fa fa-truck"></i></span>
                                    <span class="text">On the way</span>
                                </div>
                                <div class="step">
                                    <span class="icon"><i class="fa fa-box"></i></span>
                                    <span class="text">Order Delivered</span>
                                </div>';
                            } elseif ($status == 4) {
                                echo '
                                <div class="step active">
                                    <span class="icon"><i class="fa fa-check"></i></span>
                                    <span class="text">Order Placed</span>
                                </div>
                                <div class="step active">
                                    <span class="icon"><i class="fa fa-check"></i></span>
                                    <span class="text">Order Confirmed</span>
                                </div>
                                <div class="step active">
                                    <span class="icon"><i class="fa fa-check"></i></span>
                                    <span class="text">Preparing your Order</span>
                                </div>
                                <div class="step active">
                                    <span class="icon"><i class="fa fa-truck"></i></span>
                                    <span class="text">On the way</span>
                                </div>
                                <div class="step active">
                                    <span class="icon"><i class="fa fa-box"></i></span>
                                    <span class="text">Order Delivered</span>
                                </div>';
                            } elseif ($status == 5) {
                                echo '
                                <div class="step active">
                                    <span class="icon"><i class="fa fa-check"></i></span>
                                    <span class="text">Order Placed</span>
                                </div>
                                <div class="step deactive">
                                    <span class="icon"><i class="fa fa-times"></i></span>
                                    <span class="text">Order Denied.</span>
                                </div>';
                            } else {
                                echo '
                                <div class="step deactive">
                                    <span class="icon"><i class="fa fa-times"></i></span>
                                    <span class="text">Order Cancelled.</span>
                                </div>';
                            }
                        ?>
                    </div>
                    <!--<a href="contact.php" class="btn btn-warning" data-abc="true">Help <i class="fa fa-chevron-right"></i></a>-->
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    }
?>

