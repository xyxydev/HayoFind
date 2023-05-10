<!DOCTYPE html>
<html lang="en">
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
    <link rel="stylesheet" href="customerProfile.css">
    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>
<body>


    <?php
    session_start();

    include_once("connections/connect.php");
    $con = connection();

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        // Handle the case where the user ID is not set
        $error = "No user";
    }

     
        require_once('indexHeader.php'); 
        $sql = "SELECT * FROM buyers WHERE id = $user_id"; // Change "1" to the ID of the user you want to retrieve data for
        $result = $con->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $fname = $row["fname"];
            $lname = $row["lname"];
            $email = $row["email"];
            $phoneNumber = $row["phoneNumber"];
            $gender = $row["gender"];
            $username = $row["username"];
            $id = $row["id"];
            $password = $row["password"];
            $dob = $row["dob"];
            $address = $row["address"];
            $valid_ID = $row["valid_ID"];
            $image = $row["image"];
        }
    ?>
    <div class="myaccount-cont">
    <div class="container">
    <div class="row gutters">
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
    <div class="card h-100">
        <div class="card-body">
            <div class="account-settings">
                
                <form method="POST" enctype="multipart/form-data">
                    <div class="about">
                        <h5><label class="avatar-label" for="avatar" id="profile-h5">Profile</label></h5>
                    </div>
                    
                

                <div class="user-profile">
                    <div class="user-avatar">
                        <img src="<?php echo $image ?>" alt="profile">
                    </div>
                    <h5 class="user-name"><?php echo $fname. ' '.$lname; ?></h5>
                    <h6 class="user-email"><?php echo $email; ?></h6>
                    <input class=avatar-input" type="file" name="avatar" id="avatar">
                </div>

                <div class="about">
                    <h5><label class="valid_id-label" for="valid_ID" id="valid-h5">Valid ID</label></h5>
                    <input class="valid_id-input" type="file" name="valid_ID" id="valid_ID">
                    <p class="uploaded"><span class="uf">Uploaded file:</span><br> <?php echo $valid_ID; ?></p>
                </div>
                <button class="btn btn-primary" type="submit" id="submit-img">Submit</button>
                </form>
                <!--
                <div class="about">
                    <h5>Bio</h5>
                    <p>I'm Yuki. Full Stack Designer I enjoy creating user-centric, delightful and human experiences.</p>
                </div>
                -->

                <?php
                    // Check if form is submitted
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        // Handle file upload

                        $target_dir = "customerSIDE/uploads/"; // Directory to save uploaded files

                        $target_file = $target_dir . basename($_FILES["avatar"]["name"]); // Get the file name
                        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                            // File uploaded successfully, insert file path into database

                            include_once("connections/connect.php");
                            $con = connection();

                            $file_path = mysqli_real_escape_string($con, $target_file);

                            $sql = "UPDATE buyers SET image='$file_path'  WHERE id='$user_id'";
                            mysqli_query($con, $sql);
                            mysqli_close($con);
                        } else {
                            // Error uploading file
                           
                        }

                        // Handle valid ID upload
                        $target_dir1 = "customerSIDE/uploads/"; // Directory to save uploaded files
                        $target_file1 = $target_dir1 . basename($_FILES["valid_ID"]["name"]); // Get the file name
                        if (move_uploaded_file($_FILES["valid_ID"]["tmp_name"], $target_file1)) {
                            // File uploaded successfully, insert file path into database

                            include_once("connections/connect.php");
                            $con = connection();

                            $file_path1 = mysqli_real_escape_string($con, $target_file1);

                            $sql = "UPDATE buyers SET valid_ID='$file_path1'  WHERE id='$user_id'";
                            mysqli_query($con, $sql);
                            mysqli_close($con);
                        } else {
                            // Error uploading file
                            
                        }
                    }
                ?>

            </div>
        </div>
    </div>
    </div>
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
    <div class="card h-100">
        <div class="card-body">
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mb-2 text-primary" id="personal-h6">Personal Details</h6>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="fname">First name</label>
                        <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $fname; ?>"  readonly required>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="lname">Last name</label>
                        <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $lname; ?>" readonly required>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" readonly required>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="phone">Phone number</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo $phoneNumber; ?>"  readonly required>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <input type="text" class="form-control" id="gender" name="gender" value="<?php echo $gender; ?>" readonly >
                    </div>
                </div>
                <!--
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="gender-label" for="gender">Gender</label>
                        <select class="gender-select form-control" id="choice" name="choice">
                            <option class="gender-input" value="Male">Male</option>
                            <option class="gender-input" value="Female">Female</option>
                        </select>
                    </div>
                </div>
                -->
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="dob">Date of birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $dob; ?>"  readonly >
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" readonly >
                    </div>
                </div>
            </div>
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mt-3 mb-2 text-primary" id="account-h6">Account Details</h6>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" readonly required>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" id="password" name="password" value="<?php echo $password; ?>"  readonly required disabled>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                        <label for="cust_ID">Customer ID</label>
                        <input type="text" class="form-control" id="cust_ID" name="cust_ID" value="<?php echo $id; ?>"  readonly required disabled>
                    </div>
                </div>
            </div>
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary" id="saveButton" name="saveData">Save</button> 
                        <button type="submit" class="btn btn-secondary" id="editButton" name="edit">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>




    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>

    <script>
        // Get the input fields
        const inputFields = document.querySelectorAll('input[type="text"], input[type="date"], input[type="file"], input[type="radio"]');

        // Get the edit button
        const editButton = document.querySelector('#editButton');

        // Get the save button
        const saveButton = document.querySelector('#saveButton');

        // Add event listener to the edit button
        editButton.addEventListener('click', (event) => {
        event.preventDefault();
        // Loop through the input fields and remove the "readonly" attribute
        inputFields.forEach(input => {
            input.removeAttribute('readonly');
        });
        });

        saveButton.addEventListener('click', (event) => {
        event.preventDefault();

        // Disable the input fields by adding the "readonly" attribute
        inputFields.forEach(input => {
            input.setAttribute('readonly', 'readonly');
        });

        // Loop through the input fields and save the new values to a FormData object
        const formData = new FormData();
        inputFields.forEach(input => {
            formData.append(input.name, input.value);
        });

        // Use AJAX to send the FormData object to the PHP script that will update the database
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'updateBuyerProfile.php');
        xhr.send(formData);
        });
    </script>
    

</body>
</html>


