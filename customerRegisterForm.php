<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/customerRegisterForm.css">
    <link rel="shortcut icon" class="iconTab" href="images/cow.ico">
    <!----FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration Form</title>
</head>
<body>
    <?php
        include_once("connections/connect.php");

        $con = connection();

        if(isset($_POST['submit'])) {
            // Get the input values from the form
            $firstName = $_POST['fname'];
            $lastName = $_POST['lname'];
            $phoneNumber = $_POST['pNumber'];
            $password = $_POST['password'];
            
            
            
            // Construct the SQL INSERT statement
            $sql = "INSERT INTO customers (fname, lname, phoneNumber, password) 
                    VALUES ('$firstName', '$lastName', '$phoneNumber', '$password')";
            
            // Execute the INSERT statement
            if (mysqli_query($con, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
            
            // Close the database connection
            mysqli_close($con);
        }
    ?>
    <div class="formBox">
        <form action="customerRegisterForm.php" method="POST">
            <div class="reg-span">
                <span>Register</span><br>
            </div>
            <hr width="513px" color="black" size="1">
            <input class="fname-input" type="text" id="name" name="fname" placeholder="First name" required>

            <input class="lname-input" type="text" id="name" name="lname" placeholder="Last name" required><br>
    
            <input class="pNumber-input" type="tel" id="pNumber" name="pNumber" placeholder="Phone number" required><br>
    
            <input class="pass-input" type="password" id="password" name="password" placeholder="Password" required><br>
    
            <input class="confirmPass-input" type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password" required><br>
            
            <button class="submit-btn" type="submit" name="submit">REGISTER</button>
            <div class="terms-p">
                <p>By signing up, you agree to HayoFind’s Terms of Service <br>& Privacy Policy</p>
            </div>
            <div class="haveAcc-p">
                <p>Already have an account? <a href="loginOption.html" class="login-Anc">Log In</a></p>
            </div>
        </form>
    </div>
</body>
</html>