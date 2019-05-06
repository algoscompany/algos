<?php
  const links = array(
    "urlHost"=> "http://localhost",
    "clientPage"=> "algoscl.php",
  	"login"=> "/algos_gr/login/",
    "sign-up"=> "/algos_gr/sign-up/",
  	"home-page"=> "/algos_gr/home-page/",
    "account"=> "/algos_gr/account/",
    "forgotPassword"=> ""
  );

  function getAlgosLink($name){
    if(isset(links[$name])){
      return links['urlHost'] . links[$name];
    }else
      return links['urlHost'];
  }
 ?>
