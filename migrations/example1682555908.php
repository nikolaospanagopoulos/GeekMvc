<?php

use App\Core\Database;

class migrationexample1682555908
{
	public function up()
	{
		$db = Database::$db;
		$SQL = "CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(255) NOT NULL,
                firstname VARCHAR(255) NOT NULL,
                lastname VARCHAR(255) NOT NULL,
                status TINYINT DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
		$db->exec($SQL);
	}
	public function down()
	{
	}
}
