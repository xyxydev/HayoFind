<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/addnewproductPage.css">
    <link rel="shortcut icon" class="iconTab" href="images/cow.ico">
    <!----FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="script.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
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
            <li><a class="addnewproduct-anc" href="addnewproductPage.html">Add New Product</a></li>
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

    <div class="formBox">
        <form action="addnewproductPage.php" method="POST" enctype="multipart/form-data">
            <div class="add-span">
                <span>ADD NEW PRODUCT</span><br>
            </div>
            <!--<hr width="513px" color="black" size="1">-->
            <img src="#" id="preview" alt="Preview Image" style="display:none; width:180px; height:150px;">
            <input class="file-input" type="file" name="image" id="file-upload" onchange="previewImage()"><br>

            <input class="itemName-input" type="text" id="name" name="name" placeholder="Item name" required>

            <input class="age-input" type="text" id="age" name="age" placeholder="Age" required><br>
    
            <input class="kind-input" type="text" id="kind" name="kind" placeholder="Kind" required>
    
            <input class="breed-input" type="text" id="breed" name="breed" placeholder="Breed" required><br>
    
            <input class="price-input" type="text" id="price" name="price" placeholder="Price" required>
            
            <input class="weight-input" type="text" id="weight" name="weight" placeholder="Weight" required><br>

            <input class="desc-input" type="text" id="desc" name="desc" placeholder="Description" required><br>
            
            <input class="stock-input" type="text" id="stock" name="stock" placeholder="Stock" required>
            
            <button class="add-btn" type="submit" name="submit">ADD</button>
            <input class="clear-btn" type="submit" value="CLEAR">
        </form>
    </div>
</body>
</html>
<?php
        include_once("connections/connect.php");

        $con = connection();

        session_start();
        $user_id = $_SESSION['user_id'];
        if(isset($_POST['submit'])) {


            // Set the target directory for the file upload
            $target_dir = "customerSIDE/uploads/";

            $target_file = $target_dir . basename($_FILES["image"]["name"]);

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }

            // Get the path of the uploaded file
            $img_path = $target_dir . $_FILES['image']['name'];
            

            // Get the input values from the form 
            $img = $_FILES['image']['name'];
            $name = $_POST['name'];
            $age = $_POST['age'];
            $kind = $_POST['kind'];
            $breed = $_POST['breed'];
            $price = $_POST['price'];
            $weight = $_POST['weight'];
            $desc = $_POST['desc'];
            $stock = $_POST['stock'];
            
                    
            $sql = "INSERT INTO products (merchantsID_fk, item_IMG, item_Name, item_Age, item_Kind, item_Breed, item_Price, item_Weight, item_Desc, item_Stock) 
                VALUES ('$user_id', '$img_path', '$name', '$age', '$kind', '$breed', '$price', '$weight', '$desc', '$stock')";
        
                    
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