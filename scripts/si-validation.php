<?php
	//include_once "password-hash.php";
	
	//$password_hash = new PasswordHash(8, FALSE);
	//$ma_password = $password_hash->HashPassword($bookid);
	include_once "functions.php";
	include_once "query.php";
	
	$ma_con = db_connect(MA_DB);
	
	$token = addslash($_POST['token']);
	$user_id = addslash($_POST['uid']);
	$first_name = addslash($_POST['fname']);
	$last_name = addslash($_POST['lname']);
	$email = addslash($_POST['email']);
	$si_using = addslash($_POST['siusing']);
	
	$row="";
	$row = db_select("SELECT id FROM third_party_login WHERE email='$email' AND user_id='$user_id' AND login_using='$si_using' AND deleted='0'", $ma_con);
	if(!$row){
		execute_query("INSERT INTO third_party_login(first_name, last_name, email, user_id, token, login_using, date_added) VALUES ('$first_name', '$last_name', '$email', '$user_id', '$token', '$si_using', '".date("Y-m-d H:i:s")."')", $ma_con);
	}
	
	$row="";
	$row = db_select("SELECT id, first_name, last_name, email, token FROM third_party_login WHERE email='$email' AND user_id='$user_id' AND login_using='$si_using' AND deleted='0'", $ma_con);
	if($row){
		$_SESSION['ma_user_id'] = stripslashes($row[0]['id']);
		$_SESSION['first_name'] = stripslashes($row[0]['first_name']);
		$_SESSION['last_name'] = stripslashes($row[0]['last_name']);
		$_SESSION['email'] = stripslashes($row[0]['email']);
		$_SESSION['token'] = stripslashes($row[0]['token']);
		
		$_SESSION['is_logged'] = true;
		$_SESSION['si_using'] = $si_using;
		$message = "passed";
	}
	
	echo $message;
?>