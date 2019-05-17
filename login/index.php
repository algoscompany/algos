<!DOCTYPE html>

<?php
	include_once "../algos/client/access_control.php";
	ac_already_logged();
	if(checkCookies())
		header("location: " . getAlgosLink('home-page'));
?>

<html>
<head>
	<title>Login</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">

	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/mdb.css">
	<script src="../crypto-js/crypto-js.min.js"></script>
	<script type="text/javascript" src="js/login.js"></script>
	<script type="text/javascript" src="../provider/serverprovider.js"></script>
	<script type="text/javascript" src="../provider/links.js"></script>
	<script type="text/javascript" src="../bootstrap/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="../bootstrap/js/popper.min.js"></script>
</head>
<body>
	<div id="container">

		<form class="p-5 form-login" onsubmit="return checkLogin();" action="" autocomplete="off">

		    <p class="h4 mb-4 text-center" style="color: white;">Login</p>


		    <div class="container" style="text-align: left; color: white;">
		      	<div class="row">
		      	    <div class="col-sm mb-2">
		    			<div class="md-form mb-4">
		    			  	<i class="fas fa-envelope prefix"></i>
		    			  	<input type="email" id="inputIconEx1" class="form-control text-input" name="email" onfocusout="getToken()">
		    			  	<label for="inputIconEx1">E-mail address</label>
		    			</div>
		    		</div>
		    		<div class="col-sm mb-2">
		    		  	<div class="md-form mb-4">
		    		  	  <i class="fas fa-lock prefix"></i>
		    		  	  <input type="password" id="inputIconEx2" class="form-control text-input" name="password">
		    		  	  <label for="inputIconEx2">Password</label>
		    		  	</div>
		   			</div>
		   		</div>
		   	</div>


		   	<div class="d-flex justify-content-around mb-4">
		   	   	<div>
		   	        <!-- Remember me -->
		   	        <div class="custom-control custom-checkbox">
		   	            <input type="checkbox" class="custom-control-input" id="rememberMeButton" name="cookie" checked>
		   	            <label class="custom-control-label" for="rememberMeButton">Remember me</label>
		   	        </div>
		   	    </div>
		   	    <div>
		   	        <!-- Forgot password -->
		   	        <a href="<?php echo getAlgosLink('forgotPassword'); ?>">Forgot password?</a>
		   	    </div>
		   	</div>

		   	<div class="text-center">
					<button class="btn mb-4 login-btn" type="submit" name="login">Login</button>
				</div>


		    <p class="text-center mb-4" style="color: white;">Not a member?
		        <a href="<?php echo getAlgosLink('sign-up'); ?>">Register</a>
		    </p>


		</form>
	</div>





	<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="../bootstrap/js/mdb.js"></script>
</body>
</html>
