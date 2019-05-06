<?php
  require __DIR__ . "/../server/required/autoload.php";
  require "links.php";
  use algos\server\factory\UtenteProvider;

  /**Se non loggato, rimanda al login*/
  function ac_require_login(){
    $user = UtenteProvider::instance()->getLoggedUser();
    if($user == null)
      header("location: " . getAlgosLink('login'));
  }

  /**Se gia loggato, rimanda alla home page*/
  function ac_already_logged(){
    $user = UtenteProvider::instance()->getLoggedUser();
    if($user != null)
      header("location: " . getAlgosLink('home-page'));
  }
 ?>
