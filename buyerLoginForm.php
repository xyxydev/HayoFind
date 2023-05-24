<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="buyer css/buyerloginForm.css">
    <link rel="shortcut icon" class="iconTab" href="cow.ico">
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
<body>
    <?php
        session_start();

        // Check if login form has been submitted
        if(isset($_POST['login'])) {

            include_once("connections/connect.php");
            $con = connection();

            // Get username and password from form data
            $username = $_POST['username'];
            $password = $_POST['password'];

            $hashedPassword = md5($password);

            // Query the database to verify user credentials
            $sql = "SELECT * FROM buyers WHERE (username='$username' OR phoneNumber='$username') AND password='$hashedPassword'";
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
                header("Location: index.php");
                exit();
            } else {
                // If the query returns no rows, the credentials are invalid
                $error = "Invalid username/phone number or password";
            }
        }
    ?>
    <?php
        require_once('loginHeader.php'); 
    
    ?>
    
    <div class="container mt-5 pt-5">
    <div class="col-md-6">
        <?php if (isset($error)): ?>
            <div class="error" style="float: left; margin-top: -90px; margin-left: 30px;">
                <span class="error"><?php echo $error; ?><button class="close-btn" onclick="this.parentNode.style.display='none'">x</button></span>
            </div>
        <?php endif; ?>
        <form class="p-4 p-md-5 rounded-3" id="cont-card" action="buyerLoginForm.php" method="POST">
            <h2 class="text-center mb-4">Login</h2>

            <div class="mb-3">
            <label for="username" class="form-label">Username/Phone number</label>
            <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="mb-3">
            <label for="password" class="form-label visually-hidden">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button class="login-BTN" type="submit" name="login">LOGIN</button>

            <div class="text-center mt-3">
            No account? <a href="buyerRegisterForm.php" class="signup-Anc">Register</a>
            </div>
        </form>

        </div>
    </div>


</body>
</html>