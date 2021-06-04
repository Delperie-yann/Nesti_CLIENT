<?php

namespace App\Controllers;
use App\Models\RecipesModel;

use App\Models\UsersModel;

class SuggestController extends BaseController
{
	public function index()
	{
		$user = UserController::getLoggedInUser();
		$recipesModel = new RecipesModel();
		$recipes = $recipesModel->where('flag', 'a')
		->findAll();
       
       
	

		$this->twig->display('templates/suggest.html', ['user' => $user,'recipes' => $recipes]);
	}

}