<?php 
session_start();
error_reporting(0);
include('includes/config.php');
$cid=intval($_GET['scid']);
if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
        header('location:my-cart.php');
	}else{
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
			header('location:my-cart.php');
		}else{
			$message="Product ID is invalid";
		}
	}
}
// COde for Wishlist
if(isset($_GET['pid']) && $_GET['action']=="wishlist" ){
	if(strlen($_SESSION['login'])==0)
    {   
header('location:SignupLogin.php');
}
else
{
mysqli_query($con,"insert into wishlist(userId,productId) values('".$_SESSION['id']."','".$_GET['pid']."')");

header('location:my-wishlist.php');

}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Now</title>
    <!-- Bootstrap Core CSS -->


    <!-- Customizable CSS -->
    <style>
    .side-menu {
        margin-top: 20px;
        color: #cc0000;

    }

    .title {
        background-color: #cc0000;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        padding: 5px;
        font-size: 20px;
        margin-bottom: 5px;
    }

    .categories {
        background-color: #f8d7da;
        border-radius: 5px;
        font-weight: bold;
    }

    .categories li {
        list-style-type: none;
    }

    .category-item a {
        text-decoration: none !important;
        display: flex;
        margin-top: 2px;
        color: black;
    }

    .category-item a:hover {
        color: #cc0000;
    }

    .product-info .name a {
        color: #000000;
        text-decoration: none;
    }

    .product-info .name a:hover {
        color: #000000;
        text-decoration: none;
    }

    .lnk {
        background-color: #db3d52 !important;
        color: #FFFFFF !important;
        font-size: 14px !important;
        font-weight: bold !important;
        box-shadow: none !important;

    }

    /* .lnk:hover {
        color: #cc0000 !important;
    } */

    .product-price {
        font-size: 15px !important;
    }

    .price-before-discount {
        text-decoration: line-through;

    }

    .subcategory {
        font-weight: bold;
        font-size: 25px;
        margin-left: -2%
    }

    .lnk {
        background-color: #db3d52 !important;
        color: #FFFFFF !important;
        font-size: 14px !important;
        font-weight: bold !important;
        box-shadow: none !important;
    }
    </style>





    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>




</head>

<body>
    <header>
        <?php include('includes/header.php');?>
    </header>

    </div><!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row outer-bottom-sm'>
                <div class='col-md-3 sidebar'>

                    <?php include('includes/side-menu.php');?>
                </div><!-- /.sidebar -->
                <div class='col-md-9'>


                    <div id="category" class="category-carousel hidden-xs">
                        <div class="item">
                            <div class="image">
                                <img src="assets/images/banners/subcat-banner.jpg" alt="" class="d-block w-100">
                            </div>
                            <div class="container-fluid">
                                <div class="caption vertical-top text-left">
                                    <div class="big-text">
                                        <br />
                                    </div>

                                    <?php $sql=mysqli_query($con,"select subcategory  from subcategory where id='$cid'");
while($row=mysqli_fetch_array($sql))
{
    ?>

                                    <div class="subcategory hidden-sm hidden-md">
                                        <?php echo htmlentities($row['subcategory']);?>
                                    </div>
                                    <?php } ?>

                                </div><!-- /.caption -->
                            </div><!-- /.container-fluid -->
                        </div>
                    </div>

                    <div class="search-result-container">
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane active " id="grid-container">
                                <div class="category-product  inner-top-vs">
                                    <div class="row">
                                        <?php
$ret=mysqli_query($con,"select * from products where subCategory='$cid'");
$num=mysqli_num_rows($ret);
if($num>0)
{
while ($row=mysqli_fetch_array($ret)) 
{?>
                                        <div class="col-sm-6 col-md-4 wow fadeInUp">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a
                                                                href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><img
                                                                    src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                    data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                    alt="" width="200" height="300"></a>
                                                        </div><!-- /.image -->
                                                    </div><!-- /.product-image -->


                                                    <div class="product-info text-left">
                                                        <h5 class="name"><a
                                                                href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a>
                                                        </h5>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="description"></div>

                                                        <div class="product-price">
                                                            <span class="price">
                                                                Tk. <?php echo htmlentities($row['productPrice']);?>
                                                            </span>
                                                            <span class="price-before-discount">Tk.
                                                                <?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>

                                                        </div><!-- /.product-price -->

                                                    </div><!-- /.product-info -->
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled">
                                                                <div>
                                                                    <a class="btn ml-5 lnk" data-placement="right"
                                                                        title="Wishlist"
                                                                        href="sub-category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"><i
                                                                            class="fa fa-heart"></i></a>
                                                                </div>

                                                                <li class="add-cart-button btn-group">

                                                                    <a href="sub-category.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                                        class="btn lnk"><i
                                                                            class="fa fa-shopping-cart inner-right-vs"></i>
                                                                        ADD TO CART</a>

                                                                </li>







                                                            </ul>
                                                        </div><!-- /.action -->
                                                    </div><!-- /.cart -->
                                                </div>
                                            </div>
                                        </div>
                                        <?php } } else {?>

                                        <div class="col-sm-6 col-md-4 wow fadeInUp">
                                            <h5>No Product Found</h5>
                                        </div>

                                        <?php } ?>










                                    </div><!-- /.row -->
                                </div><!-- /.category-product -->

                            </div><!-- /.tab-pane -->



                        </div><!-- /.search-result-container -->

                    </div><!-- /.col -->
                </div>
            </div>


        </div>
    </div>
</body>
<footer>
    <?php include('includes/footer.php');?>
</footer>

</html>