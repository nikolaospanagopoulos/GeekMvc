<?php

use App\Core\Database;

class migrationexampledown1682725822
{
	public function down()
	{
		$db = Database::$db;
		$db->exec("TRUNCATE TABLE example");
	}
}
