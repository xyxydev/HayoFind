<?php
    // Connect to the database
    include_once("../connections/connect.php");

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

        /**$query = "UPDATE products SET item_Name='$name', item_Age='$age', item_Kind='$kind', item_Breed=' $breed', 
        item_Price=' $price' , item_Weight=' $weight' , item_Desc=' $desc' , item_Stock=' $stock'  WHERE item_ID='$id'  ";
        $query_run = mysqli_query($con, $query);**/

        $query = "UPDATE products p
              JOIN product_kind k ON p.item_ID = k.id
              SET p.item_Name = '$name', p.item_Age = '$age', k.item_Kind = '$kind', p.item_Breed = '$breed',
                  p.item_Price = '$price', p.item_Weight = '$weight', p.item_Desc = '$desc', p.item_Stock = '$stock'
              WHERE p.item_ID = '$id'";

        $query_run = mysqli_query($con, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:../merchantProducts.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>