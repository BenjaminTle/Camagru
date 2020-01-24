<?php

function add_like_db($image_id, $user_id, $dbh)
{
	$add_row = "INSERT INTO likes(user_id, image_id) VALUES(:user_id, :image_id);";
			$prepared_query = $dbh->prepare($add_row);
			$prepared_query->execute(array(
				'user_id' => $user_id,
				'image_id' => $image_id
			));
	echo "ok";
}

function remove_like_db($image_id, $user_id, $dbh){
	$delete_row = "DELETE FROM likes WHERE `user_id` = :user_id AND `image_id` = :image_id;";
			$prepared_query = $dbh->prepare($delete_row);
			$prepared_query->execute(array(
				'user_id' => $user_id,
				'image_id' => $image_id
			));
	echo "ok";
}
