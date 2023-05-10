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

        session_start();
        @$user_id = $_SESSION['user_id'];
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
    <?php
        $addnewproduct = true;
        require_once('sellerHeader.php'); 
    
    ?>

<div class="container">
  <div class="col-md-11 offset-md-1">
    <form class="p-4 p-md-5 rounded-3" action="addnewproductPage.php" method="POST" enctype="multipart/form-data">
      <h2 class="text-center mb-4">ADD PRODUCT</h2>
      <img src="#" id="preview" alt="Preview Image" style="display:none; width:180px; height:150px; margin-left: 355px; margin-bottom: 20px;">

      <div class="row g-2 mb-3">
        <div class="col-md-6">
          <label for="image" class="form-label">Item image</label>
          <input class="form-control image-input" type="file" name="image" id="file-upload" onchange="previewImage()">
        </div>
        <div class="col-md-6">
          <label for="name" class="form-label">Item name</label>
          <input class="form-control" type="text" id="name" name="name" required>
        </div>
      </div>

      <div class="row g-3 mb-3">
        <div class="col">
          <label for="age" class="form-label">Age</label>  
          <input class="form-control" type="text" id="age" name="age" required>
        </div>
        <div class="col">
          <label for="kind" class="form-label">Kind</label>
          <input class="form-control" type="text" id="kind" name="kind" required>
        </div>

        <div class="col">
          <label for="breed" class="form-label">Breed</label>
          <input class="form-control" type="text" id="breed" name="breed" required>
        </div>
      </div>

      <div class="row g-3 mb-3">
        <div class="col">
          <label for="price" class="form-label">Price</label>
          <input class="form-control" type="text" id="price" name="price" required>
        </div>
        <div class="col">
          <label for="weight" class="form-label">Weight</label>
          <input class="form-control" type="text" id="weight" name="weight" prequired>
        </div>
        <div class="col">
          <label for="stock" class="form-label">Stock</label>
          <input class="form-control" type="text" id="stock" name="stock" required>
        </div>
      </div>
      <div class="mb-3 mb-3">
        <label for="desc" class="form-label">Description</label>
        <input class="form-control" type="text" id="desc" name="desc" required>
      </div>

      <div class="d-grid gap-2">
        <button class="add-BTN" type="submit" name="submit">ADD</button>
      </div>
      <div class="d-grid gap-2 mt-3">
        <input class="clear-BTN" type="submit" value="CLEAR">
      </div>
      
    </form>
  </div>
</div>

</body>
</html>
