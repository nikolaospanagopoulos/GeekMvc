<?php
//todo remove in production
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
	echo 'This is a server using Windows!';
} else {
	session_save_path("/tmp");
}
session_start();

use Main\Core\Database;
use Main\Core\Router;

require_once __DIR__ . '/../vendor/autoload.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

set_error_handler('Main\Core\Error::errorHandler');
set_exception_handler('Main\Core\Error::exceptionHandler');

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$router = new Router();

$config = [
	'dsn' => $_ENV['DB_DSN'],
	'user' => $_ENV['DB_USER'],
	'password' => $_ENV['DB_PASSWORD'],
];
$db  = Database::setDb($config);

$router->add('', ['controller' => "Home", 'action' => 'index']);
$router->add('signup', ['controller' => "Signup", 'action' => 'index']);
$router->add('login', ['controller' => "Login", 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
$router->add('{controller}/{id:\d+}/{action}');
$router->add('{controller}/{id:\d+}/{action}/{idex:\d+}/{actionx}');

/**
 *Get the query string for both XAMPP and php dev server
 *@return string || null
 **/
function getServerQueryString()
{
	if (isset($_SERVER['QUERY_STRING'])) {
		return $_SERVER['QUERY_STRING'];
	} elseif (isset($_SERVER['REQUEST_URI'])) {
		$str = $_SERVER['REQUEST_URI'];
		//remove last char for query string to be valid
		if (substr($str, -1) == '/') {
			$str = rtrim($str, '/');
		}
		return ltrim($str, '/');
	}

	return null;
}

$uri = getServerQueryString();
$router->dispatch($uri);
