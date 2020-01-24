<?php
	if (array_key_exists("action", $_POST) &&
		array_key_exists("image_id", $_POST)&&
		array_key_exists("poster_id", $_POST))
	{
		session_start();
		require_once("../model/likeModel.php");
		require("../config/database.php");
		require("../model/User.Class.php");
		$poster = new User($_POST['poster_id'], $dbh);
		switch ($_POST["action"]) {
			case "add":
				add_like_db($_POST["image_id"], $_SESSION['user_id'], $dbh);
				if ($poster->getCommentmail() == 1)
				{
					require("sendmail.php");
					sendmail($poster->getEmail(), "New like on your image [Camagru]", "Hey Seems like you got a new like on one of your picture
					
					
					Come and see it on ourwebsite ! :D");
				}
				break;
			case "remove":
				remove_like_db($_POST["image_id"], $_SESSION['user_id'], $dbh);
				break;
			default:
				echo "An error occured (Bad Action), please try again later";
				break;
		}
	}
	else
		echo "An error occured, please try again later";
?>
