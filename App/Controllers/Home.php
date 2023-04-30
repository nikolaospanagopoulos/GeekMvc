<?php


namespace App\App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\App\Models\Home as ModelsHome;

class Home extends Controller
{


	/**
	 *Shows our home page
	 *@return void
	 **/
	public function indexAction()
	{
		$message = ModelsHome::getWelcomeMessage();
		View::render('base/base.php', [
			'title' => "Home",
			'template' => "Home/index.php",
			'scripts' => ['js/Home.js'],
			'cssFiles' => ['css/home.css'],
			"message" => $message->post
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
