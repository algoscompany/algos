<?php
  const links = array(
    "urlHost"=> "http://192.168.0.114",
    "landing" => "",
    "clientPage"=> "algoscl.php",
  	"login"=> "/login/",
    "sign-up"=> "/sign-up/",
  	"home-page"=> "/home-page/",
    "account"=> "/account/",
    "forgotPassword"=> ""
  );

  function getAlgosLink($name){
    if(isset(links[$name])){
      return links['urlHost'] . links[$name];
    }else
      return links['urlHost'];
  }
 ?>
