<?php

namespace Main\App\Models;

use Main\Core\Database;
use PDO;

class User extends Database
{
	public $errors = [];
	private $password;
	public $name;
	public $username;
	public $email;
	private $passwordHash;
	private $passwordConfirmation;
	public function __construct($data)
	{
		$this->password = $data["password"];
		$this->name = $data["name"];
		$this->username = $data["username"];
		$this->email = $data["email"];
		$this->passwordConfirmation = $data["passwordConfirmation"];
	}

	/**
	 *Save the user to the database
	 *@return True if success , false otherwise
	 **/


	public function save()
	{
		$this->validate();
		if (empty($this->errors)) {
			$this->passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
			$sql = "INSERT INTO users (name, username, email, password_hash) VALUES (:name, :username, :email, :password_hash)";
			$db = static::getDb();
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":name", $this->name, PDO::PARAM_STR);
			$stmt->bindParam(":username", $this->username, PDO::PARAM_STR);
			$stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
			$stmt->bindParam(":password_hash", $this->passwordHash, PDO::PARAM_STR);

			return $stmt->execute();
		}
		return false;
	}

	/**
	 *Validate the form data that the user submitted
	 *
	 **/
	public function validate()
	{
		if ($this->name == '') {
			$this->errors[] = "Name is required";
		}
		if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
			$this->errors[] = "invalid email";
		}
		if ($this->emailExists($this->email)) {
			$this->errors[] = "Email already exists";
		}
		if ($this->password != $this->passwordConfirmation) {
			$this->errors[] = "Passwords must match";
		}
		if (strlen($this->password) < 6) {
			$this->errors[] = "Please enter at least 6 characters for the password";
		}
		if (preg_match('/.*[a-z]+.*/i', $this->password) == 0) {
			$this->errors[] = "Password needs at least one letter";
		}
		if (preg_match('/.*\d+.*/i', $this->password) == 0) {
			$this->errors[] = "Password needs at least one number";
		}
	}

	/**
	 *See if email already exists in the database
	 *@param string $email email address to search for 
	 *@return boolean True if email already exists. False otherwise
	 **/
	private function emailExists($email)
	{
		$sql = "SELECT * FROM users WHERE email = :email";
		$db = static::getDb();
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->execute();


		return $stmt->fetch() !== false;
	}
}
