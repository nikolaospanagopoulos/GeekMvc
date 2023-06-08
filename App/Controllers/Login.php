<?php


namespace Main\App\Controllers;

use Main\App\Config;
use Main\App\Models\User;
use Main\Core\Controller;
use Main\Core\View;


class Login extends Controller
{


	/**
	 * Show the login page
	 * @return void
	 * */


	public function indexAction()
	{
		View::render("base/base.php", [
			'title' => "Login",
			'template' => "Login/Login.php"



		]);
	}
	/**
	 * Login user
	 * @return void
	 * */
	public function createAction()
	{
		$user = User::authenticate($_POST["email"], $_POST["password"]);
		if ($user) {
			$this->redirect('/');
		} else {
			View::render("base/base.php", [
				'title' => "Login",
				'template' => "Login/Login.php",
				'email' => $_POST['email']
			]);
		}
	}
}
