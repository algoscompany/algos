<?php

include_once __DIR__.'usergateway.php';
include_once __DIR__.'administratorgateway.php';

if(!isset($_GET['funcName'])){
	header('HTTP/1.1 400 Bad Request');
	die();
}

if(function_exists($_GET['funcName'])){
	$_GET['funcName']();
}else{
	header('HTTP/1.1 501 Function Not Implemented');
	die();
}
