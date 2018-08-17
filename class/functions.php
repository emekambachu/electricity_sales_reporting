<?php

function classAutoLoader($class){
	$class = strtolower($class);
	$thePath = "class/{$class}.php"; //path to classess
	
	if(is_file($thePath) && !class_exists($class)){
		include $thePath;
	}else{
		die("this file named {$class}.php was not found...");
	}
	
}

spl_autoload_register('classAutoLoader');

function redirect($location){
	header("Location: {$location}");
}

?>