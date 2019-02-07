<?php

/**
 * Questo file deve essere incluso in tutti gli altri file per rendere 
 * funzionante il linking delle classi a run-time
 */

define( 'PROJECTPATH', __DIR__ . '\\..\\..\\..\\' );

function __autoload($class) {
    require PROJECTPATH . $class . '.php';
}

spl_autoload_register("__autoload");