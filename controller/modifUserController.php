<?php
	require_once("../config/regex.php");
	if ($_POST['action'] === 'updateinfos' &&
	array_key_exists('user_id', $_POST) &&
	array_key_exists('name', $_POST) &&
	array_key_exists('lastname', $_POST) &&
	array_key_exists('email', $_POST) &&
	array_key_exists('pseudo', $_POST))
	{
		$user_id = $_POST['user_id'];
		require_once("../model/User.Class.php");
		require_once("../config/database.php");
		$user = new User($user_id, $dbh);
		$user->check_modifs($dbh, array(
			'name' => $_POST['name'],
			'lastname' => $_POST['lastname'],
			'email' => $_POST['email'],
			'pseudo' => $_POST['pseudo']
		));
		session_start();
		$_SESSION['user_id'] = $user->getId();
		$_SESSION['pseudo'] = $user->getPseudo();
		$_SESSION['name'] = $user->getName();
		$_SESSION['mail'] = $user->getEmail();
		$_SESSION['status'] = $user->getStatus();
		$_SESSION['comment_mail'] = $user->getCommentmail();
		exit();
	}
	else if ($_POST['action'] === 'updatepassword' &&
	array_key_exists('newpassword', $_POST) &&
	array_key_exists('confirm', $_POST) &&
	array_key_exists('user_id', $_POST))
	{
		require_once("../model/User.Class.php");
		require_once("../config/database.php");
		$user = new User($_POST['user_id'], $dbh);
		if (checkpassword($_POST['newpassword'], $_POST['confirm']))
		{
			$user->update_password($dbh, array(
				'newpassword' => $_POST['newpassword']
			));
			$user->deletehash_pwd($dbh, $user->getId());
		}
		else
			exit ("Invalid password or password not matching");
	}
