<?php

namespace App\Controllers;
use App\Models\RecipesModel;

use App\Models\UsersModel;

class SuggestController extends BaseController
{
	public function index()
	{
		//$user = UserController::getLoggedInUser();
		$recipesModel = new RecipesModel();
		$recipes = $recipesModel->where('flag', 'a')
		->findAll();
       
       
		if (UserController::getLoggedInUser()!=array() ){
			$user = UserController::getLoggedInUser();
			$this->twig->display('templates/suggest.html', ['user'=>$user,'recipes' => $recipes]);
		
		}else{
			$this->twig->display('templates/suggest.html', ['recipes' => $recipes]);
		}

	
	}

}