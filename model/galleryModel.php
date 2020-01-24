<?php

function get_all_image($dbh){
	if ($dbh->query("SELECT * from image")->fetchColumn() == 0)
			return NULL;
	return ($dbh->query("SELECT * from image")->fetchAll(PDO::FETCH_ASSOC));
}

function get_all_comment($dbh){
	if ($dbh->query("SELECT * from comment")->fetchColumn() == 0)
		return null;
	return ($dbh->query("SELECT * from comment")->fetchAll(PDO::FETCH_ASSOC));
	

}

function check_like($image_id, $user_id, $dbh)
{
	if ($dbh->query("SELECT COUNT(*) from likes WHERE user_id='$user_id' AND image_id='$image_id'")->fetchColumn() == 0)
		return (0);
	else
		return (1);
}

function check_nb_like($image_id, $dbh)
{
	$result = $dbh->query("SELECT COUNT(*) from likes WHERE image_id='$image_id'")->fetchAll();
	return($result[0][0]);
}

