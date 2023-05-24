<?php
    include_once("../connections/connect.php");
    $con = connection();
    $id = $_POST['id'];

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['removeUser'])) {
        $id = $_POST["id"];
        $sql = "DELETE FROM `buyers` WHERE `id`='$id'";   
        $result = mysqli_query($con, $sql);
        echo "<script>alert('Removed');
            window.location=document.referrer;
            </script>";
    }
    
}
//seller
if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['removeUser'])) {
        $id = $_POST["id"];
        $sql = "DELETE FROM `merchants` WHERE `id`='$id'";   
        $result = mysqli_query($con, $sql);
        echo "<script>alert('Removed');
            window.location=document.referrer;
            </script>";
    }
    
}
?>