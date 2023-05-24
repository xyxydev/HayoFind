<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="seller/seller css/addnewproductPage.css">
    <link rel="shortcut icon" class="iconTab" href="seller/seller images/cow.ico">
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
    if (isset($_POST['submit'])) {

        // Set the target directory for the file upload
        $target_dir = "uploads/";

        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            //echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }

        // Get the path of the uploaded file
        $img_path = $target_dir . $_FILES['image']['name'];

        // Get the input values from the form
        $img = $_FILES['image']['name'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $breed = $_POST['breed'];
        $price = $_POST['price'];
        $weight = $_POST['weight'];
        $desc = $_POST['desc'];
        $stock = $_POST['stock'];

        $sql = "INSERT INTO products (merchantsID_fk, item_IMG, item_Name, item_Age,item_Breed, item_Price, item_Weight, item_Desc, item_Stock) 
                VALUES ('$user_id', '$img_path', '$name', '$age', '$breed', '$price', '$weight', '$desc', '$stock')";

        // Execute the INSERT statement
        if (mysqli_query($con, $sql)) {
            //echo "New record created successfully";

            // Get the last inserted ID from the products table
            $item_id = mysqli_insert_id($con);

            // Get the item_kind value
            $item_kind = $_POST['kind'];

            // Insert the item_kind into the product_kind table
            $sql_insert_kind = "INSERT INTO product_kind (id, item_Kind) VALUES ('$item_id', '$item_kind')";

            // Execute the INSERT statement for product_kind table
            if (mysqli_query($con, $sql_insert_kind)) {
                //echo "Item kind inserted successfully";
                $message = "Product added successfully.";
            } else {
                echo "Error: " . $sql_insert_kind . "<br>" . mysqli_error($con);
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }

        // Close the database connection
        mysqli_close($con);
    }
    ?>

    <?php
        $addnewproduct = true;
        require_once('addnewproductPage/sellerHeader.php'); 
    
    ?>
 
<div class="container">
<div class="table-title">
        <h2><i class="fas fa-plus-circle"  style="color:#5cb85c;"></i> Add Products</h2>
    </div>
    <?php if (isset($message)): ?>
      <div class="error" style="position: absolute; margin-top: -5px; margin-left: 460px;  z-index: 999;">
          <span class="error"><?php echo $message; ?></span>
      </div>
      <script>
        setTimeout(function() {
            var errorDiv = document.querySelector('.error');
            errorDiv.style.display = 'none';
        }, 2000); // 2 seconds in milliseconds
    </script>
  <?php endif; ?>
  <div class="col-md-11 offset-md-1">
    <form class="p-4 p-md-5 rounded-3" action="addnewproductPage.php" method="POST" enctype="multipart/form-data">
      <img src="#" id="preview" alt="Preview Image" style="display:none; width:180px; height:150px; margin-left: 355px; margin-bottom: 20px;">

      <div class="row g-2 mb-3">

      <div class="col-md-6">
  <label for="image" class="form-label">Item image</label>
  <div class="input-group">
    <input  type="file" name="image" id="file-upload" onchange="previewImage()">
    <label class="input-group-text d-none" for="file-upload">Choose file</label>
  </div>
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
          <select class="form-control" id="kind" name="kind" required>
            <option value="Horse">Horse</option>
            <option value="Cattle">Cattle</option>
            <option value="Cow">Cow</option>
            <option value="Sheep">Sheep</option>
            <option value="Pig">Pig</option>
            <option value="Chicken">Chicken</option>
          </select>
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
