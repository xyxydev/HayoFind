<head>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<!---
 <button type=\"submit\" class=\"cart-btn\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                            <input type=\"hidden\" name=\"product_ID\" value=\"$productID\"> -->
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
                                <h5 class=\"pt-2\">$productname</h5>
                               
                                <h5 class=\"pt-2\">&#8369; $productprice</h5>
                                <button type=\"submit\" class=\"btn btn-danger mx-2 \" id=\"viewinfo-btn\" name=\"remove\">View Information</button>
                                <button type=\"submit\" class=\"btn btn-danger mx-2\"  id=\"remove-btn\" name=\"remove\">Remove</button>
                                
                            </div>

                            <div class=\"addminus-btn\">
                                <button class=\"quantity-button\" id=\"decrease-button\">-</button>
                                <input type=\"text\" id=\"quantity-input\" value=\"1\">
                                <button class=\"quantity-button\" id=\"increase-button\">+</button>
                            </div>
                            <hr>
                        </div>
                </form>
    
    ";
    echo  $element;
}
