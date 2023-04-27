<?php

namespace App\Core;

abstract class Controller
{
	protected $routeParams = [];

	public function __construct($routeParams)
	{
		$this->routeParams = $routeParams;
	}
	public function __call($name, $arguments)
	{
		$method = $name . 'Action';
		if (method_exists($this, $method)) {
			if ($this->before() !== false) {
				call_user_func_array([$this, $method], $arguments);
				$this->after();
			}
		} else {
			throw new \Exception("Method not found in controller");
		}
	}
	/**
	 *Runs before the action
	 *if returns false, action will not be executed
	 *@return void || false
	 **/
	protected function before()
	{
	}
	/**
	 *Runs after the action
	 *
	 **/
	protected function after()
	{
	}
}
