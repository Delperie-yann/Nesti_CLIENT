<?php

namespace App\Controllers;


use App\Models\UsersModel;
use App\Models\RecipesModel;

class HomeController extends BaseController
{	
	/**
	 * index
	 *
	 * @return void
	 */
	public function index()
	{
		$user  = UserController::getLoggedInUser();
		
		// $this->twig->display('intro.html', ['user' => $user]);
		
	}


}
