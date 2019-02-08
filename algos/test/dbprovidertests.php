<?php
   
use algos\server\dbprovider\DbProvider;

require_once __DIR__ . '\..\server\dbprovider\DbProvider.php';

try{
    DbProvider::instance();
}catch(Exception $e){
    echo $e->getMessage();
}