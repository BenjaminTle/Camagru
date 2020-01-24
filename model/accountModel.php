<?php 

function get_user_image($dbh, $user_id){
	if ($dbh->query("SELECT * from image WHERE user_id = $user_id")->fetchColumn() == 0)
		return NULL;
	return ($dbh->query("SELECT * from image WHERE user_id = $user_id")->fetchAll(PDO::FETCH_ASSOC));
}

function delete_image($dbh, $image_path)
{
	$request = "DELETE FROM `image` WHERE `image`.`image_path` = '$image_path' ";
	$dbh->exec($request);
	echo "ok";
}

function switch_comment($dbh, $checked, $mail)
{
	if ($checked == 1)
	{
		$dbh->query("UPDATE `users` SET `comment_mail` = 0 WHERE email='$mail'");
		echo "ok";
	}
	else if ($checked == 0)
	{
		$dbh->query("UPDATE `users` SET `comment_mail` = 1 WHERE email='$mail'");
		echo "ok";
	}
}
