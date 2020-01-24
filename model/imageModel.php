<?php
	function add_image($imagepath, $dbh){
		if(array_key_exists('user_id', $_SESSION))
		{
			$add_row = "INSERT INTO image(`image_path`, `user_id`) VALUES(:image_path, :user_id);";
			$prepared_query = $dbh->prepare($add_row);
			$prepared_query->execute(array(
				'image_path' => $imagepath,
				'user_id' => $_SESSION['user_id']
			));
			echo "ok";
		}
		else
			echo "lol";
	}
	function cancel_image($imagepath, $dbh){
		$imagepath = str_replace("http://localhost:8100/camagru", "..", $imagepath);
		if(array_key_exists('user_id', $_SESSION))
		{
			echo "image cancel";
			if (unlink($imagepath))
			echo "ok";
			else
			echo "no";
		}
	}
