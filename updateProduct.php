<?php
    // Connect to the database
    include_once("connections/connect.php");

    $con = connection();

    if(isset($_POST['updateData']))
    {   
        $id = $_POST['id'];
        $image = $_POST['image'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $kind = $_POST['kind'];
        $breed = $_POST['breed'];
        $price = $_POST['price'];
        $weight = $_POST['weight'];
        $desc = $_POST['desc'];
        $stock = $_POST['stock'];

        $query = "UPDATE products SET item_Name='$name', item_Age='$age', item_Kind='$kind', item_Breed=' $breed', 
        item_Price=' $price' , item_Weight=' $weight' , item_Desc=' $desc' , item_Stock=' $stock'  WHERE item_ID='$id'  ";
        $query_run = mysqli_query($con, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:merchantProducts.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>