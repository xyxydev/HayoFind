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

    <link rel="shortcut icon" class="iconTab" href="customerSIDE/cow.ico">
    <link rel="stylesheet" href="customerSIDE/index.css">
    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

</head>


<body>
    <?php
        session_start();
        @$user_id = $_SESSION['user_id'];
    include_once("connections/connect.php");
    require_once('customerSIDE/component.php'); 
    $con = connection();
    
    ?>

    <?php
        require_once('indexHeader.php'); 
    
    ?>

    
        <div class="container" id="containerList">
            <div class="row text-center py-5">
                <?php
                /***
                    component(productname:"Cow", productprice:1000, productImage:"cow.jpg");
                    component(productname:"Chicken", productprice:500, productImage:"cow.jpg");
                    component(productname:"Cow", productprice:5000, productImage:"cow.jpg");
                    component(productname:"Cow", productprice:1000, productImage:"cow.jpg");
                    component(productname:"Chicken", productprice:500, productImage:"cow.jpg");
                    component(productname:"Cow", productprice:1000, productImage:"cow.jpg");
                    component(productname:"Cow", productprice:1000, productImage:"cow.jpg");
                    component(productname:"Cow", productprice:1000, productImage:"cow.jpg"); **/


                    //get data from database
                    $sql = "SELECT * FROM products";

                    //execute the SQL query and fetch the data
                    $result = mysqli_query($con, $sql);

                    //check if there are any results
                    if (mysqli_num_rows($result) > 0) {
                        //output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                           // echo "Product ID: " . $row["id"]. " - Name: " . $row["name"]. " - Price: " . $row["price"]. "<br>";
                           component($row['item_Name'], $row['item_Price'], $row['item_IMG'], $row['item_Kind'], $row['item_Weight'], $row['item_ID']);
                        }
                    } else {
                        echo "0 results";
                    }
                    

                    if (isset($_POST['add'])){
                        /// print_r($_POST['product_id']);
                        if(isset($_SESSION['cart'])){
                    
                            $item_array_id = array_column($_SESSION['cart'], "product_ID");
                    
                            if(in_array($_POST['product_ID'], $item_array_id)){
                                echo "<script>alert('Product is already added in the cart..!')</script>";
                                echo "<script>window.location = 'index.php'</script>";
                            }else{
                    
                                $count = count($_SESSION['cart']);
                                $item_array = array(
                                    'product_ID' => $_POST['product_ID']
                                );
                    
                                $_SESSION['cart'][$count] = $item_array;
                                //print_r($_SESSION['cart']);
                            }
                    
                        }else{
                    
                            $item_array = array(
                                    'product_ID' => $_POST['product_ID']
                            );
                    
                            // Create new session variable
                            $_SESSION['cart'][0] = $item_array;
                            print_r($_SESSION['cart']);
                        }
                    }
                ?>
            </div>
        </div>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>