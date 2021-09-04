<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit'])){
		if(!empty($_SESSION['cart'])){
		foreach($_POST['quantity'] as $key => $val){
			if($val==0){
				unset($_SESSION['cart'][$key]);
			}else{
				$_SESSION['cart'][$key]['quantity']=$val;

			}
		}
		$cartUpdationSuccess='<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong>Your Cart has been updated</strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	  </button>
	  </div>';
		}
	}
// Code for Remove a Product from Cart
if(isset($_POST['remove_code']))
	{

if(!empty($_SESSION['cart'])){
		foreach($_POST['remove_code'] as $key){
			
				unset($_SESSION['cart'][$key]);
		}
		$cartUpdationSuccess='<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong>Your Cart has been updated</strong>
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

    <title>My Wishlist</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">


    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">




    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>




    <style>
    header {
        margin-top: -70px;
    }

    header .navbar .logo {
        margin-top: 55px !important;
    }

    .estimate-ship-tax {
        border-radius: 20px;
    }


    .productname {
        color: #000000;
        text-decoration: none;
    }

    .productname:hover {
        color: #000000;
    }

    .lnk {
        background-color: #db3d52 !important;
        color: #FFFFFF !important;
        font-size: 14px !important;
        font-weight: bold !important;
        box-shadow: none !important;
    }


    .body-content {
        margin-left: 17%;
    }

    .quant-input input {
        width: 30px;

    }

    .proceed {
        background-color: #db3d52 !important;
        color: #FFFFFF !important;
    }

    .proceed:focus {
        outline: none !important;
        box-shadow: none !important;

    }
    </style>
</head>

<body class="cnt-home">




    <header class="header-style-1">

        <?php include('includes/header.php');?>

    </header>


    <div class="body-content outer-top-xs">

        <div class="container">
            <h6 class="mb-5">
                <span>***</span>If you haven't added your shipping and billing address yet, please add
                those in your personal account info. Thank you :)
            </h6>

            <div class="row inner-bottom-sm">
                <div class="shopping-cart">

                    <div class="col-md-12 col-sm-12 shopping-cart-table ">
                        <div class="table-responsive">

                            <form name="cart" method="post">
                                <?php
if(!empty($_SESSION['cart'])){
	
								if(isset($cartUpdationSuccess)) echo $cartUpdationSuccess;
							
							
							
                                ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="cart-romove item">Remove</th>
                                            <th class="cart-description item">Image</th>
                                            <th class="cart-product-name item">Product Name</th>

                                            <th class="cart-qty item">Quantity</th>
                                            <th class="cart-sub-total item">Price Per unit</th>
                                            <th class="cart-sub-total item">Shipping Charge</th>
                                            <th class="cart-total last-item">Grandtotal</th>
                                        </tr>
                                    </thead><!-- /thead -->
                                    <tfoot>
                                        <tr>
                                            <td colspan="7">
                                                <div class="shopping-cart-btn">
                                                    <span class="">
                                                        <a href="index.php" class="btn lnk ">Continue
                                                            Shopping</a>
                                                        <input type="submit" name="submit" value="Update shopping cart"
                                                            class="btn  lnk ">
                                                    </span>
                                                </div><!-- /.shopping-cart-btn -->
                                            </td>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
 $pdtid=array();
    $sql = "SELECT * FROM products WHERE id IN(";
			foreach($_SESSION['cart'] as $id => $value){
			$sql .=$id. ",";
			}
			$sql=substr($sql,0,-1) . ") ORDER BY id ASC";
			$query = mysqli_query($con,$sql);
			$totalprice=0;
			$totalqunty=0;
			if(!empty($query)){
			while($row = mysqli_fetch_array($query)){
				$quantity=$_SESSION['cart'][$row['id']]['quantity'];
				$subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge'];
				$totalprice += $subtotal;
				$_SESSION['qnty']=$totalqunty+=$quantity;

				array_push($pdtid,$row['id']);

	?>

                                        <tr>
                                            <td class="romove-item"><input type="checkbox" name="remove_code[]"
                                                    value="<?php echo htmlentities($row['id']);?>" /></td>
                                            <td class="cart-image">
                                                <a class="entry-thumbnail" href="product-details.html">
                                                    <img src="admin/productimages/<?php echo $row['id'];?>/<?php echo $row['productImage1'];?>"
                                                        alt="" width="114" height="146">
                                                </a>
                                            </td>
                                            <td class="cart-product-name-info">
                                                <h4 class='cart-product-description'><a class="productname"
                                                        href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo $row['productName'];


						 ?></a></h4>


                                            </td>
                                            <td class="cart-product-quantity">

                                                <div class="quant-input row">
                                                    <div class="arrows col-md-1 col-sm-12">
                                                        <div class="arrow plus gradient"><span class="ir"><i
                                                                    class="icon fa fa-sort-asc"></i></span>
                                                        </div>

                                                        <div class="arrow minus gradient"><span class="ir"><i
                                                                    class="icon fa fa-sort-desc"></i></span>
                                                        </div>
                                                    </div>

                                                    <input type="text"
                                                        value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>"
                                                        name="quantity[<?php echo $row['id']; ?>]">
                                                </div>
                                            </td>
                                            <td class="cart-product-sub-total"><span
                                                    class="cart-sub-total-price"><?php echo "Tk."." ".$row['productPrice']; ?>.00</span>
                                            </td>
                                            <td class="cart-product-sub-total"><span
                                                    class="cart-sub-total-price"><?php echo "Tk."." ".$row['shippingCharge']; ?>.00</span>
                                            </td>

                                            <td class="cart-product-grand-total"><span
                                                    class="cart-grand-total-price"><?php echo "Tk. ". ($_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge']); ?>.00
                                                </span>
                                            </td>
                                        </tr>

                                        <?php } }

				?>

                                    </tbody>
                                </table>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12 estimate-ship-tax">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            <span class="estimate-title">Shipping Address</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <?php $qry=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
while ($rt=mysqli_fetch_array($qry)) {
	echo htmlentities($rt['shippingAddress'])."<br />";
	echo htmlentities($rt['shippingCity'])."<br />";
	echo htmlentities($rt['shippingState']);
	echo htmlentities($rt['shippingPincode']);
}

						?>

                                            </div>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <div class="col-md-4 col-sm-12 estimate-ship-tax">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            <span class="estimate-title">Billing Address</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <?php $qry=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
                                                 while ($rt=mysqli_fetch_array($qry)) {
	                                             echo htmlentities($rt['billingAddress'])."<br />";
	                                             echo htmlentities($rt['billingCity'])."<br />";
	                                             echo htmlentities($rt['billingState']);
	                                             echo htmlentities($rt['billingPincode']);
                                                  }

						?>

                                            </div>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4 col-sm-12 cart-shopping-total">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>

                                            <div class="cart-grand-total">
                                                Grand Total<span class="inner-left-md">
                                                    <?php echo $_SESSION['tp']="$totalprice". ".00 Tk."; ?></span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="cart-checkout-btn pull-right">
                                                <button type="submit" name="ordersubmit" class="btn proceed">PROCCED
                                                    TO
                                                    CHEKOUT</button>

                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php } else {
                                   $cartEmpty='<div class="alert alert-danger alert-dismissible fade show" role="alert">
								   <strong>Your cart is empty. Buy your favourite items fast!!!</strong>
								   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								   <span aria-hidden="true">&times;</span>
								 </button>
								 </div>';

								 if(isset($cartEmpty)) echo $cartEmpty;
		                          }?>
                        </div>
                    </div>

                </div>
            </div>
            </form>

        </div>
    </div>
    </div>


    <script src="assets/js/scripts.js"></script>



</body>

<footer>
    <?php include('includes/footer.php');?>
</footer>

</html>