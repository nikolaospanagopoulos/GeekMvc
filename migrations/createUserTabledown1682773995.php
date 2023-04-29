<?php

use App\Core\Database;

class migrationcreateUserTabledown1682773995
{
	public function down()
	{
		$db = Database::$db;
		//write your query here
		$db->exec("DROP TABLE users");
	}
}
