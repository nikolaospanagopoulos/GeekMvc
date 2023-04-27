<?php

use App\Core\Database;

require_once __DIR__ . '/vendor/autoload.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
	'dsn' => $_ENV['DB_DSN'],
	'user' => $_ENV['DB_USER'],
	'password' => $_ENV['DB_PASSWORD'],
];
$db  = Database::getDb($config);
Database::applyMigrations();
