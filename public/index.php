<?php

use Core\Router;

require_once __DIR__ . '/../vendor/autoload.php';



$router = new Router();

$router->add('{controller}/{action}');
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
echo $uri;
if ($router->match($uri)) {
	echo "<pre>";
	var_dump($router->getParams());
	echo "</pre>";
}
