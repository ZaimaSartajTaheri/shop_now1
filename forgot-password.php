<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['change']))
{
    if(isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['confirmpassword']) && !empty($_POST['confirmpassword'])){
        if(strlen($_POST['password'])>=6){
            if($_POST['password']==$_POST['confirmpassword']){
                $password=md5($_POST['password']);
                $email=$_POST['email'];
                $contact=$_POST['contactno'];
            $query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' and contactno='$contact'");
            $num=mysqli_fetch_array($query);
            if($num>0)
            {
            $extra="forgot-password.php";
            mysqli_query($con,"update users set password='$password' WHERE email='$email' and contactno='$contact' ");
            $host=$_SERVER['HTTP_HOST'];
            $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("location:http://$host$uri/$extra");
            $_SESSION['errmsg']='<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Password changed successfully</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
            exit();
            }
            else
            {
            $extra="forgot-password.php";
            $host  = $_SERVER['HTTP_HOST'];
            $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("location:http://$host$uri/$extra");
            $_SESSION['errmsg']='<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Invalid Email or Contact no</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
            exit();
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
    <title>Shopping Portal SigUp Page</title>
    <!-- Customizable CSS -->
    <style>
    .body-content{
        margin-top:30px;
        padding:10px;
    }
    .form-group span{
        color:#e60000;
    }
    .change-button{
        background-color:gray!important;
        color: white!important;
    }
    .change-button:hover{
        background-color:#cc0000!important;
        color: white!important;
    }
    .subtitle{
        font-size:20px;
        font-weight:bold;
    }
    </style>



    <!-- Demo Purpose Only. Should be removed in production -->

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>

</head>
<header>
     <?php include('includes/header.php');?>
</header>
<body>
 <div class="body-content">
	<div class="container">
		<div class="forgot-password-page inner-bottom-sm">
			<div>
				<!-- Sign-in -->			
              <div>
	            <h4 class="subtitle">Forgot password</h4>
	            <p>Hello, Welcome to your account.</p>
                <?php
        
                  echo $_SESSION['errmsg'];
    

			    ?>
	           <form class="forgot-password-form outer-top-xs" method="post">

		         <div class="form-group">
	    	       <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
	    	       <input type="email" class="form-control unicase-form-control text-input" id="email" name="email">
	          	 </div>
                

                 <div class="form-group">
	    	      <label class="info-title" for="contactno">Contact No. <span>*</span></label>
	    	      <input type="text" class="form-control" id="contactno" name="contactno">
	  	         </div>
                

                 <div class="form-group">
	    	      <label class="info-title" for="password">Password. <span>*</span></label>
	    	      <input type="password" class="form-control" id="password" name="password" >
	  	         </div>
                <?php
                 if(isset($passwordError)) echo $passwordError;
			    ?>

                 <div class="form-group">
	    	      <label class="info-title" for="confirmpassword">Confirm Password. <span>*</span></label>
	    	      <input type="password" class="form-control" id="confirmpassword" name="confirmpassword">
	  	         </div>
                <?php
        
                   if(isset($cpasswordError)) echo $cpasswordError;
                ?>
                   <div>
            </div>
                 <button type="submit" name="change" class="btn change-button checkout-page-button mb-3" id="submit">Change</button>
		         
	            </form>					
               </div>
               </div>
  <!-- /.row -->
	   </div>
        </div>
    
 </div>
 <footer>
    <?php include('includes/footer.php');?>
 </footer>
</body>
</html>