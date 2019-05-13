<?php

use algos\server\entity\Utente;
use algos\server\factory\RispostaProvider;

require "../../client/links.php";

function getLink($name){
  echo getAlgosLink($name);
}

function getWsf($limit){
  $html = file_get_contents('https://catfact.ninja/facts?limit='.$limit);
  echo $html;
}

// SOLO PER DEBUG
function calcEu(){
    echo RispostaProvider::instance()->calcEustressForUtente(new Utente("pappa@gmail.com", ""));
}

function printUserCookies(){
    echo $_COOKIE['_em']."<br/>";
    echo $_COOKIE['_ky'];
}