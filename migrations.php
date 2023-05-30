<?php

use Main\Core\Database;

if (!isset($argv[1])) {
	die("Please add a migration type: up or down");
}
$x = $argv[1];
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
$db  = Database::setDb($config);
if ($argv[1] == 'up') {
	Database::applyMigrations();
}
if ($argv[1] == 'down') {
	Database::applyDownMigrations();
}
