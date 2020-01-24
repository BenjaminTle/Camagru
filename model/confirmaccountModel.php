<?php 
	function confirmaccount($mail, $dbh){
		if ($dbh->query("SELECT COUNT(*) from users WHERE email='$mail'")->fetchColumn() != 1)
			exit("This account doesn't exist, please try again");
		$dbh->query("UPDATE users SET status = 1 WHERE email='$mail'");
		return 1;
	}
?>