<?php

namespace Core;

use PDO;

class Database
{
	public static $pdo;

	public static function getDb($config)
	{

		$dsn = $config['dsn'] ?? '';
		$user = $config['user'] ?? '';
		$password = $config['password'] ?? '';
		self::$pdo = new PDO($dsn, $user, $password);
		self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return self::$pdo;
	}
};
