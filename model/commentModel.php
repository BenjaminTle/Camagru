<?php
function add_comment_db(array $infos, $dbh)
{
	if(array_key_exists('text',  $infos) &&
	array_key_exists('user_id',  $infos) &&
	array_key_exists('image_id', $infos))
	{
		$add_row = "INSERT INTO comment(image_id, user_id, text) VALUES(:image_id, :user_id, :text);";
		$prepared_query = $dbh->prepare($add_row);
		$prepared_query->execute(array(
			'image_id' => $infos['image_id'],
			'user_id' => $infos['user_id'],
			'text' => $infos['text']
		));
		echo "ok";
	}
	else
		exit("error occured, please try to re-send your comment");
}
