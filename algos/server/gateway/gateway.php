<?php

if(!isset($_GET['funcName'])){
	header('HTTP/1.1 400 Bad Request');
	die();
}

function sampleJson(){
	$data ='
		{
			"nome" : "tommaso",
			"cognome" : "sassoli123"	
		}
	';
	echo $data;
}

function foo(){
	$data = '
	{
		"saluto" : "ciaooooo"
	}
	';
	echo $data;
}

if(function_exists($_GET['funcName'])){
	$_GET['funcName']();
}else{
	header('HTTP/1.1 501 Function Not Implemented');
	die();
}
