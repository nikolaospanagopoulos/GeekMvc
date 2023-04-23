<?php


require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Application;

$app = new Application();

$router = $app->router;

$router->add('', ['controller' => "Home", 'action' => "index"]);

$url = $_SERVER['QUERY_STRING'];
echo $url;
if ($router->match($url)) {
	echo "<pre>";
	var_dump($router->getParams());
	echo "</pre>";
}
