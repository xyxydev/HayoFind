<?php 
     include_once("../connections/connect.php");
     $con = connection();
     $id = $_POST['id'];

    if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['verify'])) {
        $id = $_POST["id"];

        define('VERIFY', "Verified");
        $update_verification_status = VERIFY;

        $sql = "UPDATE buyer_verification SET verification_status = '$update_verification_status' WHERE buyer_ID = $id";

        $result = mysqli_query($con, $sql);
        echo "<script>alert('Verified');
            window.location=document.referrer;
            </script>";
    }
    //seller or merchant side
    if(isset($_POST['verify'])) {
        $id = $_POST["id"];

        define('VERIFY', "Verified");
        $update_verification_status = VERIFY;

        $sql = "UPDATE merchant_verification SET verification_status = '$update_verification_status' WHERE seller_ID = $id";

        $result = mysqli_query($con, $sql);
        echo "<script>alert('Verified');
            window.location=document.referrer;
            </script>";
    }
    
}
?>