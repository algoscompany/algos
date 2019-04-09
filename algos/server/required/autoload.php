<?php

/**
 * Questo file deve essere incluso in tutti gli altri file per rendere 
 * funzionante il linking delle classi a run-time
 */
$inifile = parse_ini_file('autoloadconf.ini');
define( 'PROJECTPATH', __DIR__ . '/../../../');

function invertslash($str){
    return str_replace('\\','/',$str);
}

function __autoload($class) {
    require PROJECTPATH . invertslash($class) . '.php';
}

spl_autoload_register("__autoload");