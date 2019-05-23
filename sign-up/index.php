<!DOCTYPE html>

<?php
	include_once "../algos/client/access_control.php";
	ac_already_logged();
?>

<html>
<head>
	<title>Sign up</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">

	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/mdb.css">

	<script type="text/javascript" src="js/sign-up.js"></script>
	<script type="text/javascript" src="../provider/serverprovider.js"></script>
	<script type="text/javascript" src="../provider/links.js"></script>
	<script type="text/javascript" src="../bootstrap/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="../bootstrap/js/popper.min.js"></script>
</head>
<body class="body">
	<div id="container">

		<form class="p-5 form-login" onsubmit="return signUp();" autocomplete="off">

		    <p class="h4 mb-4 text-center" style="color: white;"><a href="<?php echo getAlgosLink('landing'); ?>" style="font-size: 25px;"><i class="fas fa-brain"></i></a> Sign up</p>


		    <div class="container" style="text-align: left; color: white;">
		   		<div class="row">
		    		<div class="col-sm mb-2">
		    			<div class="md-form mb-4">
		    			  	<i class="fas fa-envelope prefix"></i>
		    			  	<input type="email" id="inputIconEx1" class="form-control text-input" required>
		    			  	<label for="inputIconEx1">E-mail</label>
		    			</div>
		    		</div>
		    		<div class="col-sm mb-2">
		    			<div class="md-form mb-4">
		    			  	<i class="fas fa-user prefix"></i>
		    			  	<input type="text" id="inputIconEx1" class="form-control text-input">
		    			  	<label for="inputIconEx1">Name</label>
		    			</div>
		    		</div>
		   		</div>
		   		<div class="row">
		      	    <div class="col-sm mb-2">
		    			<div class="md-form mb-4">
		    			  	<i class="fas fa-lock prefix"></i>
		    			  	<input type="password" id="inputIconEx1" class="form-control text-input" required>
		    			  	<label for="inputIconEx1">Password</label>
		    			</div>
		    		</div>
		    		<div class="col-sm mb-2">
		    		  	<div class="md-form mb-4">
		    		  	  <i class="fas fa-check prefix"></i>
		    		  	  <input type="password" id="inputIconEx2" class="form-control text-input" required>
		    		  	  <label for="inputIconEx2">Confirm password</label>
		    		  	</div>
		   			</div>
		   		</div>
		   	</div>

		   	<div class="text-center">
		    	<button class="btn mb-4 login-btn" type="submit">Sign in</button>
				</div>
				<p class="text-center mb-4" style="color: white;">Already a member?
		        <a href="<?php echo getAlgosLink('login'); ?>">Login</a>
		    </p>

		</form>
	</div>



	<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="../bootstrap/js/mdb.js"></script>
</body>
</html>
