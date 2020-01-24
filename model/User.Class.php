<?php
	//require_once("../config/database.php");
class User {
	/* User Class Variables */ 
	private $user_id;
	private $name;
	private $lastname;
	private $email;
	private $pseudo;
	private $status; // 0 - email non-validated / 1 - email validated / 2 - admin
	private $last_connect;
	private $sub_date;
	private $comment_mail;
	private $reset_pwd;

	/* User Class Automatic Functions (Construct + Destruct) */
	public function __construct($user_id, $dbh)
	{
		$user_info = $dbh->query("SELECT * from users WHERE user_id='$user_id'")->fetch();
		$this->user_id = $user_id;
		$this->name = $user_info['name'];
		$this->lastname = $user_info['lastname'];
		$this->email = $user_info['email'];
		$this->pseudo = $user_info['pseudo'];
		$this->status = $user_info['status'];
		$this->last_connect = $user_info['last_connect'];
		$this->sub_date = $user_info['sub_date'];
		$this->comment_mail =$user_info['comment_mail'];
		$this->reset_pwd = $user_info['reset_pwd'];
	}

	private function check_mail_db($dbh, $email){
		if ($dbh->query("SELECT COUNT(*) from users WHERE email='$email'")->fetchColumn() != 0)
			exit("email already exist, please choose another one");
	}

	private function check_pseudo_db($dbh, $pseudo){
		if ($dbh->query("SELECT COUNT(*) from users WHERE pseudo='$pseudo'")->fetchColumn() != 0)
			exit("pseudo already exist, please choose another one");
	}

	public function check_modifs($dbh, array $modif)
	{
		$modified_user = array(
			'name' => $this->name,
			'lastname' => $this->lastname,
			'email' => $this->email,
			'pseudo' => $this->pseudo,
		);
		foreach ($modif as $key => $value) {
			switch ($key) {
				case 'name':
					if (checkname($value) === 0)
						exit("this name is not valid");
						$modified_user['name'] = $value;
					break;
				case 'lastname':
					if (checklastname($value) === 0)
						exit("this lastname is not valid");
						$modified_user['lastname'] = $value;
					break;
				case 'email':
					if (checkmail($value) === 0)
						exit("this mail is not valid");
						$modified_user['email'] = $value;
					break;
				case 'pseudo':
					if (checkpseudo($value) === 0)
						exit("this pseudo is not valid");
						$modified_user['pseudo'] = $value;
					break;
			}
		}
		$this->modify_user($dbh, $this->user_id, $modified_user);
	}

	public function update_password($dbh, array $passwords)
	{
		$modify_row = "UPDATE `users` SET password = ? WHERE user_id = $this->user_id";
		$preparedd_query = $dbh->prepare($modify_row);
		$preparedd_query->execute(array(
		hash("whirlpool", $passwords['newpassword'])
		));
		echo "ok";

	}
	private function modify_user($dbh, $user_id, array $modified_user){
		$modify_row = "UPDATE users SET `name` = ?, lastname = ?, email = ?, pseudo = ? WHERE user_id = $this->user_id";
		$preparedd_query = $dbh->prepare($modify_row);
		$preparedd_query->execute(array(
			$modified_user['name'],
			$modified_user['lastname'],
			$modified_user['email'],
			$modified_user['pseudo']
		));
		echo "ok";
	}

	public function addhash_pwd($dbh, $user_id)
	{
		$token = sha1(mt_rand(1, 1000));
		$dbh->query("UPDATE `users` SET reset_pwd = '$token' WHERE user_id = $user_id");
		return ($token);
	}

	public function deletehash_pwd($dbh, $user_id)
	{
		$dbh->query("UPDATE `users` SET reset_pwd = NULL WHERE user_id = $user_id");
	}

	/* Get functions */
	public function getId() {
		return $this->user_id;
	}
	public function getName() {
		return $this->name;
	}
	public function getLastname() {
		return $this->lastname;
	}
	public function getEmail() {
		return $this->email;
	}
	public function getPseudo() {
		return $this->pseudo;
	}
	public function getPassword() {
		return $this->password;
	}

	public function getToken() {
		return $this->reset_pwd;
	}

	public function getStatus() {
		return $this->status;
	}

	public function getCommentmail() {
		return $this->comment_mail;
	}

	public function getUserInfo() {
		return array(
			'name' => $this->name,
			'lastname' => $this->lastname,
			'email' => $this->email,
			'pseudo' => $this->pseudo
		);
	}
}
