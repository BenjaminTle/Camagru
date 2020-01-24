<?php
	require_once("config/setup.php");
	require_once("controller/controller.php");
	require_once("config/regex.php");
	require_once("config/database.php");
	session_start();
	getHeader();
	if (isset($_GET['action']))
	{
		switch ($_GET['action']) {
			case 'register':
				registerUser();
				break;
			case 'login':
				loginUser();
				break;
			case 'account':
				accountUser();
				break;
			case 'logout':
				logoutUser();
				break;
			case 'gallery':
				gallery();
				break;
			case 'confirm_mail':
			if (array_key_exists('log', $_GET))
				confirm_account($_GET['log']);
				break;
			case 'reset_password':
			if (array_key_exists('sha', $_GET) &&
				array_key_exists('user_id', $_GET))
				reset_password($_GET['sha'], $_GET['user_id']);
				break;
			case 'forgot_password':
				forgot_password();
		}
	}
	else
		require_once("view/indexView.php");

	require_once("view/footerView.php");
?>
