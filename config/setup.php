<?php 
try {
	$dsni = 'mysql:host=localhost';
	$useri = 'root';
	$passwordi = 'btollie';
	$create_db = new PDO($dsni, $useri, $passwordi);
	$create_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$create_db->query("CREATE DATABASE IF NOT EXISTS camagru");
	$create_db = '';
}
catch (PDOException $e){
	echo "Error".$e->getMessage();
}
require("config/database.php");
$dbh->query("CREATE TABLE IF NOT EXISTS `users`
(`user_id` INT NOT NULL AUTO_INCREMENT ,
 `name` VARCHAR(50) NOT NULL ,
 `lastname` VARCHAR(50) NOT NULL ,
 `pseudo` VARCHAR(100) NOT NULL ,
 `email` VARCHAR(50) NOT NULL ,
 `password` TEXT NOT NULL ,
 `status` TINYINT DEFAULT 0,
 `comment_mail` TINYINT DEFAULT 1,
 `reset_pwd` TEXT DEFAULT NULL,
 PRIMARY KEY (`user_id`))");

$dbh->query("CREATE TABLE IF NOT EXISTS `image`
(`image_id` INT NOT NULL AUTO_INCREMENT ,
 `user_id` INT NOT NULL ,
 `image_path` TEXT(100) NOT NULL ,
 `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`image_id`))");

$dbh->query("CREATE TABLE IF NOT EXISTS `comment`
(`comment_id` INT NOT NULL AUTO_INCREMENT ,
 `image_id` INT NOT NULL ,
 `user_id` INT NOT NULL ,
 `text` TEXT NOT NULL ,
 PRIMARY KEY (`comment_id`))");

$dbh->query("CREATE TABLE IF NOT EXISTS `likes`
(`user_id` INT NOT NULL,
 `image_id` INT NOT NULL)");

$dbh->query("CREATE TABLE IF NOT EXISTS `overlay`
(`overlay_id` INT NOT NULL AUTO_INCREMENT ,
 `overlay_group` INT NOT NULL ,
 `overlay_path` TEXT(100) NOT NULL ,
 PRIMARY KEY (`overlay_id`))");

echo $test;

