<?php

use App\Core\Database;

class migrationexampledown1682602730
{
	public function down()
	{
		$db = Database::$db;
		$db->exec("TRUNCATE TABLE users");
	}
}
