<?php

define("EMPTYVAL", "@nullvalue@");

function call_overload($obj, $args, $method_name, $unset_first = true){
	$class_name = get_class($obj);
	$args_length = count($args);
	$method_names = preg_grep('/^'.$method_name.'/', get_class_methods($obj));
	
	if($unset_first)
		unset($method_names[0]);
		
	foreach($method_names as $mn){
		$r = new ReflectionMethod($class_name, $mn);
		$params = $r->getNumberOfParameters();
		
		if($params == $args_length){
			$r->invokeArgs($obj, $args);
			break;
		}
	}
}

function clear_array_args(array &$args){
	$res = array();
	foreach($args as $v){
		if($v !== EMPTYVAL){
			$res[] = $v;
		}
	}
	$args = $res;
}