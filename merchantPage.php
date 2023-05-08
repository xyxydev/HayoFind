<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/merchantPage.css">
    <link rel="shortcut icon" class="iconTab" href="images/cow.ico">
    <!----FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Page</title>
</head>
<body>
    <div class="navbarBox">
        <div class="logoName">
            <img class="logo-img" src="images/logo.png" alt="registerLogo">
        </div>
        <div class="hayofind-div">
            <span class="hayofind">HayoFind</span>
        </div>
        
        <ul>
            <li><a class="home-anc" href="merchantPage.php">Home</a></li>
            <li><a class="myproducts-anc" href="merchantProducts.php">My Products</a></li>
            <li><a class="addnewproduct-anc" href="addnewproductPage.php">Add New Product</a></li>
            <li><a class="myorders-anc" href="#">My Orders</a></li>
            <li class="dropdown">
                <a class="myaccount-anc" href="#">My Account</a>
                <div class="dropdown-content">
                  <a class="profile-anc" href="myaccountPage.php">Profile</a>
                  <a class="settings-anc" href="#">Switch</a>
                  <a class="logout-anc" href="#">Logout</a>
                </div>
            </li>
          </ul>
    </div>
    <div class="welcome-div">
        <?php
            session_start();
            $firstname = $_SESSION['firstname'];
            $lastname = $_SESSION['lastname'];
            
            echo "Hi " . $firstname . " " . $lastname . "!<br>"; 
        ?>
    </div>
    
    <div class="welcome2-div" class="run-underline">
        <?php 
            echo "You can now start managing your products and orders.";
        ?>
        <!-- echo "You currently have [Number of Products] products listed on the marketplace.";-->
    </div>
    <div class="home-btns">
        <a href="merchantProducts.php" class="view-btn">Manage products</a>
        <a href="#" class="cust-btn">Manage orders</a>
    </div>

</body>
</html>