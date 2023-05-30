<?php

namespace Main\App\Models;

use Main\Core\Database;
use PDO;

class User extends Database
{
	private $password;
	private $name;
	private $username;
	private $email;
	private $passwordHash;
	public function __construct($data)
	{
		$this->password = $data["password"];
		$this->name = $data["name"];
		$this->username = $data["username"];
		$this->email = $data["email"];
	}
	public function save()
	{
		$this->passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
		$sql = "INSERT INTO users (name, username, email, password_hash) VALUES (:name, :username, :email, :password_hash)";
		$db = static::getDb();
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":name", $this->name, PDO::PARAM_STR);
		$stmt->bindParam(":username", $this->username, PDO::PARAM_STR);
		$stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
		$stmt->bindParam(":password_hash", $this->passwordHash, PDO::PARAM_STR);

		$stmt->execute();
	}
}
