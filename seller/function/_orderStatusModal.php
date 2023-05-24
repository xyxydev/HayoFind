<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<style>
    .modal-header{
        background-color: #5cb85c;
        color: white;
    }
    .modal-title{
        margin-left: 170px;
        font-family: 'Quicksand' !important;
    }
    .row input{
        margin-left: 170px;
    }
    .btn-udpate{
        margin-left: 190px;
    }
    #dialog{
        margin-top: 200px !important;
    }
    .del-details{
        text-align: center;
        font-family: 'Quicksand' !important;
        margin-top: 20px;
        background-color: #5cb85c;
        margin-left: -16px !important;
        margin-right: -16px !important;
        padding-top: 17px;
        padding-bottom: 13px;
        color: white;
    }
    form{
        text-decoration: none;
        outline: none;
    }
    .form-2{
        font-family: 'Quicksand' !important;
        margin-top: 20px;
    }
    #update-btn2{
        margin-left: 190px;
    }
</style>
<?php 
    $itemModalSql = "SELECT * FROM `order_details`";
    $itemModalResult = mysqli_query($con, $itemModalSql);
    while($itemModalRow = mysqli_fetch_assoc($itemModalResult)){
        $order_ID = $itemModalRow['order_ID'];
        $buyer_ID = $itemModalRow['buyer_ID'];
        $order_status = $itemModalRow['order_status'];
    
?>

<!-- Modal -->
<div class="modal fade" id="orderStatus<?php echo $order_ID; ?>" tabindex="-1" role="dialog" aria-labelledby="orderStatus<?php echo $order_ID; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document" id="dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="orderStatus<?php echo $order_ID; ?>">Order Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form action="function/_orderManage.php" method="post" style="border-bottom: 2px solid #dee2e6;">
            <div class="form-group">
                
                <div class="row input">
                    <input class="form-control col-md-3" style="font-weight: bold;" id="status" name="status" value="<?php echo $order_status; ?>" type="number" min="0" max="6" required>
                    <button type="button" class="btn btn-secondary ml-1" onclick="displayContent()" data-container="body" data-toggle="popover" title="User Types" data-placement="right" data-html="true" data-content="0=Order Placed.<br> 1=Order Confirmed.<br> 2=Preparing your Order.<br> 3=Your order is on the way!<br> 4=Order Delivered.<br> 5=Order Denied.<br> 6=Order Cancelled.">
                        <i class="fas fa-info"></i>
                    </button>
                </div>
            </div>
            <div class="btn-udpate">
                <input type="hidden" id="orderId" name="orderId" value="<?php echo $order_ID; ?>">
                <button type="submit" class="btn btn-success mb-2" name="updateStatus">Update</button>
            </div>
        </form>

        <div class="del-details">
            <h5 class="title">Delivery Details</h5>
        </div>
            
        <?php 
            $deliveryDetailSql = "SELECT * FROM `delivery_details` WHERE `order_ID`= $order_ID";
            $deliveryDetailResult = mysqli_query($con, $deliveryDetailSql);
            $deliveryDetailRow = mysqli_fetch_assoc($deliveryDetailResult);
            
            $trackId = @$deliveryDetailRow['id'];
            $deliveryBoyName = @$deliveryDetailRow['deliveryName'];
            $deliveryBoyPhoneNo = @$deliveryDetailRow['deliveryPhoneNumber'];
            $deliveryTime = @$deliveryDetailRow['deliveryTime'];

            if($order_status > 0 && $order_status < 5) { 
        ?>
            <form action="function/_orderManage.php" method="post" class="form-2">
                <div class="form-group">
                    <label for="name"><strong>Delivery Name</strong></label>
                    <input class="form-control" id="name" name="name" value="<?php echo $deliveryBoyName; ?>" type="text" style="font-weight: bold;" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="phone"><strong>Phone No.</strong></label>
                        <input class="form-control" id="phone" name="phone" value="<?php echo $deliveryBoyPhoneNo; ?>" style="font-weight: bold;" type="number" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="time"><strong>Estimate Time (minute)</strong></label>
                        <input class="form-control" id="time" name="time" value="<?php echo $deliveryTime; ?>" style="font-weight: bold;" type="number" min="1" max="120" required>
                    </div>
                </div>
                <input type="hidden" id="trackId" name="trackId" value="<?php echo $trackId; ?>">
                <input type="hidden" id="orderId" name="orderId" value="<?php echo $order_ID; ?>">
                <button type="submit" class="btn btn-success" name="updateDeliveryDetails" id="update-btn2">Update</button>
            </form>
        <?php } ?>
      </div>
    </div>
  </div>
</div>


<?php
    }
?>

<style>
    .popover {
        top: -77px !important;
    }
</style>

<script>
    $(function () {
        $('[data-toggle="popover"]').popover();
    });
</script>
<script>
function displayContent() {
  // Get the element with the data-content attribute
  var popoverElement = document.querySelector('[data-toggle="popover"]');
  
  // Get the content from the data-content attribute
  var content = popoverElement.getAttribute('data-content');
  
  // Create a new element to display the content
  var contentElement = document.createElement('div');
  contentElement.innerHTML = content;
  
  // Display the content using a popover or any other preferred method
  // Here, we'll use Bootstrap's popover functionality
  $(popoverElement).popover({
    content: contentElement,
    trigger: 'manual',
    html: true
  });
  
  // Show the popover
  $(popoverElement).popover('show');
}
</script>