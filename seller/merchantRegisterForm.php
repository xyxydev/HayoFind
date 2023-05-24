<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="seller css/merchantRegisterForm.css">
    <link rel="shortcut icon" class="iconTab" href="seller images/cow.ico">
    <!----FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.1/css/bootstrap.min.css">
     <!-- Bootstrap CDN -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- JavaScript (optional) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    
<?php
    include_once("connections/connect.php");

    $con = connection();

    if(isset($_POST['register'])) {
        // Get the input values from the form
        $firstName = $_POST['fname'];
        $lastName = $_POST['lname'];
        $phoneNumber = $_POST['pNumber'];
        $password = $_POST['password']; 
        $hashedPassword = md5($password); // Hash the password using MD5

        // Construct the SQL INSERT statement for the buyers table
       $sql = "INSERT INTO merchants (fname, lname, phoneNumber, password) 
                VALUES ('$firstName', '$lastName', '$phoneNumber', '$hashedPassword')";

        // Execute the INSERT statement for the buyers table
        if (mysqli_query($con, $sql)) {
            // Get the buyer ID of the inserted buyer
            $seller_ID = mysqli_insert_id($con);

            // Get the verification status
            $verification_status = $_POST['verify'];

            // Construct the SQL INSERT statement for the buyer_verification table
            $verificationSql = "INSERT INTO merchant_verification (seller_ID, verification_status) 
                                VALUES ('$seller_ID', '$verification_status')";

            // Execute the INSERT statement for the buyer_verification table
            if (mysqli_query($con, $verificationSql)) {
                $message = "You are successfully registered!";
            } else {
                echo "Error: " . $verificationSql . "<br>" . mysqli_error($con);
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }

        // Close the database connection
        mysqli_close($con);
    }
?>


    <?php
        $register = true;
        $merchantReg = true;
        require_once('loginHeader.php'); 
    
    ?>


    <div class="container mt-5 pt-5">
        <div class="col-md-6">
            <?php if (isset($message)): ?>
                <div class="error" style="float: left; margin-top: -50px; margin-left: 120px;">
                    <span class="error"><?php echo $message; ?><button class="close-btn" onclick="this.parentNode.style.display='none'">x</button></span>
                </div>
            <?php endif; ?>
        <form class="p-4 p-md-5 rounded-3" id="cont-card" action="merchantRegisterForm.php" method="POST">
            <h2 class="text-center mb-4">Merchant Register</h2>

            <div class="mb-3">
            <label for="fname" class="form-label">First name</label>
            <input type="text" class="form-control" id="fname" name="fname" required>   
            </div>

            <div class="mb-3">
            <label for="lname" class="form-label">Last name</label>
            <input type="text" class="form-control" id="lname" name="lname" required>     
            </div>

            <div class="mb-3">
            <label for="pNumber" class="form-label">Phone number</label>
            <input type="tel" class="form-control" id="pNumber" name="pNumber" required>   
            </div>
    
            <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            </div>
            
            <?php 
                define('VERIFY', "Not verified");
                $verification_status = VERIFY;
            ?>
            <input type="hidden" name="verify" value="<?php echo $verification_status; ?>">
            <button class="register-BTN" type="submit" name="register">REGISTER</button>

            <div class="text-center mt-3">
                <p class="p-term" >By signing up, you agree to HayoFind’s <a href="#" class="term-a">Terms of Service</a> & <a href="#" class="priv-a">Privacy Policy</a></p>
                <p>Already have an account? <a href="merchantLoginForm.php" class="login-Anc">Log In</a></p>
            </div>
        </form>

        </div>
    </div>
</body>
</html>