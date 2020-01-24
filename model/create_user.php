<?php
	function create_user(array $new_user, $dbh)
	{
		if(	array_key_exists('name', $new_user) &&
			array_key_exists('lastname', $new_user) &&
			array_key_exists('email', $new_user) &&
			array_key_exists('pseudo', $new_user) &&
			array_key_exists('password', $new_user))
		{
			check_mail_db($dbh, $new_user['email']);
			check_pseudo_db($dbh, $new_user['pseudo']);
			$add_row = "INSERT INTO users(name, lastname, email, pseudo, password) VALUES(:name, :lastname, :email, :pseudo, :password);";
			$prepared_query = $dbh->prepare($add_row);
			$prepared_query->execute(array(
				'name' => $new_user['name'],
				'lastname' => $new_user['lastname'],
				'email' => $new_user['email'],
				'pseudo' => $new_user['pseudo'],
				'password' => $new_user['password']
			));
			echo "ok";
		}
	}

	function check_mail_db($dbh, $email){
		if ($dbh->query("SELECT COUNT(*) from users WHERE email='$email'")->fetchColumn() != 0)
			exit("email already exist, please choose another one");
	}

	function check_pseudo_db($dbh, $pseudo){
		if ($dbh->query("SELECT COUNT(*) from users WHERE pseudo='$pseudo'")->fetchColumn() != 0)
			exit("pseudo already exist, please choose another one");
	}
