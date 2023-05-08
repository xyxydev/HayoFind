<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/merchantLoginForm.css">
    <link rel="shortcut icon" class="iconTab" href="images/cow.ico">
    <!----FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Login Form</title>
</head>
<body>
    <?php
        session_start();

        // Check if login form has been submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            include_once("connections/connect.php");
            $con = connection();

            // Get username and password from form data
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Query the database to verify user credentials
            $sql = "SELECT * FROM merchants WHERE username='$username' AND password='$password'";
            $result = $con->query($sql);

            // If the query returns a row, the credentials are valid
            if ($result->num_rows > 0) {
                // Set session variable to indicate that the user is logged in
                $_SESSION['loggedin'] = true;

                $row = $result->fetch_assoc();
                $_SESSION['user_id'] = $row['id'];//to get the merchant user id
                $_SESSION['firstname'] = $row['fname'];
                $_SESSION['lastname'] = $row['lname'];

                // Redirect to the homepage
                header("Location: merchantPage.php");
                exit();
            } else {
                // If the query returns no rows, the credentials are invalid
                $error = "Invalid username or password";
            }
        }
    ?>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>

    <div class="loginBox">
        <form class="loginForm" action="merchantLoginForm.php" method="POST">
            <div class="login-span">
                <span>Merchant Log In</span><br>
            </div>
            <hr width="398px" color="black" size="1">
            <input class="username-input" type="text" id="username" name="username" placeholder="Username/Email" required><br>
            <input class="password-input" type="password" id="password" name="password" placeholder="Password" required><br>
            <input class="submit-input" type="submit" value="LOGIN"><br><br>

            <!--<div class="or-span">
                <span>OR</span>
            </div><br>

            <div class="googleContainer">
                <img src="googlelogo.png" alt="registerLogo">
                <p class="google-p">Google</p>
            </div> Libog pag design, need google api pod------>
            <span class="noAcc-span">No account? <a href="registerOption.html" class="signup-Anc">Register</a></span>
        </form>
    </div>
</body>
</html>