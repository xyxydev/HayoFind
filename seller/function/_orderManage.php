<?php
    include_once("../connections/connect.php"); 
    $con = connection();
   

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['updateStatus'])) {
        $order_ID = $_POST['orderId'];
        $order_status = $_POST['status'];

        $sql = "UPDATE `order_details` SET `order_status`='$order_status' WHERE `order_ID`='$order_ID'";   
        $result = mysqli_query($con, $sql);
        if ($result){
            echo "<script>alert('update successfully');
                window.location=document.referrer;
                </script>";
        }
        else {
            echo "<script>alert('failed');
                window.location=document.referrer;
                </script>";
        }
    }
    
    if(isset($_POST['updateDeliveryDetails'])) {
        $trackId = $_POST['trackId'];
        $orderId = $_POST['orderId'];
        $name = $_POST['name'];
        $time = $_POST['time'];
        $phone = $_POST['phone'];
        if($trackId == NULL) {
            $sql = "INSERT INTO `delivery_details` (`order_ID`, `deliveryName`, `deliveryPhoneNumber`, `deliveryTime`, `dateTime`) VALUES ('$orderId', '$name', '$phone', '$time', current_timestamp())";   
            $result = mysqli_query($con, $sql);
            $trackId = $con->insert_id;
            if ($result){
                echo "<script>alert('update successfully');
                    window.location=document.referrer;
                    </script>";
            }
            else {
                echo "<script>alert('failed');
                    window.location=document.referrer;
                    </script>";
            }
        }
        else {
            $sql = "UPDATE `delivery_details` SET `deliveryName`='$name', `deliveryPhoneNumber`='$phone', `deliveryTime`='$time',`dateTime`=current_timestamp() WHERE `id`='$trackId'";   
            $result = mysqli_query($con, $sql);
            if ($result){
                echo "<script>alert('update successfully');
                    window.location=document.referrer;
                    </script>";
            }
            else {
                echo "<script>alert('failed');
                    window.location=document.referrer;
                    </script>";
            }
        }
    }
}

?>