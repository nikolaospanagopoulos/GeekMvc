<?php

namespace Main\Core;

class Router
{
	protected $routes = [];
	protected $params = [];

	/**
	 *Adds a route to the routing table
	 *@param string $route the route url
	 *@param array $params the parameters
	 *
	 **/
	public function add($route, $params = [])
	{

		$route = preg_replace('/\//', '\\/', $route);
		$route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
		$route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
		$route = '/^' . $route . '$/i';
		$this->routes[$route] = $params;
		// var_dump($this->routes);

	}

	/**
	 *Get the routes from the routing table
	 *@return array
	 **/
	public function getRoutes()
	{
		return $this->routes;
	}
	/**
	 *
	 *Match the route to the routes of the routing table and set the params for each route
	 *@param string $url the url of the route
	 *@param array $params the url params
	 *@return boolean true if matched, false otherwise
	 **/
	public function match($url)
	{
		foreach ($this->routes as $route => $params) {
			//passing null to preg match is deprecated
			if ($url == null) {
				$url = '';
			}
			if (preg_match($route, $url, $matches)) {

				foreach ($matches as $key => $match) {
					if (is_string($key)) {
						$params[$key] = $match;
					}
				}
				$this->params = $params;

				return true;
			}
		}
		return false;
	}


	public function dispatch($url)
	{
		$url = $this->removeQueryStringVariables($url);
		if ($this->match($url)) {
			$controller = $this->params['controller'];
			$controller = $this->convertToStudlyCaps($controller);
			$controller = $this->getNamespace() . $controller;

			if (class_exists($controller)) {
				$controller_object = new $controller($this->params);

				$action = $this->params['action'];
				$action = $this->convertToCamelCase($action);

				if (preg_match('/action$/i', $action) == 0) {

					$controller_object->$action();
				} else {

					throw new \Exception("Method $action in controller $controller cannot be called directly - remove the Action suffix to call this method");
				}
			} else {
				throw new \Exception('controller class' . $controller . ' doesnt exist');
			}
		} else {
			throw new \Exception("route doesn't match");
		}
	}
	/**
	 *Removes the Query parameters from the url
	 *@param string $url
	 *@return string
	 **/
	protected function removeQueryStringVariables($url)
	{

		if ($url != '') {
			$parts = explode('&', $url, 2);
			if (strpos($parts[0], '=') == false) {
				$url = $parts[0];
			} else {
				$url = '';
			}
			return $url;
		}
	}
	/**
	 *
	 * convert the string to studly caps
	 * ex admin-post to AdminPost
	 * @param string $string the string to modify
	 * @return string
	 **/
	protected function convertToStudlyCaps($string)
	{
		return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
	}

	/**
	 * convert the string to camel case
	 * ex add-new to addNew
	 * @param string $string the string to modify
	 * @return string
	 **/
	protected function convertToCamelCase($string)
	{
		return lcfirst($this->convertToStudlyCaps($string));
	}

	/**
	 *Get the parametes of matched route from the routing table
	 *@return array $params 
	 *
	 **/

	public function getParams()
	{
		return $this->params;
	}

	protected function getNamespace()
	{

		$namespace = "Main\App\Controllers\\";

		if (array_key_exists('namespace', $this->params)) {

			$namespace .= $this->params['namespace'] . '\\';
		}
		return $namespace;
	}
}
