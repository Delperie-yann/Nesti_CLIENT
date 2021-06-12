<?php

namespace App\Controllers;
use App\Models\RecipesModel;

use App\Models\UsersModel;

class SuggestController extends BaseController
{
	public function index()
	{
		$data["slug"]="suggest";
		
		//$user = UserController::getLoggedInUser();
		$recipesModel = new RecipesModel();
		$recipes = $recipesModel->where('flag', 'a')
		->findAll();
       
		$data["recipes"]=$recipes;
		if (UserController::getLoggedInUser()!=array() ){
			$user = UserController::getLoggedInUser();
			$data["user"]=$user;
			$this->twig->display('templates/suggest.html', $data);
		
		}else{
			$this->twig->display('templates/suggest.html', $data);
		}

	
	}

}