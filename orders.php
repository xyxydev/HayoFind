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
    ?>
    <?php 
         require_once('indexHeader.php'); 
    ?>

    <div class="container py-5">
		<div class="row">
			<div class="col-md-4">
				<h4>Billing Information</h4>
				<form>
					<div class="mb-3">
						<label for="name" class="form-label">Full Name</label>
						<input type="text" class="form-control" id="name" required>
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="email" class="form-control" id="email" required>
					</div>
					<div class="mb-3">
						<label for="address" class="form-label">Address</label>
						<input type="text" class="form-control" id="address" required>
					</div>
					<div class="mb-3">
						<label for="city" class="form-label">City</label>
						<input type="text" class="form-control" id="city" required>
					</div>
					<div class="mb-3">
						<label for="state" class="form-label">State</label>
						<input type="text" class="form-control" id="state" required>
					</div>
					<div class="mb-3">
						<label for="zip" class="form-label">Zip Code</label>
						<input type="text" class="form-control" id="zip" required>
					</div>
				</form>
			</div>
			<div class="col-md-8">
				<h4>Order Summary</h4>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Item</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Product 1</td>
							<td>$10</td>
							<td>1</td>
							<td>$10</td>
						</tr>
						<tr>
							<td>Product 2</td>
							<td>$20</td>
							<td>2</td>
							<td>$40</td>
						</tr>
						<tr>
							<td colspan="3" class="text-end">Subtotal</td>
							<td>$50</td>
						</tr>
						<tr>
							<td colspan="3" class="text-end">Tax</td>
							<td>$5</td>
						</tr>
						<tr>
                        <td colspan="3" class="text-end">Total</td>
							<td>$55</td>
						</tr>
					</tbody>
				</table>
				<h4>Payment Information</h4>
				<form>
					<div class="mb-3">
						<label for="card" class="form-label">Card Number</label>
						<input type="text" class="form-control" id="card" required>
					</div>
					<div class="mb-3">
						<label for="expiry" class="form-label">Expiration Date</label>
						<input type="text" class="form-control" id="expiry" required>
					</div>
					<div class="mb-3">
						<label for="cvv" class="form-label">CVV</label>
						<input type="text" class="form-control" id="cvv" required>
					</div>
				</form>
				<button type="submit" class="btn btn-primary">Place Order</button>
			</div>
		</div>
	</div>



</body>

</html>