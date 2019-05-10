<?php
  require __DIR__ . "/../server/required/autoload.php";
  require "links.php";
  use algos\server\factory\UtenteProvider;

  /**Se non loggato, rimanda al login*/
  function ac_require_login(){
    $user = UtenteProvider::instance()->getLoggedUser();
    if($user == null){
      if(!checkCookies())
        header("location: " . getAlgosLink('login'));
      else
        header("location: " . getAlgosLink('home-page'));
    }
  }

  /**Se gia loggato, rimanda alla home page*/
  function ac_already_logged(){
    $user = UtenteProvider::instance()->getLoggedUser();
    if($user != null)
      header("location: " . getAlgosLink('home-page'));
  }

  function checkCookies(){
    $em = (isset($_COOKIE['_em']) ? $_COOKIE['_em'] : null);
    $ky = (isset($_COOKIE['_ky']) ? $_COOKIE['_ky'] : null);
    if($em != null && $ky != null){
      $logres = UtenteProvider::instance()->loginByCookie($em, $ky);
      echo $logres;
      return $logres;
    }
    return false;
  }
 ?>
