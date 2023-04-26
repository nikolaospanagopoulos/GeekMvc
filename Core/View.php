<?php


namespace Core;

use App\Auth;
use App\Config;
use App\Flash;

class View
{

	public static function getTemplate($view, $args = [])
	{
		//$value = 'something from somewhere';
		//args put in here are available in all templates
		$args['mainUrl'] = Config::mainUrl;
		extract($args, EXTR_SKIP);
		//we use __DIR__ for the php server
		$file = dirname(__DIR__) . "/App/Views/$view";
		if (is_readable($file)) {
			ob_start();
			require $file;
			return ob_get_clean();
		} else {
			throw new \Exception("File not found $file");
		}
	}
	public static function render($view, $args = [])
	{
		echo static::getTemplate($view, $args);
	}
};
