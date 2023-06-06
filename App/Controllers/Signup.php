<?php


namespace Main\App\Controllers;

use Main\App\Config;
use Main\App\Models\User;
use Main\Core\Controller;
use Main\Core\View;


class Signup extends Controller
{


	public function indexAction()
	{
		View::render("base/base.php", [
			'title' => "Signup",
			'template' => "Signup/Signup.php"



		]);
	}
	public function successAction()
	{
		View::render("base/base.php", [
			'title' => "Success",
			'template' => "Signup/Success.php"
		]);
	}
	public function createAction()
	{
		$user = new User($_POST);
		if ($user->save()) {
			header('Location: ' . Config::mainUrl . '/signup/success', true, 303);
		} else {
			View::render("base/base.php", [
				'title' => "Error",
				'template' => "Signup/Signup.php",
				'errors' => $user->errors,
				'user' => $user
			]);
		}
	}
}
