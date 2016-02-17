<?php
    ob_start();
    session_start();
    if(isset($_SESSION['sess_username'])){
		header('Location:index.php');
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css"> 
	.sidebar-menu{
		font-weight:bold;
	}
	body{
		background-image: url('assets/img/image5.jpg');
	}
	</style>
	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript">
	//success
	function ajaxlogin(){
		$.post("login_validation_secure.php", $('#form-login').serialize(),
			function(resp,status){
				if(status=='success'){
					if(resp=='success')
						location.replace('index.php');
					else
					{
						$('#msgbox').fadeIn('medium');
						$('#msg').html(resp);
					}
				}
			});
		return false;
	}
	</script>
  </head>

<body>
 <section id="container" >
<!--
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
				<li><a class="h3" >Welcome Guest</a></li> </ul>
            </div>
            -->
        </header>
		</section>

	  <div id="login-page">
	  	<div class="container">

		      <form id="form-login" class="form-login" action="login_validation_secure.php" method="post" onsubmit="return ajaxlogin()">
				<h2 class="form-login-heading logo"><img src="assets/img/rvce-logo.jpg" class="img-circle" width="40"> &nbsp; &nbsp; <b>Time Table Tracker</b></h2>

		
	<div class="alert alert-warning" id="msgbox" style="display:none">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong id="msg"></strong>
    </div>
		
				<center>Authentication required</center>

		        <div class="login-wrap">
		            <input type="text" name="uname" class="form-control" placeholder="USN / Faculty Initials" autofocus required>
		            <br>
		            <input type="password" name="pass" class="form-control" placeholder="Password" required>
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> Forgot Password?</a>
		
		                </span>
		            </label>
		            <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> LOG IN</button>
		            <hr>
		            <div class="registration">
		                Don't have an account yet?<br/>
		                <a class="" href="register.php">
		                    Create an account
		                </a>
		            </div>
		
		        </div>
		
		          <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Forgot Password ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Enter your e-mail address below to reset your password.</p>
		                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <button class="btn btn-theme" type="submit">Submit</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
		
		      </form>	  	
	  	
	  	</div>
	  </div>
  
</body>

</html>
        