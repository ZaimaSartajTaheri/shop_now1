<?php
session_start();
error_reporting(0);
include('includes/config.php');
$query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
while($row=mysqli_fetch_array($query))
{
	$previous_name=$row['name'];
	$previous_email=$row['email'];
	$previous_contactno=$row['contactno'];
}

date_default_timezone_set('Asia/Dhaka');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{
	if(isset($_POST['update']))
	{   
        if(isset($_POST['name']) && !empty($_POST['name'])){
			if(preg_match('/^[A-Za-z\s]+$/',$_POST['name'])){
				$name=$_POST['name'];
			}else{
				$nameError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>Only lower and upper case and space and space characters are allow</strong>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>';
			}
			}else{
				$nameError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>Please fill the name field</strong>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>';
			}
			if(isset($_POST['contactno']) && !empty($_POST['contactno'])){
			if(preg_match('/\d{11}/',$_POST['contactno'])){
				$contactno=$_POST['contactno'];
			}else{
				$contactnoError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>contact number must contain 11 digits</strong>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>';
			}
			}else{
				$contactnoError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>Please fill the contact no field</strong>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>';
			}
			if(isset($name) && isset($contactno)){
				$query=mysqli_query($con,"update users set name='$name',contactno='$contactno' where id='".$_SESSION['id']."'");
				if($query)
				{
					$updateSuccessText='<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Account updated Successfully !!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>';
					?>
<script>
function myFunction() {
    location.reload();
}
</script>




<?php




}else{
$updateError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Data not updated..Try again</strong>

<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
}



}



}

if(isset($_POST['submit']))
{
if(isset($_POST['newpass']) && !empty($_POST['newpass']) && isset($_POST['cnfpass']) && !empty($_POST['cnfpass'])){
	if(strlen($_POST['newpass'])>=6){
		if($_POST['newpass']==$_POST['cnfpass']){
			$password=$_POST['newpass'];
			$sql=mysqli_query($con,"SELECT password FROM  users where password='".md5($_POST['cpass'])."' && id='".$_SESSION['id']."'");
            $num=mysqli_fetch_array($sql);
            if($num>0){
				$con=mysqli_query($con,"update users set password='".md5($_POST['newpass'])."', updationDate='$currentTime' where id='".$_SESSION['id']."'");
				$successText='<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>Password Changed Successfully !!</strong>

<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
				}
				
			
			else
				{
					$cpassError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Current Password not match !!</strong>

<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
				}

		}

		else{
$cpasswordError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>The password does not match with confirm password</strong>

<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
		}

	}


	else{
		$passwordError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>The password should consist of 6 characters</strong>

<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';

	}
}
else{
$passwordError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Please fill the password field</strong>

<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
}

}




?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Now</title>

    <style>
    .body-content {
        padding: 30px;
    }

    .panel {
        margin-bottom: 30px;
    }

    .title {
        font-weight: bold;
        margin-bottom: 20px;
    }

    .panel-body span {
        color: #e60000;
    }

    .update-button {
        background-color: gray !important;
        color: white !important;
    }

    .update-button:hover {
        background-color: #cc0000 !important;
        color: white !important;
    }
    </style>



    <!-- Demo Purpose Only. Should be removed in production -->

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <style>

    </style>




</head>

<body>
    <header>
        <?php include('includes/header.php');?>
    </header>
    <!-- ============================================== NAVBAR ============================================== -->

    <div class="body-content">
        <div class="container">
            <div class="checkout-box">
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel-group">
                            <!-- checkout-step-01  -->
                            <div class="panel panel-default checkout-step-01">

                                <!-- panel-heading -->
                                <div class="panel-heading">
                                    <h5 class="title">My Profile</h5>
                                </div>
                                <!-- panel-heading -->

                                <div>

                                    <!-- panel-body  -->
                                    <div class="panel-body">
                                        <?php
		if(isset($updateSuccessText)) echo $updateSuccessText;
		if(isset($updateError)) echo $updateError;
		 ?>

                                        <div class="row">

                                            <div class="col-md-12 col-sm-12">



                                                <form class="register-form" method="post">
                                                    <div class="form-group">
                                                        <label class="info-title" for="name">Name<span>*</span></label>
                                                        <input type="text"
                                                            class="form-control unicase-form-control text-input"
                                                            value="<?php echo $previous_name;?>" id="name" name="name">
                                                    </div>
                                                    <?php if(isset($nameError)) echo $nameError; ?>



                                                    <div class="form-group">
                                                        <label class="info-title" for="exampleInputEmail1">Email Address
                                                            <span>*</span></label>
                                                        <input type="email"
                                                            class="form-control unicase-form-control text-input"
                                                            id="exampleInputEmail1"
                                                            value="<?php echo $previous_email;?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="info-title" for="Contact No.">Contact No.
                                                            <span>*</span></label>
                                                        <input type="text"
                                                            class="form-control unicase-form-control text-input"
                                                            id="contactno" name="contactno"
                                                            value="<?php echo $previous_contactno;?>" maxlength="11">
                                                    </div>
                                                    <?php if(isset($contactnoError)) echo $contactnoError; ?>
                                                    <button type="submit" name="update"
                                                        class="btn update-button">Update</button>
                                                </form>


                                            </div>
                                            <!-- already-registered-login -->

                                        </div>
                                    </div>
                                    <!-- panel-body  -->

                                </div><!-- row -->
                            </div>
                            <!-- checkout-step-01  -->
                            <!-- checkout-step-02  -->
                            <div class="panel panel-default checkout-step-02">
                                <div class="panel-heading">
                                    <h5 class="title">Change Password</h5>
                                </div>
                                <div>
                                    <div class="panel-body">
                                        <?php
                 if(isset($successText)) echo $successText;
			    ?>

                                        <form class="register-form" method="post">
                                            <div class="form-group">
                                                <label class="info-title" for="Current Password">Current
                                                    Password<span>*</span></label>
                                                <input type="password"
                                                    class="form-control unicase-form-control text-input" id="cpass"
                                                    name="cpass">
                                            </div>
                                            <?php
                 if(isset($cpassError)) echo $cpassError;
			    ?>



                                            <div class="form-group">
                                                <label class="info-title" for="New Password">New Password
                                                    <span>*</span></label>
                                                <input type="password"
                                                    class="form-control unicase-form-control text-input" id="newpass"
                                                    name="newpass">
                                            </div>
                                            <?php
                 if(isset($passwordError)) echo $passwordError;
			    ?>
                                            <div class="form-group">
                                                <label class="info-title" for="Confirm Password">Confirm Password
                                                    <span>*</span></label>
                                                <input type="password"
                                                    class="form-control unicase-form-control text-input" id="cnfpass"
                                                    name="cnfpass">
                                            </div>
                                            <?php
                 if(isset($cpasswordError)) echo $cpasswordError;
			    ?>
                                            <button type="submit" name="submit" class="btn update-button">Change
                                            </button>
                                        </form>




                                    </div>
                                </div>
                            </div>
                            <!-- checkout-step-02  -->

                        </div><!-- /.checkout-steps -->
                    </div>
                    <?php include('includes/myaccount-checkoutbox.php');?>

                </div><!-- /.row -->
            </div><!-- /.checkout-box -->

        </div>
    </div>
</body>
<footer>
    <?php include('includes/footer.php');?>
</footer>

</html>
<?php } ?>