<?php
	session_start();
	if (array_key_exists('text', $_POST) &&
		array_key_exists('image_id', $_POST) &&
		array_key_exists('user_id', $_SESSION) &&
		array_key_exists("poster_id", $_POST))
	{
		require_once("../config/regex.php");
		if(check_comment($_POST['text']) == 1)
		{
			require_once("../model/commentModel.php");
			require("../config/database.php");
			require("../model/User.Class.php");
			$poster = new User($_POST['poster_id'], $dbh);
			add_comment_db(array(
				'text' => $_POST['text'],
				'user_id' => $_SESSION['user_id'],
				'image_id' => $_POST['image_id']
			), $dbh);
			if ($poster->getCommentmail() == 1)
				{
					require("sendmail.php");
					sendmail($poster->getEmail(), "New comment on your image [Camagru]", "Hey Seems like you got a new comment on one of your picture
Come and see it on ourwebsite ! :D");
				}
		}
		else
			exit("Invalid comment, please try again");
	}
	else
		exit("Missing arguments");
