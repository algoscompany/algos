<?php
	include_once "../../algos/client/access_control.php";
	ac_require_login();
?>

<html lang="en" dir="ltr">
  <head>
  	<link rel="stylesheet" type="text/css" href="../notizia/css/style.css">
    <script type="text/javascript" src="../notizia/js/notizia.js"></script>
  </head>
  <body>
    <div class="container mb-2">
      <h1 class="mt-2 mb-4" id="notiziaTitolo">Titolo</h1>
      <blockquote class="blockquote">
        <p class="mb-0 text-justify" id="notiziaCorpo"></p> <!--Corpo-->
        <footer class="blockquote-footer" id="blockquote">
          <div class="row">
            <div class="col" id="notiziaFonte">
              Fonte
            </div>
            <div class="col text-right" id="notiziaCategoria">
              <cite title="Source Title"> Categoria</cite>
            </div>
          </div>
        </footer> <!--Fonte+categoria-->

      </blockquote>
    </div>
  </body>
</html>
