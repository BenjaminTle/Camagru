<?php

function check_login($dbh, $email, $password){
		if ($dbh->query("SELECT COUNT(*) from users WHERE email='$email'")->fetchColumn() != 1)
			exit("This account doesn't exist, please try again");
		if ($dbh->query("SELECT COUNT(*) from users WHERE email='$email' AND `password`='$password'")->fetchColumn() != 1)
			exit("Wrong password, please try again");
		$user = $dbh->query("SELECT * from users WHERE email='$email' AND `password`='$password'")->fetch();
		return $user;
}
