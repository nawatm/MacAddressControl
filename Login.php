<?php
  include("LoginCtrl.php");
  // check to see if login form has been submitted
if(isset($_POST['username'])){
	// run information through authenticator
	if(authenticate($_POST['username'],$_POST['password']))
	{
		// authentication passed
		header("Location:index.php");
		die();
	} else {
		// authentication failed
		$error = 1;
	}
}


// output error to user 
/*
if(isset($error)) 
{
  //echo "<script type='text/javascript'>swal('Insert Error','MAC Address ดังกล่าวมีอยู่ในระบบแล้ว', 'error');</script>";
  echo "<script type='text/javascript'>alert('MAC Address ดังกล่าวมีอยู่ในระบบแล้ว');</script>";
  echo "Login failed: Incorrect user name, password, or rights<br /-->";
}
*/


?>

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
  <meta http-equiv="x-ua-compatible" content="IE=11">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/es6-promise/4.0.5/es6-promise.auto.min.js"></script> 
  
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
  <!--  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script> -->
    <script type="text/javascript" src="Scripts/bootstrap.js"></script>
    <link href="Content/bootstrap.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Content/login.css">


    <script src="https://cdn.jsdelivr.net/sweetalert2/6.2.1/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.2.1/sweetalert2.css">


<!-- 
    <script src="https://github.com/t4t5/sweetalert/tree/master/distsweetalert.min.js"></script>
    <link rel="stylesheet" href="https://github.com/t4t5/sweetalert/tree/master/dist/sweetalert.css">
-->



</head>
<title>Login</title>
<body>  
<br /><br />
<div class="container">
   <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-login">
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <form id="login-form" action="Login.php" method="post" role="form" style="display: block;">
                <h2>ATTG IT-Admin : Login</h2>
                  <div class="form-group">
                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                  </div>
                  <div class="col-xs-6 form-group pull-left checkbox">
                    <input id="checkbox1" type="checkbox" name="remember">
                    <label for="checkbox1">Remember Me</label>   
                  </div>
                  <div class="col-xs-6 form-group pull-right">     
                        <!-- <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In"> -->
                  </div>
              

            </div>
          </div>
        </div>
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-6 tabs">
             <!--  <a href="#" class="active" id="login-form-link"><div class="login">LOGIN</div></a> -->
            </div>
            <div class="col-xs-6 tabs">
              <!-- <a href="LoginCtrl.php" id="login-form-link"><div class="register">Login</div></a> -->
              <input type="submit" name="login-form-link" id="login-form-link" tabindex="4" class="form-control btn btn-login" value="Log In">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<footer>
    <div class="container">
        <div class="col-md-10 col-md-offset-1 text-center">
            <!-- <h6 style="font-size:14px;font-weight:100;color: #fff;">Coded with <i class="fa fa-heart red" style="color: #BC0213;"></i> by <a href="http://hashif.com" style="color: #fff;" target="_blank">Hashif</a></h6> -->
        </div>   
    </div>
</footer>

<?php
  if(isset($error)) 
  {
    echo "<script type='text/javascript'>swal('Login Error','Username หรือ Password ไม่ถูกต้อง', 'error');</script>";
  }
?>



<script type="text/javascript">
/*
$(function() {
    $('#login-form-link').click(function(e) {
    	$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

});*/
</script>

</body>
</html>