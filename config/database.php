<?php
/* Connect to a MySQL database using driver invocation */

$dsn = 'mysql:dbname=camagru;host=localhost';
$user = 'root';
$password = 'btollie';

//try {
	$dbh = new PDO($dsn, $user, $password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//} catch (PDOException $e) {
//    echo "Connection failed:" . $e->getMessage();
//}
