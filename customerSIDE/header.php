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
    <link rel="stylesheet" href="header.css">
    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

</head>

<div class="whole-cont">
    <div class="navbarBox">
        <div class="topNav1">
            <a class="sell-anc" href="merchantLoginForm.php">Sell Livestock</a>
            <a class="fb-anc" href="#">Follow us on <i class="fab fa-facebook"></i></a>
            <a class="notif-anc" href="#"><i class="fas fa-bell"></i> Notifications</a>
            <a class="user-anc" href="#"><i class="fas fa-user"></i> My Account</a>
        </div>
        
        <div class="logoName">
            <img class="custom-logo-img" src="customerSIDE/logo.png" alt="registerLogo">
        </div>

        <div class="hayofind-div">
            <span class="hayofind">HayoFind</span>
        </div>
        
        <div class="container" id="search-cont">
            <form class="form-inline my-2 my-lg-0">
                <div class="input-group">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" style="width: 700px;">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                </div>
            </form>
        </div>
        <div class="cartNav">
            <a class="cart-anc" href="cart.php"><i class="fas fa-shopping-cart"></i> Orders 
            
            <?php 
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    $count = count($_SESSION['cart']);
                    echo "<span class=\"order-count\">$count</span>";
                } else {
                    echo "<span class=\"order-count\">0</span>";
                }
            ?>
            </a>
            
        </div>
        
        <div>
            <ul>
                <li>Cattles</li>
                <li>Sheep</li>
                <li>Pig</li>
                <li>Horse</li>
                <li>Chicken</li>
            </ul>
        </div>
    </div>