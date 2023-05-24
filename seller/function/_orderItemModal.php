<style>

    #modal-dialog{
        margin-top: -100px !important;
        font-family: 'Quicksand' !important;
    }
</style>
<?php 
    $itemModalSql = "SELECT * FROM `order_details`";
    $itemModalResult = mysqli_query($con, $itemModalSql);
    while($itemModalRow = mysqli_fetch_assoc($itemModalResult)){
        $order_ID = $itemModalRow['order_ID'];
        $buyer_ID = $itemModalRow['buyer_ID'];
    
?>

<!-- Modal -->
<div class="modal fade" id="orderItem<?php echo $order_ID; ?>" tabindex="-1" role="dialog" aria-labelledby="orderItem<?php echo $order_ID; ?>" aria-hidden="true" style="width: -webkit-fill-available;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" id="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #5cb85c;">
                <h5 class="modal-title" style="margin-left:320px;" id="orderItem<?php echo $order_ID; ?>">Ordered Items</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            
                <div class="container">
                    <div class="row">
                        <!-- Shopping cart table -->
                        <div class="table-responsive">
                            <table class="table text">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-0">
                                        <div class="px-3">Image</div>
                                    </th>
                                    <th scope="col" class="border-0">
                                        <div class="px-3 text-center">Buyer</div>
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
                                    $mysql = "SELECT * FROM `orders` WHERE order_ID = $order_ID";
                                    $myresult = mysqli_query($con, $mysql);
                                    while($myrow = mysqli_fetch_assoc($myresult)){
                                        $product_ID = $myrow['product_ID'];
                                        $product_quantity = $myrow['product_quantity'];
                                        
                                        $itemsql = "SELECT * FROM `products` WHERE item_ID = $product_ID";
                                        $itemresult = mysqli_query($con, $itemsql);
                                        $itemrow = mysqli_fetch_assoc($itemresult);
                                        $item_Name = $itemrow['item_Name'];
                                        $item_Price = $itemrow['item_Price'];
                                        $item_Desc = $itemrow['item_Desc'];
                                        $item_IMG = $itemrow['item_IMG'];
                                        $seller = $itemrow['merchantsID_fk'];

                                        $itemsql1 = "SELECT * FROM `buyers` WHERE id = $buyer_ID";
                                        $itemresult1 = mysqli_query($con, $itemsql1);
                                        $itemrow1 = mysqli_fetch_assoc($itemresult1);

                                        $fname = $itemrow1['fname'];
                                        $lname = $itemrow1['lname'];
                                        $phoneNumber = $itemrow1['phoneNumber'];

                                        echo '
                                        <tr>
                                
                                            <td><img src="../'.$item_IMG.'" alt="" width="70" class="img-fluid rounded shadow-sm"></td>
                                            <td class="align-middle text-center"><strong>'.$fname.' '.$lname.'<br>'.$phoneNumber.'<strong></td>
                                            <td><div class="media align-items-center">
                                                    <div class="media-body ml-3">
                                                        <h5 class="mb-0"><strong>'.$item_Name.'</strong></h5>
                                                        <span><strong>₱ '.$item_Price.'</strong></span>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                            <td class="align-middle text-center"><strong>'.$product_quantity.'</strong></td>
                                        </tr>';
                                    }
                                ?>
                            </tbody>
                            </table>
                        </div>
                        <!-- End -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
    }
?>