<?php

use App\Core\Database;

class migrationexampleup1682602730
{
	public function up()
	{
		$db = Database::$db;
		$db->exec('INSERT INTO users (email, firstname, lastname, status) VALUES ("gg@gg.com","nikos","pana","0")');
	}
}
