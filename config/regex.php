<?php

function checkname($name)
{
	return(preg_match("/^[A-Za-z'àáâãäåçèéêëìíîïðòóôõöùúûüýÿ-]+$/i", $name));
}

function checklastname($lastname)
{
	return(preg_match("/^[A-Za-z'àáâãäåçèéêëìíîïðòóôõöùúûüýÿ-]+$/i", $lastname));
}

function checkmail($email)
{
	if (filter_var($email, FILTER_VALIDATE_EMAIL))
		return(preg_match('/^[^\W][a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/i', $email));
	else
		return 0;
}

function checkpseudo($pseudo)
{
	return(preg_match("/^[A-Za-z0-9'-]+$/i", $pseudo));
}

function checkpassword($password, $confirm)
{
	if ($password === $confirm)
		return preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/i", $password);
	return 0;
}

function check_comment($comment)
{
	return(preg_match("/^[\s\d\w\.-_,\/\\àáâãäåçèéêëï][^<^>]{1,500}$/i", $comment));
}
