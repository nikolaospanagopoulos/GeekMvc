<?php

namespace App;

class Config
{

	//add application configuration constants here
	const SHOW_ERRORS = true;
	const protocol = PROTOCOL;
	const mainUrl = MAIN_URL;
};

define('PROTOCOL', strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === FALSE ? 'http' : 'https');
define(
	'MAIN_URL',
	\App\Config::protocol . '://' . $_SERVER['HTTP_HOST'] . "/"
);
