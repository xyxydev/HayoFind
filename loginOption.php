<!DOCTYPE html>
 <html lang="en">
 <head>
    <link rel="stylesheet" type="text/css" href="css/loginOption.css">
	<link rel="shortcut icon" class="iconTab" href="images/cow.ico">
	<!----FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">
	
	<link rel="icon" href="icon.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
 </head>
 <body>
    <?php
        require_once('loginHeader.php'); 
    
    ?>

	<div class="optionBox">
		<div class="insideOptionBox">
			<img src="images/logo.png" alt="registerLogo"><br>
			<p class="login-p">Login as</p>
			<a href="buyerLoginForm.php" class="cust-btn">Customer</a><br>
			<p class="or-p">or</p>
			<a href="merchantLoginForm.php" class="merc-btn">Merchant</a><br><br><br>
			<span class="noAcc-span">No account? <a href="registerOption.html" class="signup-Anc">Register</a></span>
		</div>
	</div>
    
 </body>
 </html>