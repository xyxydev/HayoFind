<?php
    session_start();
    // Check if login form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        include_once("function/connect.php");

        // Get username or phone number and password from form data
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Query the database to verify user credentials
        $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
        $result = $con->query($sql);

        // If the query returns a row, the credentials are valid
        if ($result->num_rows > 0) {
            // Set session variable to indicate that the user is logged in
            $_SESSION['loggedin'] = true;

            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['username'];

            // Redirect to the homepage
            header("Location: index.php");
            exit();
        } else {
            // If the query returns no rows, the credentials are invalid
            $error = "Invalid username/password";
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>Admin Login</title>

    <link rel="shortcut icon" class="iconTab" href="images/cow.ico">
    <!----FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.1/css/bootstrap.min.css">
     <!-- Bootstrap CDN -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- JavaScript (optional) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>

<style>
    body{
        font-family: 'Quicksand' !important;
    }
    .container-nav {
        width: 100%;
        height: 135px !important;              /**ADJUSTED***/
        background-color: #40513B;
        box-shadow: 0 5px 5px rgba(0, 0, 0, 0.1);
    }
    .nav-img{
        margin-left: 30px;
    }
    .login-title{
        margin-left: 1430px !important;
        margin-top: -58px !important;
    }
    .nav-title{
        margin-left: 350px !important;
        margin-top: -58px !important;
    }
    .hayofind{
        color: white !important;
        font-size: 38px !important;
        font-family: 'Quicksand' !important;
    }
    .login{
        color: white !important;
        font-size: 38px !important;
        font-family: 'Quicksand';
    }
    .custom-logo-img{
        height: 65px !important;
        width: 85px !important;
        margin-top: 35px;
        margin-left: 210px;
        background: #FFFFFF;
        border: 3px solid #91C788;
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 13px;
        padding-right: 16px;
    }

    .home-content{
        float: left;
        margin-top: 50px;
        margin-left: 140px;
        font-family: 'Quicksand' !important;
    }
    span.welcome{
        font-size: 60px !important;
        font-weight: 700;
        color:#40513B;
    }
    span.platform{
        font-size: 32px;
        font-weight: 700;
        color:#91C788;
    }
    span.desc{
        font-size: 22px;
    }
    p.reg{
        font-size: 23px;
    }
    span.hay{
        color: #9acd32;
        font-weight: 800;
    }
    .reg-BTN{
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

        /* Background and text color */
        color: #fff;
        background-color: #91C788;
        border: none;
        outline: none;
        margin-left: 30px;
        font-size: 24px;
        
    }
    .reg-BTN:hover{
        background-color: #9acd32 !important ;
        transition: ease 0.3s;
    }
    .reg-BTN:focus{
        outline: none;
        border-color: #91C788 !important;
    } 
    img.home-image{
        border-radius: 2px;
        box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
    }
    /*** side body**/
    .w-100 btn btn-lg btn-primary{
        background-color: #91C788 !important;
    }
    .signup-Anc{
        color: #91C788;
        text-decoration: none !important;
        outline: none;
    }
    .login-BTN{
        /* Sets width to 100% */
        width: 100%;

        /* Styles for button */
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

        /* Background and text color */
        color: #fff;
        background-color: #91C788;
        border: none;
        outline: none;
        margin-bottom: 50px !important;
        
    }
    button.login-BTN:focus {                /** Para change color ig click **/
        border: 2px solid #9acd32; 
        outline: none;
    }

    input.form-control:focus {
        outline: none !important;
        box-shadow: none;
        border-color: #9acd32;
    }
    h2.text-center mb-4{
        font-family: 'Quicksand' !important;
        font-weight: 100 !important;
    }

    h2{
        font-weight:400 !important;
        padding-bottom: 10px !important;
        color: #40513B !important;
    }
    .col-md-6{
        box-shadow: 0px 1px 16px rgba(0, 0, 0, 0.08) !important;
        padding: 40px !important;
        margin-left: 800px !important;
        margin-top: 20px;
    }
    span.error{
        padding: 15px;
        background-color: #f8d7da;
        color: #721c24;
    }
    .close-btn{
        border: none;
        color: red;
        margin-left: 2px;
        margin-right: -3px;
        background-color: #f8d7da;
        outline: none !important;
    }

</style>
</head>

<body>
    <!---header-->
    <div class="container-nav">
        <div class="nav-img">
            <img class="custom-logo-img" src="images/logo.png" alt="registerLogo">
        </div>
        
        <div class="nav-title">
            <span class="hayofind">HayoFind</span>
        </div>
        <div class="login-title">
                <span class="login">Admin Login</span>
        </div>
    </div>
    <div class="home-content">
        <span class="welcome">Welcome to HayoFind</span><br>
        <span class="platform">E-Commerce Website</span><br><br>
        <span class="desc">The <span class="hay">HayoFind</span> is a web application created by BROMS Technologies that provides<br> a convenient way in buying and selling livestock.
        It provides the users with the<br> options to look and choose their desired kind of livestock. </span><br><br>
    
        <img class="home-image" src="images/123.jpg" alt="login-logo" style="height: 364px; width: 860px;">
    </div>
    <!---end header-->

    <!--side body-->
    <div class="container mt-5 pt-5">
    <div class="col-md-6">
        <?php if (isset($error)): ?>
            <div class="error" style="float: left; margin-top: -90px; margin-left: 30px;">
                <span class="error"><?php echo $error; ?><button class="close-btn" onclick="this.parentNode.style.display='none'">x</button></span>
            </div>
        <?php endif; ?>
        <form class="p-4 p-md-5 rounded-3" id="cont-card" action="index.php" method="POST">
            <h2 class="text-center mb-4">Admin Log In</h2>

            <div class="mb-3">
                <label for="username_or_phone" class="form-label">Username</label>
                <input class="form-control" type="text" id="usernam" name="username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input class="form-control" type="password" id="password" name="password" required>
            </div>

            <button class="login-BTN" type="submit" name="submit">LOGIN</button>
        </form>
    </div>
    </div>


    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
</body>
</html>