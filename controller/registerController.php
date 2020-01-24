<?php
	if (!array_key_exists('name', $_POST))
		echo "the field name is missing, please fill it before submiting again";
	if (!array_key_exists('lastname', $_POST))
		echo "the field lastname is missing, please fill it before submiting again";
	if (!array_key_exists('email', $_POST))
		echo "the field email is missing, please fill it before submiting again";
	if (!array_key_exists('pseudo', $_POST))
		echo "the field pseudo is missing, please fill it before submiting again";
	if (!array_key_exists('password', $_POST))
		echo "the field password is missing, please fill it before submiting again";
	if (!array_key_exists('confirm', $_POST))
		echo "You need to confirm your password, please fill it before submiting again";
	require_once("../config/regex.php");
	if (checkname($_POST['name']) === 0)
		exit('Your name isn\'t valid, please try another one');
	if (checklastname($_POST['lastname']) === 0)
		exit('Your latname isn\'t valid, please try another one');
	if (checkmail($_POST['email']) === 0)
		exit('Your email isn\'t valid, please try another one');
	if (checkpseudo($_POST['pseudo']) === 0)
		exit('Your pseudo isn\'t valid, please try another one');
	if (checkpassword($_POST['password'], $_POST['confirm']) === 0)
		exit('Password does\'nt match, please try again');
	require_once("../config/database.php");
	require_once("../model/create_user.php");
	create_user(array(
		'name' => $_POST['name'],
		'lastname' => $_POST['lastname'],
		'email' => $_POST['email'],
		'pseudo' => $_POST['pseudo'],
		'password' => hash("whirlpool", $_POST['password'])
		), $dbh);
	require_once("sendmail.php");
	$message = "Hello,
	

To activate your account, please click on the link below or copy/paste it in your browser :
	
http://localhost:8100/camagru/index.php?action=confirm_mail&log=".$_POST['email']."
	
	
---------------
This is an automatic message, please do not reply.";
	sendmail($_POST['email'], "Account Validation [Camagru]", $message);
