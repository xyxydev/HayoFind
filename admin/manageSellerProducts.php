<?php
    session_start();
    @$username = $_SESSION['username'];
    include_once("connections/connect.php");
    $con = connection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" class="iconTab" href="images/cow.ico">
    <title>View Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>Admin Page</title>
    <link rel = "icon" href ="/OnlinePizzaDelivery/img/logo.jpg" type = "image/x-icon">
    
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    
</head>
<style>
    .container-fluid{
        margin-top: 20px !important;
        font-family: 'Quicksand' !important;
    }
    th{
        font-size: 18px;
        font-weight: 500 !important;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    td{
        padding-top: 10px;
        padding-bottom: 10px;
    }
    #backtohome {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    user-select: none;
    padding: 0.5rem 1rem;
    font-size: 1.25rem;
    line-height: 1.5;
    border-radius: 0.3rem;
    color: #fff;
    background-color: #91C788;
    border: none;
    outline: none;
    text-decoration: none !important;
}
</style>
<body>
    <?php
        require_once('adminHeader.php'); 
    ?>

    <!----BODY STARTS HERE-->
    
    <div class="container-fluid">
    <a class="mb-3 button" href="index.php" id="backtohome" style="margin-left: 400px;">Back to Home</a>
    <div class="row">
        <div class="card col-lg-12" style="border: none !important; margin-left: 400px;">
            <div class="card-body">
                <table class="table-striped col-md-6 text-center">
                    <thead style="background-color: #91C788 !important; color: white;">
                        <tr>
                            <th>Seller ID</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Item Kind</th>
                            <th>Item Price</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM merchants";
                        $result = mysqli_query($con, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $username = $row['username'];
                            $name = $row['fname'] . ' ' . $row['lname'];
                            $email = $row['email'];
                            $phone = $row['phoneNumber'];
                            $gender = $row['gender'];
                            $address = $row['address'];
                            $dob = $row['dob'];
                            $documents = $row['documents'];
                            $image = $row['img'];

                           // $productsSQL = "SELECT * FROM products WHERE merchantsID_fk = $id"; // Add a condition to retrieve products of the specific seller
                           $productsSQL = "SELECT p.*, k.item_Kind 
                           FROM products p
                           JOIN product_kind k ON p.item_ID = k.id
                           WHERE p.merchantsID_fk = '$id'";
                           $productsResult = mysqli_query($con, $productsSQL);
                            while ($rows = mysqli_fetch_assoc($productsResult)) {
                                $item_ID = $rows['item_ID'];
                                $item_Name = $rows['item_Name'];
                                $item_Kind = $rows['item_Kind'];
                                $item_Price = $rows['item_Price'];

                                echo '<tr>
                                    <td>' . $id . '</td>
                                    <td>' . $username . '</td>
                                    <td>' . $name . ' </td>
                                    <td>' . $item_ID . ' </td>
                                    <td>' . $item_Name . ' </td>
                                    <td>' . $item_Kind . ' </td>
                                    <td>' . $item_Price . ' </td>
                                    <td class="text-center">
                                        <div class="row mx-auto" style="width:112px">
                                            <button class="btn btn-sm btn-primary d-none" type="button">Verify</button>';
                                        
                                                echo '<form action="function/_userManage.php" method="POST">
                                                        <button name="removeUser" class="btn btn-sm btn-danger" style="margin-left:9px;"> <i class="fas fa-trash-alt"></i></button>
                                                        <input type="hidden" name="id" value="'.$id. '">
                                                    </form>';
                                

                                    echo '</div>
                                    </td>
                                </tr>';
                            }
                        }
                        ?>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    <!----BODY ENDS HERE-->

</body>
</html>