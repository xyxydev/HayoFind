<head>
    <link rel="stylesheet" type="text/css" href="css/loginForm.css">
    <link rel="stylesheet" type="text/css" href="loginHeader.css">
    <link rel="shortcut icon" class="iconTab" href="images/cow.ico">
    <!----FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.1/css/bootstrap.min.css">
     <!-- Bootstrap CDN -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- JavaScript (optional) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>

</head>
    <div class="container-nav">
        <div class="nav-img">
            <img class="custom-logo-img" src="customerSIDE/logo.png" alt="registerLogo">
        </div>
        
        <div class="nav-title">
            <span class="hayofind">HayoFind</span>
        </div>
        <div class="login-title">
            <?php if(isset($register) && $register == true): ?>
                <span class="login" style="margin-left: -30px;">Register</span>
            <?php else: ?>
                <span class="login">Login</span>
            <?php endif; ?>
        </div>
    </div>
    <div class="home-content">
        <span class="welcome">Welcome to HayoFind</span><br>
        <span class="platform">E-Commerce Website</span><br><br>
        <span class="desc">The <span class="hay">HayoFind</span> is a web application created by BROMS Technologies that provides<br> a convenient way in buying and selling livestock.
        It provides the users with the<br> options to look and choose their desired kind of livestock. </span><br><br>
        
        <?php if(isset($merchantReg) && $merchantReg == true): ?>
            <p class="reg">Register to sell now!    <button class="reg-BTN" type="submit" name="submit">Register</button></p>
        <?php else: ?>
            <p class="reg">Register to shop now!    <button class="reg-BTN" type="submit" name="submit">Register</button></p>
        <?php endif; ?>
    
        <img class="home-image" src="123.jpg" alt="login-logo" style="height: 364px; width: 860px;">
    </div>