<?php 
    include_once("connections/connect.php");

    $con = connection();
    session_start();
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM products WHERE $user_id = merchantsID_fk";

    $result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>
    <link rel="shortcut icon" class="iconTab" href="images/cow.ico">
    <link rel="stylesheet" href="css/merchantProducts.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="test.js"></script>

</head>
  
<body>
  <div class="navbarBox">
        <div class="logoName">
            <img class="custom-logo-img" src="images/logo.png" alt="registerLogo">
        </div>
        <div class="hayofind-div">
            <span class="hayofind">HayoFind</span>
        </div>
        
        <ul>
            <li><a class="home-anc" href="merchantPage.php">Home</a></li>
            <li><a class="myproducts-anc" href="merchantPage.php">My Products</a></li>
            <li><a class="addnewproduct-anc" href="addnewproductPage.php">Add New Product</a></li>
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
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage Products</h2>
					</div>
					<div class="col-sm-6">
						<a href="addnewproductPage.php" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Add Product</span></a>
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="th_head">ID</th>
                        <th class="th_head">Image</th>
                        <th class="th_head">Name</th>
                        <th class="th_head">Age</th>
                        <th class="th_head">Kind</th>
                        <th class="th_head">Breed</th>
                        <th class="th_head">Price(&#8369)</th>
                        <th class="th_head">Weight(kg)</th>
                        <th class="th_head">Description</th>
                        <th class="th_head">Stock</th>
                        <th class="th_head">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td class="td_data"><?php echo $row['item_ID']; ?></td>
                            <td class="td_data"><?php echo substr(basename($row['item_IMG']), 0, 10); ?></td>
                            <td class="td_data"><?php echo $row['item_Name']; ?></td>
                            <td class="td_data"><?php echo $row['item_Age']; ?></td>
                            <td class="td_data"><?php echo $row['item_Kind']; ?></td>
                            <td class="td_data"><?php echo $row['item_Breed']; ?></td>
                            <td class="td_data"><?php echo $row['item_Price']; ?></td>
                            <td class="td_data"><?php echo $row['item_Weight']; ?></td>
                            <td class="td_data"><p><?php echo $row['item_Desc']; ?></p></td>
                            <td class="td_data"><?php echo $row['item_Stock']; ?></td>
                            <td>
                                <a href="#editProductModal" class="edit" data-toggle="modal" data-id="<?php echo $row['item_ID']; ?>"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                <a href="#deleteProductModal" class="delete" data-toggle="modal" data-id="<?php echo $row['item_ID']; ?>"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                                
                            </td>
                        </tr>
                <?php       }
                    }
                ?>     
                </tbody>

            </table>
            <!-- DELETE PRODUCT MODAL -->
            <div id="deleteProductModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Confirm Deletion</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this product?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="btn-delete-product">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <!--EDIT PRODUCT MODAL -->
    <!-- Modal -->
<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="itemModalLabel">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form action="updateProduct.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="file-upload" class="modalLabels">Image</label>
            <input class="file-input form-control" type="file" name="image" id="file-upload" onchange="previewImage()">
          </div>

          <input type="hidden" name="id" id="id">
          
          <div class="form-group">
            <label for="name" class="modalLabels">Name</label>
            <input class="itemName-input form-control" type="text" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="age" class="modalLabels">Age</label>
            <input class="age-input form-control" type="text" id="age" name="age" required>
          </div>
          <div class="form-group">
            <label for="kind" class="modalLabels">Kind</label>
            <input class="kind-input form-control" type="text" id="kind" name="kind" required>
          </div>
          <div class="form-group">
            <label for="breed" class="modalLabels">Breed</label>
            <input class="breed-input form-control" type="text" id="breed" name="breed" required>
          </div>
          <div class="form-group">
            <label for="price" class="modalLabels">Price</label>
            <input class="price-input form-control" type="text" id="price" name="price" required>
          </div>
          <div class="form-group">
            <label for="weight" class="modalLabels">Weight</label>
            <input class="weight-input form-control" type="text" id="weight" name="weight" required>
          </div>
          <div class="form-group">
            <label for="desc" class="modalLabels">Description</label>
            <input class="desc-input form-control" type="text" id="desc" name="desc" required>
          </div>
          <div class="form-group">
            <label for="stock" class="modalLabels">Stock</label>
            <input class="stock-input form-control" type="text" id="stock" name="stock" required>
          </div>
            <button type="submit" name="updateData" class="btn btn-primary" id="updateBTN">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- JavaScript code -->

<script>
$(document).ready(function() {
  $('.edit').click(function() {
    $('#itemModal').modal('show');
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function () {
        return $(this).text();
    }).get();

    console.log(data);
    $('#id').val(data[0]);
    $('#image').val(data[1]);
    $('#name').val(data[2]);
    $('#age').val(data[3]);
    $('#kind').val(data[4]);
    $('#breed').val(data[5]);
    $('#price').val(data[6]);
    $('#weight').val(data[7]);
    $('#desc').val(data[8]);
    $('#stock').val(data[9]);
    
  });
});
</script>



    <script>
        $(document).ready(function(){
            // Handle delete product modal
            $('#deleteProductModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id') // Extract product ID from data-id attribute
                var modal = $(this)
                modal.find('#btn-delete-product').click(function(){
                    // Send AJAX request to delete the product
                    $.ajax({
                        url: 'deleteProduct.php',
                        type: 'POST',
                        data: {id: id},
                        success: function(response){
                            // Reload the page to update the product list
                            location.reload();
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
