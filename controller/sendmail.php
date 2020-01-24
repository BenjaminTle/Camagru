<?php
function sendmail($email, $subject, $message){
	$header = "From: camagru-wizard@42.fr";
	$success = mail($email, $subject, $message, $header);
	if (!$success)
		echo error_get_last()['message'];
}
?>
