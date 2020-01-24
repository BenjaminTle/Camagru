<?php
require("config/database.php");
require_once("model/galleryModel.php");
require_once("model/User.Class.php");
$pictures = get_all_image($dbh);
$nb_picture = sizeof($pictures);
if (is_array($pictures))
	$pictures = array_reverse($pictures);
$comments = get_all_comment($dbh);

function get_user_infos($user_id, $dbh)
{
	$user = new User($user_id, $dbh);
	return $user->getUserInfo();
}

function image_is_liked($image_id, $user_id, $dbh){
	return(check_like($image_id, $user_id, $dbh));
}

function image_nb_like($image_id, $dbh){
	return(check_nb_like($image_id, $dbh));
}

