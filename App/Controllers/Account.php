<?php

namespace Main\App\Controllers;

use Main\App\Models\User;
use Main\Core\Controller;

class Account extends Controller
{
	/**
	 * Check if the given email already exists in the database
	 * @return bool true if exists, false if not
	 */
	public function validateEmailAction()
	{
	}
}
