<?php

namespace App\Controllers;


use App\Models\UsersModel;
use App\Models\RecipesModel;

class HomeController extends BaseController
{
	public function index()
	{
		$user  = UserController::getLoggedInUser();
		var_dump($user);
		// $this->twig->display('intro.html', ['user' => $user]);
		
	}
// 	public function recipes()
// 	{
// 		$user = UserController::getLoggedInUser();
// 		$recipesModel = new RecipesModel();
// 		$recipes = $recipesModel->where('flag', 'a')
// 		->findAll();
// 		// var_dump($recipes);
// // foreach($recipes as $recipe){
// // 	// var_dump($recipe);
// // }

// 		$this->twig->display('templates/recipes.html', ['user' => $user,'recipes' => $recipes]);
// 	}

}
