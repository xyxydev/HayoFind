<?php
    session_start();
    @$username = $_SESSION['username'];
    include_once("connections/connect.php");
    $con = connection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" class="iconTab" href="images/cow.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>View Accounts</title>
</head>
<style>
    .container-fluid{
        margin-top: 20px !important;
        font-family: 'Quicksand' !important;
    }
    th{
        font-size: 18px;
        font-weight: 500 !important;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    td{
        padding-top: 10px;
        padding-bottom: 10px;
    }
    #backtohome {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    user-select: none;
    padding: 0.5rem 1rem;
    font-size: 1.25rem;
    line-height: 1.5;
    border-radius: 0.3rem;
    color: #fff;
    background-color: #91C788;
    border: none;
    outline: none;
    text-decoration: none !important;
}
</style>
<body>
    <?php
        require_once('adminHeader.php'); 
    ?>

    <!----BODY STARTS HERE-->
    
<div class="container-fluid" >
    <a class="mb-3 button" href="index.php" id="backtohome" style="margin-left: 150px;">Back to Home</a>
	<div class="row">
		<div class="card col-lg-12" style="border: none !important; ">
			<div class="card-body">
				<table class="table-striped col-md-10 text-center" style="margin-left: 150px;">
                    <thead style="background-color: #91C788 !important; color: white;">
                        <tr>
                            <th>Buyer ID</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No.</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Birthday</th>
                            <th>Valid ID</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM buyers"; 
                            $result = mysqli_query($con, $sql);
                            
                            while($row=mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
                                $username = $row['username'];
                                $name = $row['fname'].' '.$row['lname'];
                                $email = $row['email'];
                                $phone = $row['phoneNumber'];
                                $gender = $row['gender'];
                                $address = $row['address'];
                                $dob = $row['dob'];
                                $valid_ID = $row['valid_ID'];
                                $image = $row['image'];
                               

                                echo '<tr>
                                    <td>' .$id. '</td>
                                    <td>' .$username. '</td>
                                    <td>' .$name. ' </td>
                                    <td>' .$email. '</td>
                                    <td>' .$phone. '</td>
                                    <td>' .$gender. '</td>
                                    <td>' .$address. '</td>
                                    <td>' .$dob. '</td>
                                    <td>' .$valid_ID. '</td>
                                    
                                    <td class="text-center">
                                        <div class="row mx-auto" style="width:112px">
                                        <form method="POST" action ="function/_verifyAccount.php">
                                            
                                            <input type="hidden" name="id" value="'.$id. '">
                                            <button class="btn btn-sm btn-primary" type="submit" name="verify">Verify</button>
                                        </form>';
                                       
                                                echo '<form action="function/_userManage.php" method="POST">
                                                        <button name="removeUser" class="btn btn-sm btn-danger" style="margin-left:9px;"><i class="fas fa-trash-alt"></i></button>
                                                        <input type="hidden" name="id" value="'.$id. '">
                                                    </form>';
                                            

                                    echo '</div>
                                    </td>
                                </tr>';
                            }
                        ?>
                    </tbody>
		        </table>
			</div>
		</div>
	</div>
</div>

    <!----BODY ENDS HERE-->
</body>
</html>