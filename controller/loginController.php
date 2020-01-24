<?php
	session_start();
	if (!array_key_exists('email', $_POST))
		echo "the field email is missing, please fill it before submiting again";
	if (!array_key_exists('password', $_POST))
		echo "the field password is missing, please fill it before submiting again";
	require_once("../config/regex.php");
	if (checkmail($_POST['email']) === 0)
		exit('Your email isn\'t valid, please try another one');
	require_once("../model/loginModel.php");
	require_once("../config/database.php");
	$user_infos = check_login($dbh, $_POST['email'], hash("whirlpool", $_POST['password']));
	if(array_key_exists("user_id", $user_infos))
	{
		require_once("../model/User.Class.php");
		$user = new User($user_infos['user_id'], $dbh);
		$_SESSION['user_id'] = $user->getId();
		$_SESSION['pseudo'] = $user->getPseudo();
		$_SESSION['name'] = $user->getName();
		$_SESSION['mail'] = $user->getEmail();
		$_SESSION['status'] = $user->getStatus();
		$_SESSION['comment_mail'] = $user->getCommentmail();
		echo "ok"; 
	}	
	else
		exit('Your email isn\'t valid, please try another one');
		
