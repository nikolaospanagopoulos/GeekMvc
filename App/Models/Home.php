<?php

namespace App\App\Models;

use App\Core\Database;
use PDO;

class Home extends Database
{
	public static function getWelcomeMessage()
	{
		$db = static::getDb();
		$stmt = "SELECT * FROM example WHERE id = 1";

		$query = $db->query($stmt);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}
}
