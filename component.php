<head>
    <link rel="shortcut icon" class="iconTab" href="buyer images/cow.ico">
    <link rel="stylesheet" href="buyer css/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                    <div class=\"clickable-card\" data-product-id=\"$productID\"> <!-- Added data-product-id attribute -->
                        <h5 class=\"card-title\">$productname</h5>
                        <h6>
                        <i class=\"fas fa-star\" id=\"star-icon\"></i>
                        <i class=\"fas fa-star\" id=\"star-icon\"></i>
                        <i class=\"fas fa-star\" id=\"star-icon\"></i>
                        <i class=\"fas fa-star\" id=\"star-icon\"></i>
                        <i class=\"far fa-star\" id=\"star-icon\"></i>
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
                        <div class=\"form-group\">
                            <input type=\"number\" class=\"form-control\" id=\"qty\" name=\"qty\" min=\"1\" value=\"1\" hidden>
                        </div>
                    </div>
                    <button type=\"submit\" class=\"cart-btn\" name=\"add\"";
                    if(!isset($_SESSION['user_id'])) { // check if session id is not set
                        $element .= " onclick=\"location.href='buyerLoginForm.php'; return false;\""; // redirect to login page
                    }
                    $element .= ">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                    <input type=\"hidden\" name=\"product_ID\" value=\"$productID\">
                    </form>
                    <form id=\"myForm\" method=\"post\" action=\"_viewInformation.php\">
                            <input type=\"hidden\" name=\"product_ID\" value=\"$productID\">
                            <button type=\"submit\" class=\"viewinfo-btn\" name=\"view\" onclick=\"redirectToOtherPage()\">View</button>
                        </form>
                </div>
            </div>
       
        
    </div>
    ";
    echo $element;
}
?>
<script>
    function redirectToOtherPage() {
        // Redirect to another page
        window.location.href = "_viewInformation.php";
    }
</script>

