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
    <link rel="stylesheet" href="sellerHeader.css">
    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<div class="navbarBox">
        <div class="logoName">
            <img class="custom-logo-img" src="images/logo.png" alt="registerLogo">
        </div>
        <div class="hayofind-div">
            <span class="hayofind">HayoFind</span>
        </div>
        
        <ul class="ul-nav">
            <li><a class="home-anc" href="merchantPage.php">Home</a></li>
            <li><a class="myproducts-anc" href="merchantProducts.php">My Products</a></li>

                <?php if(isset($addnewproduct) && $addnewproduct == true): ?>
                    <li><a class="addnewproduct-anc" href="addnewproductPage.php" style="border-bottom: 1px solid #52734D;border-radius: 5px;padding-left: 30px;
                padding-right: 30px;padding-top: 18px;  padding-bottom: 18px;background-color: #52734D;">Add New Product</a></li>
                <?php else: ?>
                    <li><a class="addnewproduct-anc" href="addnewproductPage.php">Add New Product</a></li>
                <?php endif; ?>

            <li><a class="myorders-anc" href="#">My Orders</a></li>
            <li class="dropdown">

                <?php if(isset($myaccount) && $myaccount == true): ?>
                    <a class="myaccount-anc" href="#" style="border-bottom: 1px solid #52734D;border-radius: 5px;padding-left: 30px;
                    padding-right: 30px;padding-top: 18px;  padding-bottom: 18px;background-color: #52734D;">My Account</a>
                <?php else: ?>
                    <a class="myaccount-anc" href="#">My Account</a>
                <?php endif; ?>

                <div class="dropdown-content">
                  <a class="profile-anc" href="myaccountPage.php">Profile</a>
                  <a class="settings-anc" href="#">Switch</a>
                  <a class="logout-anc" href="index.php">Logout</a>
                </div>
            </li>
        </ul>
</div>
