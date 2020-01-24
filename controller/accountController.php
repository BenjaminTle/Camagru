<?php
		if (array_key_exists('image_path', $_POST))
		{
			require_once("../model/accountModel.php");
			require("../config/database.php");
			delete_image($dbh, $_POST['image_path']);
		}
		else if (array_key_exists('comment_check', $_POST))
		{
			require_once("../model/accountModel.php");
			require("../config/database.php");
			session_start();
			switch_comment($dbh, $_POST['comment_check'], $_SESSION['mail']);
		}
		else {
			require_once("model/User.Class.php");
			require_once("model/accountModel.php");
			require("config/database.php");
			$user = new User($_SESSION['user_id'], $dbh);
			$user_infos = $user->getUserInfo();
			$user_pictures = get_user_image($dbh, $_SESSION['user_id']);
		}
