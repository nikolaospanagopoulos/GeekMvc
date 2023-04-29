<?php

use App\Core\Database;

class migrationcreateRememberedLoginsup1682774397
{
	public function up()
	{
		$db = Database::$db;
		//write your query here
		$db->exec(
			"CREATE TABLE `remembered_logins` (
  `token_hash` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
		);
	}
}
