<?php

namespace Main\Core;

use PDO;

class Database
{
	public static PDO $db;

	public static function setDb($config)
	{

		$dsn = $config['dsn'] ?? '';
		$user = $config['user'] ?? '';
		$password = $config['password'] ?? '';
		$pdo = new PDO($dsn, $user, $password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		self::$db = $pdo;
		return self::$db;
	}
	public static function getDb()
	{
		return self::$db;
	}
	public static function getAppliedMigrations()
	{
		$statement = self::$db->prepare("SELECT migration FROM migrations");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_COLUMN);
	}
	public static function applyDownMigrations()
	{
		$files = scandir(dirname(__DIR__) . "/migrations");
		foreach ($files as $migration) {
			if ($migration === "." || $migration === "..") {
				continue;
			}
			require_once dirname(__DIR__) . "/migrations/" . $migration;
			$className = "migration" . pathinfo($migration, PATHINFO_FILENAME);
			$instance = new $className();
			if (str_contains($className, "up")) {
				continue;
			}
			echo "applying down migration " . $className . PHP_EOL;
			$instance->down();
			echo "applied down migration " . $className . PHP_EOL;
		}
		self::emptyMigrationsTable();
	}
	public static function emptyMigrationsTable()
	{
		self::$db->exec(
			"TRUNCATE TABLE migrations;"
		);
	}
	public static function applyMigrations()
	{
		self::createMigrationTable();
		$appliedM = self::getAppliedMigrations();

		$newMigrations = [];
		$files = scandir(dirname(__DIR__) . "/migrations");
		$toApplyMigrations = array_diff($files, $appliedM);
		foreach ($toApplyMigrations as $migration) {
			if ($migration === "." || $migration === "..") {
				continue;
			}
			require_once dirname(__DIR__) . "/migrations/" . $migration;
			$className = "migration" . pathinfo($migration, PATHINFO_FILENAME);
			$instance = new $className();
			if (str_contains($className, "down")) {
				continue;
			}
			echo "applying migration " . $className . PHP_EOL;
			$instance->up();
			echo "applied migration " . $className . PHP_EOL;
			$newMigrations[] = $migration;
		}
		if (!empty($newMigrations)) {
			self::saveMigrations($newMigrations);
		} else {
			echo "All migrations are applied\n";
		}
	}
	public static function saveMigrations($migrations)
	{
		$migrationsStr = implode(",", array_map(fn ($m) => "('$m')", $migrations));
		$statement = self::$db->prepare("INSERT INTO migrations (migration) VALUES $migrationsStr;");
		$statement->execute();
	}
	public static function createMigrationTable()
	{
		self::$db->exec(
			"CREATE TABLE IF NOT EXISTS migrations(
	id INT AUTO_INCREMENT PRIMARY KEY,
	migration VARCHAR(255),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE = INNODB;"
		);
	}
};
