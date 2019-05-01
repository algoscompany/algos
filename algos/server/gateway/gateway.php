<?php
include_once __DIR__ . '/usergateway.php';
include_once __DIR__ . '/administratorgateway.php';

require_once __DIR__ . '/../required/autoload.php';

ini_set('display_errors', 0);
// error_reporting(E_ALL);
// ini_set("log_errors", TRUE); 
// ini_set('error_log', __DIR__."/errors/error.log"); 
// error_log("Porca troia"); 

if (! isset($_GET['funcName'])) {
    header('HTTP/1.1 400 Bad Request');
    die();
}

if (function_exists($_GET['funcName'])) {
    header('Content-Type: application/json');    
    if (isset($_POST['json']))
        $_GET['funcName']($_POST['json']);
    else
        $_GET['funcName']();
} else {
    header('HTTP/1.1 501 Function Not Implemented');
    die();
}
