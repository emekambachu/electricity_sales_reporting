<?php

function getUserName($user_id){
	$query = "SELECT id, fname, lname, uname FROM `users` WHERE id = '$user_id'";
	global $db;

	$result = $db->query($query);

	if (!$result) {
	trigger_error('Invalid query: ' . $db->error);
	}

	while($rows = mysqli_fetch_array($result)){
		$fname = $rows['fname'];
        $lname = $rows['lname'];
	}
	$name = $fname.' '.$lname;

	return $name;
}

function getUserImg($id){
    $query = "SELECT id, img FROM `users` WHERE id = '$id'";
    global $db;

    $result = $db->query($query);

    if (!$result) {
        trigger_error('Invalid query: ' . $db->error);
    }

    while($rows = mysqli_fetch_array($result)){
        $img = $rows['img'];
    }

    return $img;
}

function getActiveUserName($user_id){
    $query = "SELECT id, fname, lname, uname FROM `users` WHERE id = '$user_id' AND status = 'active'";
    global $db;

    $result = $db->query($query);

    if (!$result) {
        trigger_error('Invalid query: ' . $db->error);
    }

    while($rows = mysqli_fetch_array($result)){
        $fname = $rows['fname'];
        $lname = $rows['lname'];
    }
    $name = $fname.' '.$lname;

    return $name;
}

function getAdminName($id){
    $query = "SELECT * FROM `admins` WHERE id = '$id'";
    global $db;

    $result = $db->query($query);

    if (!$result) {
        trigger_error('Invalid query: ' . $db->error);
    }

    while($rows = mysqli_fetch_array($result)){
        $name = $rows['name'];
    }

    return $name;
}

function getUserData($user_id){
    $query = "SELECT * FROM `users` WHERE id = '$user_id'";
    global $db;

    $result = $db->query($query);

    if (!$result) {
        trigger_error('Invalid query: ' . $db->error);
    }

    while($rows = mysqli_fetch_array($result)){
        $fname = $rows['fname'];
        $lname = $rows['lname'];
        $mobile = $rows['mobile'];
        $email = $rows['email'];
        $accname = $rows['accname'];
        $bank = $rows['bank'];
        $accnum = $rows['accnum'];
    }
    $name = '<strong>Name:</strong> ' . $fname .' '. $lname.'<br/><strong>Phone Number:</strong> ' . $mobile .'<br/><strong>Email:</strong> '.$email.'<br/><strong>Bank Account Name:</strong> ' .$accname.'<br/><strong>Bank Name:</strong> '.$bank.'<br/><strong>Account Number:</strong> '.$accnum;

    return $name;
}

?>