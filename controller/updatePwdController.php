<?php
if (array_key_exists('user_id', $_POST)){
	require("../model/User.Class.php");
	require("../config/database.php");
	require("sendmail.php");
	$user = new User($_POST['user_id'], $dbh);
	$token = $user->addhash_pwd($dbh, $user->getId());
	sendmail($user->getEmail(), "Password reset [Camagru]", "Hey, You've asked to reset your password
	
	Please follow this link to do so !
	http://localhost:8100/camagru/?action=reset_password&sha=".$token."&user_id=".$user->getId());
	echo "ok";
} else if (array_key_exists('mail', $_POST)){
	require("../model/User.Class.php");
	require("../config/database.php");
	require("sendmail.php");
	$mail = $_POST['mail'];
	$user = $dbh->query("SELECT * FROM users WHERE email = '$mail'")->fetchAll();
	if (!empty($user))
	{
		$user = new User($user[0]['user_id'], $dbh);
		$token = $user->addhash_pwd($dbh, $user->getId());
	sendmail($user->getEmail(), "Password reset [Camagru]", "Hey, You've asked to reset your password
	
	Please follow this link to do so !
	http://localhost:8100/camagru/?action=reset_password&sha=".$token."&user_id=".$user->getId());
		echo "ok";
	} else
		echo "Wrong e-mail, please check you email is valid";
} else
	echo "An error Occured, please try again later";