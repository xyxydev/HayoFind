<head>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<?php
function component($productname, $productprice, $productImage, $productKind, $productWeight, $productID){
    $element = "
    
    <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
                <form action=\"index.php\" method=\"post\" class=\"form-card\">
                    <div class=\"card shadow\">
                        <div class=\"imgDiv\">
                            <img src=\"$productImage\" alt=\"Image1\" class=\"img-fluid card-img-top\" style=\"height: 200px; width: 100%;\">
                        </div>
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$productname</h5>
                            <h6>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"far fa-star\"></i>
                            </h6>
                            <div class=\"div-price\">
                                <span class=\"span-priceIN\">Price: </span>  <span class=\"span-price\">&#8369; $productprice </span><br>
                            </div>

                            <div class=\"div-kind\">
                                <span class=\"span-kindIN\">Kind: </span> <span class=\"span-kind\"> $productKind </span><br>
                            </div>

                            <div class=\"div-weight\">
                                <span class=\"span-weightIN\">Weight: </span> <span class=\"span-weight\"> $productWeight kg </span><br>
                            </div>
                                
        

                            <button type=\"submit\" class=\"cart-btn\" name=\"add\"";
                            if(!isset($_SESSION['user_id'])) { // check if session id is not set
                                $element .= " onclick=\"location.href='buyerLoginForm.php'; return false;\""; // redirect to login page
                            }
                            $element .= ">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                            <input type=\"hidden\" name=\"product_ID\" value=\"$productID\">
                             
                        </div>
                    </div>
                </form>
    </div>
    ";
    echo $element;
}

function cartElement($productImage, $productname, $productprice, $productID){
    $element = "
    
    <form action=\"cart.php?action=remove&id=$productID\" method=\"post\" class=\"cart-items\">
                        <div class=\"cart-card\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=\"$productImage\" alt=\"Image1\" class=\"img-fluid\" style=\"height: 140px; width: 75%;\">
                            </div>

                            <div class=\"infoCartDiv\">
                                <h6 class=\"pt-2\">Seller Testing: $productname</h6>
                                <h5 class=\"pt-2\">$productname</h5>
                               
                                <h5 class=\"pt-2\">&#8369; $productprice</h5>
                                <button type=\"submit\" class=\"btn btn-danger mx-2 \" id=\"viewinfo-btn\" name=\"remove\">View Information</button>
                                <button type=\"submit\" class=\"btn btn-danger mx-2\"  id=\"remove-btn\" name=\"remove\">Remove</button>
                                
                            </div>
                            </form>

                            <form method=\"POST\" action=\"\">
                                <div class=\"quantity-btn\">
                                    <label for=\"quantity-input\" class=\"quantity-label\">Quantity</label>
                                    <div class=\"input-group\">
                                        <input type=\"number\" id=\"quantity-input\" name=\"quantity-input\" class=\"form-control\" min=\"0\" max=\"10\">
                                    </div>
                                
                                <button type=\"submit\" name=\"Apply\" class=\"apply-btn\">Apply</button>
                                <button type=\"submit\" name=\"Change\" class=\"change-btn\">Change</button>
                                </div>
                                
                            </form>


                            <hr>
                        </div>
                
    
    ";
    echo  $element;
}

$con = connection();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["Apply"])) {
        // Insert the quantity into the database
        $quantity = $_POST["quantity-input"];

        $sql = "INSERT INTO cart (quantity) VALUES ($quantity)";
        if ($con->query($sql) === TRUE) {
            echo "Quantity inserted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    } elseif (isset($_POST["Change"])) {
        // Update the quantity in the database
        $quantity = $_POST["quantity-input"];

        $sql = "UPDATE cart SET quantity = $quantity WHERE cart_ID = $cart_ID";  // Replace "id = 1" with the appropriate condition for your table
        if ($con->query($sql) === TRUE) {
            echo "Quantity updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }
}
?>

