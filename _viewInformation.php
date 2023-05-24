<?php
    session_start();
    @$user_id = $_SESSION['user_id'];
    include_once("connections/connect.php");
    $con = connection();
    require_once('indexHeader.php');
?>

<head>
    <link rel="stylesheet" href="buyer css/_viewInformation.css">
</head>

<body>
    <div class="container-fluid">
        <a class="mb-3 button" href="index.php" id="backtohome">Back to Home</a>
        <div class="info-container">
            <div class="row">
                    <?php
                    if (isset($_POST['view'])) {
                        $productID = $_POST['product_ID'];
                        //$query = "SELECT * FROM products WHERE item_ID = $productID";
                        $query = "SELECT p.*, k.item_Kind
                        FROM products p
                        JOIN product_kind k ON p.item_ID = k.id
                        WHERE p.item_ID = $productID";
                        $result = $con->query($query);

                        if ($result && $result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $seller_ID = $row['merchantsID_fk'];
                            $item_IMG = $row['item_IMG'];
                            $item_Name = $row['item_Name'];
                            $item_Age = $row['item_Age'];
                            $item_Price = $row['item_Price'];
                            $item_Kind = $row['item_Kind'];
                            $item_Breed = $row['item_Breed'];
                            $item_Weight = $row['item_Weight'];
                            $item_Desc = $row['item_Desc'];
                            $item_Stock = $row['item_Stock'];

                            $query2 = "SELECT * FROM merchants WHERE id = $seller_ID";
                            $result2 = $con->query($query2);
                            $row2 = $result2->fetch_assoc();
                            $fname = $row2['fname'];
                            $lname = $row2['lname'];
                            $sellerid = $row2['id'];


                            $query3 = "SELECT * FROM merchant_verification WHERE seller_ID = $sellerid";
                            $result3 = $con->query($query3);
                            $row3 = $result3->fetch_assoc();
                            $status = $row3['verification_status'];
                            

                        }
                    }
                    ?>
                
                <div class="col-md-4">
                    <br>
                    <img src="<?php echo $item_IMG; ?>" alt="Item Image" class="img-fluid" style="height: 300px; width: 100%;">
                </div>
                <div class="col-md-4">
                    <h5 class="name"><?php echo $item_Name; ?></h5>
                    <h6>Ratings 
                        <i class="fas fa-star" id="star-icon"></i>
                        <i class="fas fa-star" id="star-icon"></i>
                        <i class="fas fa-star" id="star-icon"></i>
                        <i class="fas fa-star" id="star-icon"></i>
                        <i class="far fa-star" id="star-icon"></i>
                    </h6>
                    <h6>Merchant: <span><?php echo $fname.' '.$lname; ?></span> <span><?php echo '('.' '.$status.' '.')'; ?></span></h6><br>
                    <p>Description:  <span class="desc"><?php echo $item_Desc; ?></span></p>
                </div>
                <div class="col-md-4" style="padding-left: 10px;">
                  
                    <br>
                    <h6>Price: &#8369; <span><?php echo $item_Price; ?></span></h6><br>
                    <h6>Age: <span id="left"><?php echo $item_Age; ?> months</span></h6><br>
                    <h6>Stock: <span id="left"><?php echo $item_Stock; ?></span></h6><br>
                    <h6>Kind: <span id="left"><?php echo $item_Kind; ?></span></h6><br>
                    <h6>Breed: <span id="left"><?php echo $item_Breed; ?></span></h6><br>
                    <h6>Weight: <span id="left"><?php echo $item_Weight; ?> kg</span></h6>
                </div>
            </div>
        </div>
    </div>

    
</body>
