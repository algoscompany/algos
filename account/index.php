<!DOCTYPE html>

<?php
  include_once "../algos/client/access_control.php";
  ac_require_login();
?>

<html lang="en" dir="ltr">
  <head>
    <title>Account</title>
  	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  	<link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">

  	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  	<link rel="stylesheet" type="text/css" href="css/style.css">
  	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
  	<link rel="stylesheet" type="text/css" href="../bootstrap/css/mdb.css">
  	<script type="text/javascript" src="../bootstrap/js/jquery-3.3.1.min.js"></script>
  	<script type="text/javascript" src="../bootstrap/js/popper.min.js"></script>
    <script type="text/javascript" src="js/account.js"></script>
    <script type="text/javascript" src="../provider/serverprovider.js"></script>
    <script type="text/javascript" src="../provider/links.js"></script>
  </head>
  <body>
    <form class="form-account" action="index.html" method="post" onsubmit="return updateUtenteInfo();" autocomplete="off">
      <div class="container">
        <div class="row mb-7 gearDiv">
          <div class="col-sm" style="text-align: center;">
            <i class="fas fa-cog gear"></i>
          </div>
        </div>
    	  <div class="row mb-5">
    	    <div class="col-sm">
  			      <div class="md-form text-input">
  			  	        <i class="fas fa-envelope prefix"></i>
  			  	        <input type="email" name="email" id="inputIconEx1" class="form-control text-input" onblur="checkChanged(this)" value="...">
  			  	        <label for="inputIconEx1">E-mail address</label>
  			  	  </div>
  			  	<div class="md-form text-input">
  			  	  <i class="fas fa-lock prefix"></i>
  			  	  <input type="password" name="password" id="inputIconEx2" class="form-control text-input" onblur="checkChanged(this)">
  			  	  <label for="inputIconEx2">Password</label>
  			  	</div>
  			</div>
  			<div class="col-sm">
  			  	<div class="md-form text-input">
  			  	  <i class="fas fa-user prefix"></i>
  			  	  <input type="text" name="nome" id="firstName" class="form-control text-input" onblur="checkChanged(this); hideFillAlrt();" value="...">
  			  	  <label for="inputIconEx3">First Name</label>
              <span class="fillAlertSpan" id="firstNameSpan">Inserisci il tuo nome!</span>
  			  	</div>
  			  	<div class="md-form text-input">
  			  	  <i class="fas fa-user prefix"></i>
  			  	  <input type="text" name="cognome" id="lastName" class="form-control text-input" onblur="checkChanged(this); hideFillAlrt();" value="...">
  			  	  <label for="inputIconEx4" id="l">Last Name</label>
              <span class="fillAlertSpan" id="lastNameSpan">Inserisci il tuo cognome!</span>
  			  	</div>
  			</div>
  		</div>
      <div class="row">
          <div class="col-sm text-center">
            <button class="btn btn-primary btn-lg" type="submit"  disabled><i class="fas fa-edit mr-1"></i>  Update</button>
            <button class="btn btn-primary btn-lg" type="button" onclick="backButton();"><i class="fas fa-arrow-left mr-1"></i>  Back</button>
          </div>
      </div>
  	 </div>
   </form>
   <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
 	 <script type="text/javascript" src="../bootstrap/js/mdb.js"></script>
   <script type="text/javascript">
      getUserData();
   </script>
  </body>
</html>
