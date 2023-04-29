<?php

use App\Core\Database;

class migrationexampleup1682725822
{
	public function up()
	{
		$db = Database::$db;
		$stmt = "CREATE TABLE example ( 
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            post VARCHAR(255) NOT NULL
			)";
$query = $db->prepare($stmt);
$query->execute();
		$db->exec("INSERT INTO example(post) VALUES('example');");
	}
}
