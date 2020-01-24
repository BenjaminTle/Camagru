<?php
if (array_key_exists('image_id', $_POST))
		{
			require_once("../model/indexModel.php");
			require("../config/database.php");
			delete_image($dbh, $_POST['image_id']);
		}
		else {
			require_once("model/User.Class.php");
			require_once("model/indexModel.php");
			require("config/database.php");
			$user = new User($_SESSION['user_id'], $dbh);
			$user_infos = $user->getUserInfo();
			$user_pictures = get_user_image($dbh, $_SESSION['user_id']);
		}
