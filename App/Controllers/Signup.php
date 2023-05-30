<?php


namespace Main\App\Controllers;

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
	public function createAction()
	{
		$user = new User($_POST);
		$user->save();
	}
}
