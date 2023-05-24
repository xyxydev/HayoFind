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

    <link rel="shortcut icon" class="iconTab" href="cow.ico">
    <link rel="stylesheet" href="buyer css/index.css">
    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!--- --->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Include the Bootstrap bundle (includes Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>


<body>
    <?php
        session_start();
        @$user_id = $_SESSION['user_id'];
        include_once("connections/connect.php");
        require_once('component.php'); 
        $con = connection();
        
        // Add to cart logic
        if (isset($_POST['add'])) {
            $productID = $_POST['product_ID'];
            $quantity = $_POST['qty']; // retrieve the quantity value from the form input

            // Check if the product is already in the cart
            $sql = "SELECT * FROM cart WHERE buyer_id = '$user_id' AND product_ID = '$productID'";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo '<div class="alert alert-warning fixed-top" id="warning-message" role="alert" style="z-index: 9999; background-color: #d4edda !important;
                color: #155724 !important;">Already added in the cart.</div>';
                
            } else {
                echo '<div class="alert alert-warning fixed-top" id="warning-message" role="alert" style="z-index: 9999; background-color: #d4edda !important;
                color: #155724 !important;">Added in the cart.</div>';
                // Insert the product into the cart table
                $query = "SELECT merchantsID_fk, item_IMG, item_Name, item_Price FROM products WHERE item_ID = $productID";
                $result = $con->query($query);
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    $merchantID = $row['merchantsID_fk'];
                    $item_IMG = $row['item_IMG'];
                    $item_Name = $row['item_Name'];
                    $item_Price = $row['item_Price'];
                }

                $que = "SELECT fname, lname FROM merchants WHERE id = $merchantID";
                $res = $con->query($que);
                if ($res && $res->num_rows > 0) {
                    $row = $res->fetch_assoc();

                    $seller_Name = $row['fname']. $row['lname'];
                }

                $dateAdd = date('Y-m-d H:i:s'); // Get the current date and time
                $sql = "INSERT INTO cart (seller_ID, buyer_ID, product_ID, quantity, dateAdd) VALUES ('$merchantID', '$user_id', '$productID', '$quantity', '$dateAdd')";
                mysqli_query($con, $sql);
            }
        }

    ?>

    <?php
    require_once('indexHeader.php');

    // Check if a search term is provided
    if (isset($_GET['search'])) {
        $searchTerm = $_GET['search'];
        // Retrieve products from the database based on the search term
        //$sql = "SELECT * FROM products WHERE item_Name LIKE '%$searchTerm%'";
        $sql = "SELECT p.*, k.item_Kind
        FROM products p
        JOIN product_kind k ON p.item_ID = k.id
        WHERE p.item_Name LIKE '%$searchTerm%'";


    } else if (isset($_GET['kind'])) {
        $selectedKind = $_GET['kind'];
        // Retrieve products from the database based on the selected kind
        //$sql = "SELECT * FROM products WHERE item_Kind = '$selectedKind'";
        $sql = "SELECT p.*, k.item_Kind
        FROM products p
        JOIN product_kind k ON p.item_ID = k.id
        WHERE k.item_Kind = '$selectedKind'";

    } else {
        // If no search term or kind is provided, retrieve all products
        //$sql = "SELECT * FROM products";

        //products table join with product_kind
        $sql = "SELECT p.*, k.item_Kind
        FROM products p
        JOIN product_kind k ON p.item_ID = k.id";
    }

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<div class="container" id="containerList">';
        echo '<div class="row text-center py-5">';
        while ($row = mysqli_fetch_assoc($result)) {
            component($row['item_Name'], $row['item_Price'], $row['item_IMG'], $row['item_Kind'], $row['item_Weight'], $row['item_ID']);
        }
        echo '</div>';
        echo '</div>';
    } else {
        echo "0 results";
    }
    ?>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle li click event
            $('li').click(function() {
                var selectedKind = $(this).text().trim();
                // Redirect to index.php with selected kind as a parameter
                window.location.href = 'index.php?kind=' + selectedKind;
            });
        });
    </script>

    <script>
        setTimeout(function(){
            var warningMessage = document.getElementById("warning-message");
            if (warningMessage) {
                warningMessage.style.display = "none";
            }
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

