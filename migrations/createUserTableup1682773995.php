<?php

use Main\Core\Database;

class migrationcreateUserTableup1682773995
{
	public function up()
	{
		$db = Database::$db;
		//write your query here
		$db->exec(
			"CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
"

		);
	}
}
