<?php
	include_once "../algos/client/access_control.php";
	ac_require_login();
?>

<html>
  <head>
    <title>Questions</title>
    <link rel="stylesheet" type="text/css" href="../test/css/style.css">
	  <script type="text/javascript" src="../test/js/test.js"></script>
  </head>
  <body class="body">
    <div class="container">
      <div class="row">
        <div class="col-lg questions">
          <h1 class="h1-responsive" style="padding-top: 10px; text-align:center;">Domande</h1>
          <br>
          <form class="p-5">
      			<div class="domandelist">

      			</div>
          </form>
        </div>
      </div>
    </div>

	<script>
		initPage();
	</script>
  </body>

</html>
