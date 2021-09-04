<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{
	// code for billing address updation
	if(isset($_POST['update']))
	{
		$baddress=$_POST['billingaddress'];
		$bstate=$_POST['bilingstate'];
		$bcity=$_POST['billingcity'];
		$bpincode=$_POST['billingpincode'];
		$query=mysqli_query($con,"update users set billingAddress='$baddress',billingState='$bstate',billingCity='$bcity',billingPincode='$bpincode' where id='".$_SESSION['id']."'");
		if($query)
		{
			$billingUpdationSuccess='<div class="alert alert-light alert-dismissible fade show" role="alert">
			<strong>Your Shipping Address has been updated</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		  </div>';
		}
		else{
			$billingUpdationError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Sorry!! Your shipping address could not be updated</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		  </div>';
		}
	}


// code for Shipping address updation
	if(isset($_POST['shipupdate']))
	{
		$saddress=$_POST['shippingaddress'];
		$sstate=$_POST['shippingstate'];
		$scity=$_POST['shippingcity'];
		$spincode=$_POST['shippingpincode'];
		$query=mysqli_query($con,"update users set shippingAddress='$saddress',shippingState='$sstate',shippingCity='$scity',shippingPincode='$spincode' where id='".$_SESSION['id']."'");
		if($query)
		{
			$shippingUpdationSuccess='<div class="alert alert-light alert-dismissible fade show" role="alert">
			<strong>Your Shipping Address has been updated</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		  </div>';
		}
		else{
			$shippingUpdationError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Sorry!! Your shipping address could not be updated</strong>
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
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">

    <title>My Account</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/green.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css">
    <!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
    <link href="assets/css/lightbox.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/rateit.css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

    <!-- Demo Purpose Only. Should be removed in production -->
    <link rel="stylesheet" href="assets/css/config.css">


    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <style>
    .lnk {
        background-color: #000000 !important;
        color: #FFFFFF !important;
        font-size: 14px !important;
        font-weight: bold !important;

    }

    .form-container {
        background-color: #A9A9A9;
        padding-left: 10%;
        padding-right: 10%;
        padding-top: 3%;
        padding-bottom: 3%;
        border-radius: 20px;
        margin-bottom: 3%;
    }
    </style>

</head>

<body class="cnt-home">
    <header class="header-style-1">

        <?php include('includes/header.php');
    ?>

    </header>

    <div class="body-content ">
        <div class=" container">
            <div class="">
                <div class="row">
                    <div class="col-md-8 form-container">
                        <div>

                            <div>

                                <div>
                                    <h4 class=" mb-3">Billing Address </h4>
                                </div>
                                <?php
        
		if(isset($billingUpdationSuccess)) echo $billingUpdationSuccess;
		if(isset($billingUpdationError)) echo $billingUpdationError;
		
	 ?>

                                <div>

                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12"><?php $query=mysqli_query($con, "select * from users where id='".$_SESSION['id']."'");

    while($row=mysqli_fetch_array($query)) {
        ?><form class="register-form" role="form" method="post">
                                                    <div class="form-group"><label class="info-title"
                                                            for="Billing Address">Address<span>*</span></label><textarea
                                                            class="form-control unicase-form-control text-input"
                                                            id="billingaddress" name="billingaddress"
                                                            required="required"><?php echo $row['billingAddress'];
        ?></textarea></div>
                                                    <div class="form-group"><label class="info-title"
                                                            for="Billing State ">Area<span>*</span></label><input
                                                            type="text"
                                                            class="form-control unicase-form-control text-input"
                                                            id="bilingstate" name="bilingstate"
                                                            value="<?php echo $row['billingState'];?>" required>
                                                    </div>
                                                    <div class="form-group"><label class="info-title"
                                                            for="Billing City">City<span>*</span></label><input
                                                            type="text"
                                                            class="form-control unicase-form-control text-input"
                                                            id="billingcity" name="billingcity" required="required"
                                                            value="<?php echo $row['billingCity'];?>">
                                                    </div>
                                                    <div class="form-group"><label class="info-title"
                                                            for="Billing Pincode">Postcode<span>*</span></label><input
                                                            type="text"
                                                            class="form-control unicase-form-control text-input"
                                                            id="billingpincode" name="billingpincode"
                                                            required="required"
                                                            value="<?php echo $row['billingPincode'];?>">
                                                    </div><button type="submit" name="update"
                                                        class="btn-upper btn btn-secondary bg-dark lnk checkout-page-button">Update</button>
                                                </form><?php
    }

    ?></div>

                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div>
                                <div>
                                    <h4 class="mt-5 mb-3">Shipping Address </h4>
                                </div>
                                <?php
        
		if(isset($shippingUpdationSuccess)) echo $shippingUpdationSuccess;
		if(isset($shippingUpdationError)) echo $shippingUpdationError;
		
	 ?>
                                <div>
                                    <div class="panel-body"><?php $query=mysqli_query($con, "select * from users where id='".$_SESSION['id']."'");

    while($row=mysqli_fetch_array($query)) {
        ?><form class="register-form" role="form" method="post">
                                            <div class="form-group"><label class="info-title"
                                                    for="Shipping Address">Address<span>*</span></label><textarea
                                                    class="form-control unicase-form-control text-input"
                                                    id="shippingaddress" name="shippingaddress" required="required"><?php echo $row['shippingAddress'];
        ?></textarea></div>
                                            <div class="form-group"><label class="info-title"
                                                    for="Billing State ">Area<span>*</span></label><input type="text"
                                                    class="form-control unicase-form-control text-input"
                                                    id="shippingstate" name="shippingstate"
                                                    value="<?php echo $row['shippingState'];?>" required>
                                            </div>
                                            <div class="form-group"><label class="info-title"
                                                    for="Billing City">City<span>*</span></label><input type="text"
                                                    class="form-control unicase-form-control text-input"
                                                    id="shippingcity" name="shippingcity" required="required"
                                                    value="<?php echo $row['shippingCity'];?>">
                                            </div>
                                            <div class="form-group"><label class="info-title"
                                                    for="Billing Pincode">Postcode<span>*</span></label><input
                                                    type="text" class="form-control unicase-form-control text-input"
                                                    id="shippingpincode" name="shippingpincode" required="required"
                                                    value="<?php echo $row['shippingPincode'];?>">
                                            </div><button type="submit" name="shipupdate"
                                                class="btn-upper btn  btn-secondary bg-dark lnk checkout-page-button">Update</button>
                                        </form><?php
    }

    ?></div>
                                </div>
                            </div>

                        </div>

                    </div><?php include('includes/myaccount-checkoutbox.php');
    ?>
                </div>

            </div>

        </div>
    </div>

</body>
<footer><?php include('includes/footer.php');
    ?></footer>

</html><?php
    }

    ?>