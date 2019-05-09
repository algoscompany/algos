<?php
require "../../client/links.php";

function getLink($name){
  echo getAlgosLink($name);
}

function getWsf($limit){
  $html = file_get_contents('https://catfact.ninja/facts?limit='.$limit);
  echo $html;
}

function getImages(){
    $html = file_get_contents("https://api.unsplash.com/photos/?client_id=5a3c81bbe3129ae166f78c17d88d3f20258ba0b94acbc636c0ac6436f57598e8");
    echo $html;
}
