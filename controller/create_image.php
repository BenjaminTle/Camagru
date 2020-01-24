<?php
require_once("../config/database.php");
session_start();
switch ($_POST['action']) {
	case 'build':
		$dest_64encoded = str_replace(' ', '+', $_POST['dst']);
		$source_64encoded = str_replace(' ', '+', $_POST['src']);
		$dest = imagecreatefromstring(base64_decode($dest_64encoded));
		$source = imagecreatefromstring(base64_decode($source_64encoded));
		$return = imagecopy($dest,
					$source, 
					$_POST['dst_x'], 
					$_POST['dst_y'],
					$_POST['src_x'],
					$_POST['src_y'],
					$_POST['src_w'],
					$_POST['src_h']
		);
		$date = date_create();
		$imgName = "../images/" . date_timestamp_get($date) . "-" .  rand() . ".png";
		imagepng($dest, $imgName, 0);
		echo($imgName);
		break;
	case 'save':
		require_once("../model/imageModel.php");
		add_image($_POST['imagepath'], $dbh);
		break;
	case 'cancel':
		require_once("../model/imageModel.php");
		cancel_image($_POST['imagepath'], $dbh);
		break;
	default:
		echo "error";
		break;
}


?>
