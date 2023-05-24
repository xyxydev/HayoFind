<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <style>
        .modal{
            background-color: transparent !important; 
            border: none !important; 
            box-shadow: none !important;

        }
        
    </style>
</head>
<?php 
    $user_id = $_SESSION['user_id'];
    $itemModalSql = "SELECT * FROM `order_details` WHERE `buyer_ID`= $user_id";
    $itemModalResult = mysqli_query($con, $itemModalSql);
    while($itemModalRow = mysqli_fetch_assoc($itemModalResult)){
        $orderid = $itemModalRow['order_ID'];
    
?>

<!-- Modal -->
<div class="modal fade" id="orderItem<?php echo $orderid; ?>" tabindex="-1" role="dialog" aria-labelledby="orderItem<?php echo $orderid; ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderItem<?php echo $orderid; ?>">Order Items</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="container">
                    <div class="row" style="margin-top: -155px;">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="border-0">
                                            <div class="px-3">Image</div>
                                        </th>
                                        <th scope="col" class="border-0">
                                            <div class="px-3">Seller</div>
                                        </th>
                                        <th scope="col" class="border-0">
                                            <div class="px-3">Item Information</div>
                                        </th>
                                        <th scope="col" class="border-0">
                                            <div class="text-center">Quantity</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $mysql = "SELECT * FROM `orders` WHERE order_ID = $orderid";
                                        $myresult = mysqli_query($con, $mysql);
                                        while($myrow = mysqli_fetch_assoc($myresult)){
                                            $product_ID = $myrow['product_ID'];
                                            $itemQuantity = $myrow['product_quantity'];
                                            
                                            $itemsql = "SELECT * FROM `products` WHERE item_ID = $product_ID";
                                            $itemresult = mysqli_query($con, $itemsql);
                                            $itemrow = mysqli_fetch_assoc($itemresult);
                                            
                                            $productName = $itemrow['item_Name'];
                                            $productPrice = $itemrow['item_Price'];
                                            $productDesc = $itemrow['item_Desc'];
                                            $image = $itemrow['item_IMG'];
                                            $seller = $itemrow['merchantsID_fk'];

                                            $itemsql1 = "SELECT * FROM `merchants` WHERE id = $seller";
                                            $itemresult1 = mysqli_query($con, $itemsql1);
                                            $itemrow1 = mysqli_fetch_assoc($itemresult1);

                                            $fname = $itemrow1['fname'];
                                            $lname = $itemrow1['lname'];
                                            $phoneNumber = $itemrow1['phoneNumber'];

                                            echo '
                                            <tr>
                                
                                                <td><img src="'.$image.'" alt="" width="70" class="img-fluid rounded shadow-sm"></td>
                                                <td class="align-middle text-center"><strong>'.$fname.' '.$lname.'<br>'.$phoneNumber.'</strong></td>
                                                <td><div class="media align-items-center">
                                                        <div class="media-body ml-3">
                                                            <h5 class="mb-0">'.$productName.'</h5>
                                                            <span><strong>₱ '.$productPrice.'</strong></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td class="align-middle text-center"><strong>'.$itemQuantity.'</strong></td>
                                            </tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<?php
    }
?>