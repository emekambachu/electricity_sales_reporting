<?php

function emailUnique($email){

	global $db;
	$query = "SELECT * FROM `users` WHERE email='$email'";
	$result = $db->query($query);

	if($result->num_rows > 0){
		return false;
	}
		else return true;	
}

//create function for unique username
function unameUnique($uname){

	$query = "SELECT * FROM `users` WHERE uname='$uname'";
	global $db;
	$result = $db->query($query);
	
	if($result->num_rows > 0){
		return false;
	}
		else return true;
		
}

//create function for unique mobile
function mobileUnique($mobile){
	$query = "SELECT * FROM `users` WHERE mobile='$mobile'";
	global $db;
	
	$result = $db->query($query);
	
	if($result->num_rows > 0){
		return false;
		}
		else return true;	
}

//create function for referee greater than 2
function checkRef($ref){
	$query = "SELECT * FROM `users` WHERE uname='$ref'";
	global $db;
	
	$result = $db->query($query);
	
	if($result->num_rows > 0){
		return true;
		}
		else return false;	
}

?>