<!DOCTYPE html>

<?php
	include_once "../../algos/client/access_control.php";
	ac_require_login();
?>

<html>
	<head>
		<title>Algos</title>
		<meta name="viewport" content="width=device-width, initial_scale=1.0">
		<link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/mdb.css">
		<link rel="stylesheet" type="text/css" href="css/overlayloader.css">		<!--div di caricamento-->
		<script type="text/javascript" src="../bootstrap/js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/popper.min.js"></script>
		<script type="text/javascript" src="../provider/serverprovider.js"></script>
		<script type="text/javascript" src="../provider/links.js"></script>
		<script type="text/javascript" src="js/homepage.js"></script>
		<script type="text/javascript" src="js/wsf.js"></script>
	</head>
	<body onload="initHomePage();">
		<!-- over div prova-->
		<div class="overlayloader" id="overdiv">
			<?php include "../loader/index.html"; ?>
		</div>

		<!--Navbar -->
		<nav class="mb-1 navbar navbar-expand-lg navbar-dark menù">
		  <a class="navbar-brand" href="#">Algos</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
		    aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
		    <ul class="navbar-nav ml-auto">
		      <li class="nav-item" id="administratorButton" style="display:none;">
		        <a class="nav-link" href="#">
		          <i class="fas fa-user-tie"></i> Admin
		          <span class="sr-only">(current)</span>
		        </a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="#" data-toggle="modal" data-target="#testModal" id="testButton">
		          <i class="fas fa-tasks"></i> Test
						</a>
		      </li>
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-1" data-toggle="dropdown">
					<i class="fas fa-user"></i><span id="profileButton"> Profile </span>
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-1">
				  <a class="dropdown-item" href="<?php echo getAlgosLink('account'); ?>"><i class="fas fa-cog"></i>  Settings</a>
				  <a class="dropdown-item" href="" onclick="logout(); return false;"><i class="fas fa-sign-out-alt"></i>  Logout</a>
				</div>
		      </li>
		    </ul>
		  </div>
		</nav>
		<!--/.Navbar -->
		<blockquote class="blockquote bq-warning wholesome quote">
		  <p class="bq-title ">News of the day</p>
		  <p  id="wholesomefacts">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores quibusdam dignissimos itaque harum illo!
		    Quidem, corporis at quae tempore nisi impedit cupiditate perferendis nesciunt, ex dolores doloremque!
		    Sit, rem, in?
		  </p>
			<footer class="blockquote-footer mb-3 text-right">Wholesome Facts from catfact.ninja</footer>
		</blockquote>

		  <div class="row">
		    <div class="col graphics">
						<div class="doughnut">
							<canvas id="doughnutChart" style="margin-bottom: 10px;"></canvas>
						</div>
						<div class="line">
							<canvas id="lineChart"></canvas>
						</div>
		    </div>
		    <div class="col">
					<div class="container main-menu text-center">
						<div class="carousel slide top" data-ride="carousel" id="news-carousel">	<!--data-interval="false" per mantenere fermo il carousel in fase di sviluppo-->
							<!-- indicators -->
							<ol class="carousel-indicators"></ol>
							<!-- wrapper for slides -->
						  <div class="carousel-inner"></div>
							<!-- controls -->
						  <a class="carousel-control-prev" href="#news-carousel" role="button" data-slide="prev">
						    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
						    <span class="sr-only">Previous</span>
						  </a>
						  <a class="carousel-control-next" href="#news-carousel" role="button" data-slide="next">
						    <span class="carousel-control-next-icon" aria-hidden="true"></span>
						    <span class="sr-only">Next</span>
						  </a>
						</div>
						<footer class="blockquote-footer mb-3 text-right">Immagini da Unsplash.com</footer>
				</div>
		    </div>
		  </div>

		<!-- Test -->
		<div class="modal fade" id="testModal" tabindex="-1" role="dialog">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title">TEST per lo stress</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body" id="testdiv">
					<?php include "../test/index.php"; ?>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick="commitTest();" id="commitTestButton">Commit your test</button>
			  </div>
			</div>
		  </div>
		</div>

		<!-- Notizia -->
		<div class="modal fade" id="notiziaModal" tabindex="-1" role="dialog">
		  <div class="modal-dialog modal-fluid">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body" id="notiziadiv">
					<?php include "../notizia/index.php"; ?>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>

		<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="../bootstrap/js/mdb.js"></script>
		<script type="text/javascript" src="js/code.js"></script>
	</body>
</html>
