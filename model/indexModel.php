<?php

function get_user_image($dbh, $user_id){
	if ($dbh->query("SELECT * from image WHERE user_id = $user_id")->fetchColumn() == 0)
			return null;
	return ($dbh->query("SELECT * from image WHERE user_id = $user_id")->fetchAll(PDO::FETCH_ASSOC));
}

function delete_image($dbh, $image_id)
{
	$request = "DELETE FROM `image` WHERE `image`.`image_id` = '$image_id' ";
	$dbh->exec($request);
	echo "ok";
}
