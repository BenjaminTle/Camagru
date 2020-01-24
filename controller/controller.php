<?php
function getHeader()
{
	require_once("view/headerView.php");
}

function registerUser()
{
	require_once("view/registerView.php");
}

function loginUser()
{
	require_once("view/loginView.php");
}

function accountUser()
{
	require_once("view/accountView.php");
}

function logoutUser()
{
	require_once("controller/logoutController.php");
}

function gallery()
{
	require_once("view/galleryView.php");
}
function confirm_account($mail)
{
	require("config/database.php");
	require_once("model/confirmaccountModel.php");
	confirmaccount($mail, $dbh);
	header("Location: http://localhost:8100/camagru");
}

function reset_password($token, $user_id)
{
	require("config/database.php");
	require_once("model/User.Class.php");
	$user = new User($user_id, $dbh);
	if ($token == $user->getToken() && array_key_exists('user_id', $_GET))
		require_once('view/updatepasswordView.php');
	else
		require_once("view/loginView.php");
}

function forgot_password()
{
	require_once("view/forgotpwdView.php");
}