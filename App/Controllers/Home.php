<?php


namespace App\App\Controllers;

use App\Core\Controller;
use App\Core\View;


class Home extends Controller
{



	public function indexAction()
	{
		View::render('base.php', [
			'title' => "Home",
			'template' => "Home/index.php",
			'scripts' => ['js/Home.js'],
			'cssFiles' => ['css/home.css']
		]);
	}
	/**
	 *Runs before the action
	 *if returns false, action will not be executed
	 *@return void || false
	 **/
	protected function before()
	{
		//echo "before";
	}
	/**
	 *Runs after the action
	 *
	 **/
	protected function after()
	{
		//echo "after";
	}
}
