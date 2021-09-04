<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Code user Registration
if(isset($_POST['submit'])){
	if(isset($_POST['term'])===true){
if(isset($_POST['fullname']) && !empty($_POST['fullname'])){
      if(preg_match('/^[A-Za-z\s]+$/',$_POST['fullname'])){
      	$name=$_POST['fullname'];

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
      	$contact_no=$_POST['contactno'];

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

      

      if(isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['confirmpassword']) && !empty($_POST['confirmpassword'])){
      	if(strlen($_POST['password'])>=6){
      		if($_POST['password']==$_POST['confirmpassword']){
      			$password=$_POST['password'];

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




      if(isset($_POST['email']) && !empty($_POST['email'])){
        if(preg_match('/^[a-z0-9._%+-]+@[a-z0-9.-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/',$_POST['email'])){
          $check_email=$_POST['email'];
          $sql="SELECT email FROM users WHERE email='$check_email'";
          $result=mysqli_query($con,$sql);
          if(mysqli_num_rows($result)>0){
             $emailError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Sorry this email already exists</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  
          }
          else{
  $email=$_POST['email'];
          }
        }else{
          $emailError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Please enter valid email address</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
        }
        }else{
          $emailError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Please fill the email field</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
        }
  

      if(isset($name) && isset($email) && isset($contact_no) && isset($password)){


        $password=md5($password);
           $sql="INSERT INTO users(name,email,contactno,password) VALUES('$name','$email','$contact_no','$password')";


           if(mysqli_query($con,$sql)){
            $submitSuccess='<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>You have registered successfully.Now you can Login to your account.</strong>
          
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
             
}   else{
   $submitError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Data not inserted..Try again</strong>

  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}



      }


	}else{
		$termError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<strong>Please agree with our terms and conditions</strong>

	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
	}
}

// Code for User login
if(isset($_POST['login']))
{
   $email=$_POST['email'];
   $password=md5($_POST['password']);
$query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' and password='$password'");
$num=mysqli_fetch_array($query);
if($num>0)
{
$extra="index.php";
$_SESSION['login']=$_POST['email'];
$_SESSION['id']=$num['id'];
$_SESSION['username']=$num['name'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('".$_SESSION['login']."','$uip','$status')");
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$extra="SignupLogin.php";
$email=$_POST['email'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
$log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('$email','$uip','$status')");
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
$_SESSION['errmsg']='<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Invalid email id or Password</strong>

<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>';
exit();
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
    header {
        margin-top: -70px;
    }

    header .navbar .logo {
        margin-top: 55px !important;
    }

    .body-content {
        margin-top: 30px;
        padding: 10px;
    }

    .form-group span {
        color: #e60000;
    }

    .login-button,
    .signup-button {
        background-color: gray !important;
        color: white !important;
    }

    .login-button:hover,
    .signup-button:hover {
        background-color: #cc0000 !important;
        color: white !important;
    }

    .subtitle {
        font-size: 20px;
        font-weight: bold;
    }

    .features {
        margin-top: 5px;
    }

    .features li {
        list-style-type: none;
    }

    .forgot-password {
        color: #cc0000;

    }

    .forgot-password:hover {
        color: #e60000;
        text-decoration: none;
    }
    </style>



    <!-- Demo Purpose Only. Should be removed in production -->

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>

</head>

<body>
    <header>
        <?php include('includes/header.php');?>
    </header>
    <div class="body-content outer-top-bd">
        <div class="container">
            <div class="sign-in-page inner-bottom-sm">
                <div class="row">
                    <!-- Sign-in -->
                    <div class="col-md-6 col-sm-6 sign-in">
                        <h4 class="subtitle">SIGN IN</h4>
                        <p class="">Hello, Welcome to your account.</p>
                        <form class="register-form outer-top-xs" method="post">
                            <?php echo $_SESSION['errmsg'];?>
                            <?php echo $_SESSION['errmsg']="";?>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                <input type="email" name="email" class="form-control unicase-form-control text-input"
                                    id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                                <input type="password" name="password"
                                    class="form-control unicase-form-control text-input" id="exampleInputPassword1">
                            </div>
                            <div class="radio outer-xs">
                                <a href="forgot-password.php" class="forgot-password pull-right">Forgot your
                                    Password?</a>
                            </div>
                            <button type="submit" class="btn login-button checkout-page-button"
                                name="login">Login</button>
                        </form>
                    </div>
                    <!-- Sign-in -->

                    <!-- create a new account -->
                    <div class="col-md-6 col-sm-6 create-new-account">
                        <h4 class="subtitle">CREATE A NEW ACCOUNT</h4>
                        <p class="text title-tag-line">Create your own Shopping account.</p>
                        <?php
        
                 if(isset($termError)) echo $termError;
                 if(isset($submitError)) echo $submitError;
                 if(isset($submitSuccess)) echo $submitSuccess;

			    ?>
                        <form class="register-form outer-top-xs" role="form" method="post" name="register"
                            onSubmit="return valid();">
                            <div class="form-group">
                                <label class="info-title" for="fullname">Full Name <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="fullname"
                                    name="fullname" value="<?php if(isset($name)) echo $name;?>">
                            </div>
                            <?php
                  if(isset($nameError)) echo $nameError;
                ?>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input" id="email"
                                    name="email" value="<?php if(isset($email)) echo $email;?>">
                            </div>
                            <?php
        
                    if(isset($emailError)) echo $emailError;
                ?>

                            <div class="form-group">
                                <label class="info-title" for="contactno">Contact No. <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="contactno"
                                    name="contactno" value="<?php
        
        if(isset($contact_no)) echo $contact_no;
              ?>">
                            </div>
                            <?php
        
                    if(isset($contactnoError)) echo $contactnoError;
                ?>

                            <div class="form-group">
                                <label class="info-title" for="password">Password. <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input"
                                    id="password" name="password">
                            </div>
                            <?php
                 if(isset($passwordError)) echo $passwordError;
			    ?>

                            <div class="form-group">
                                <label class="info-title" for="confirmpassword">Confirm Password. <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input"
                                    id="confirmpassword" name="confirmpassword">
                            </div>
                            <?php
        
                   if(isset($cpasswordError)) echo $cpasswordError;
                ?>
                            <div>
                                <input type="checkbox" name="term" value="true">
                                <span><b>I agree to your terms and conditions</b></span>
                            </div>
                            <button type="submit" name="submit" class="btn signup-button checkout-page-button mb-3"
                                id="submit">Sign Up</button>
                        </form>
                        <span class="subtitle outer-top-xs">Sign Up Today And You'll Be Able To : </span>
                        <div class="features">
                            <li>Speed your way through the checkout.</li>
                            <li>Track your orders easily.</li>
                            <li>Keep a record of all your purchases.</li>
                        </div>
                    </div>
                    <!-- create a new account -->
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