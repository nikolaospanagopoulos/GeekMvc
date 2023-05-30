<?php

use Main\Core\Database;

class migrationcreateRememberedLoginsdown1682774397
{
	public function down()
	{
		$db = Database::$db;
		//write your query here
		$db->exec("DROP TABLE remembered_logins");
	}
}
