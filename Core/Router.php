<?php

namespace App\Core;

use PDO;

class Router
{



	protected $routes = [];

	protected $params = [];

	/**
	 *
	 *Add a route to the routing table
	 *@param string $route the route URL
	 *@param array $params Parameters (controller, action)
	 **/
	public function add($route, $params)
	{
		$this->routes[$route] = $params;
	}
	/**
	 *
	 *Get all routes from the routing table
	 *@return array
	 **/
	public function getRoutes()
	{
		return $this->routes;
	}

	/**
	 *
	 *Match a route to the routing table, set the params property if matched
	 *@param string $url the route url
	 *return boolean true if matched, false if not
	 **/
	public function match($url)
	{
		foreach ($this->routes as $route => $params) {
			if ($url == $route) {
				$this->params = $params;
				return true;
			}
		}
		return false;
	}

	/**
	 *
	 * get the currently matched params
	 * @return array
	 **/
	public function getParams()
	{
		return $this->params;
	}
}
