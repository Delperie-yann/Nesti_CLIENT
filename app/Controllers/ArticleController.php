<?php

namespace App\Controllers;


use App\Models\UsersModel;
use App\Models\RecipesModel;
use App\Models\ParagraphModel;
use App\Models\UnitModel;
use App\Models\IngredientrecipeModel;
use App\Models\ProductModel;
use App\Models\GradesModel;
use App\Models\ArticlesModel;

class ArticleController extends BaseController
{
	public function index()
	{
		//$user = UserController::getLoggedInUser();
		$articleModel = new ArticlesModel();
		$articles = $articleModel->findAll();

		foreach ($articles as $article) {
			if ($article->idImage == Null) {
				$article->idImage = "404";
			}
		};
		if (UserController::getLoggedInUser() != array()) {
			$user = UserController::getLoggedInUser();
			$this->twig->display('templates/articles.html', ['user' => $user, 'article' => $articles]);
		} else {
			$this->twig->display('templates/articles.html', ['article' => $articles]);
		}
	}
	public function detailsArticle($idArticle)
	{
		helper("form");
		//$user = UserController::getLoggedInUser();
		$articleModel = new ArticlesModel();
		$article = $articleModel->where('idArticle', $idArticle)
			->findAll();
		$articleObject = $articleModel->where('idArticle', $idArticle)
			->first();

		$compObject = new IngredientrecipeModel();
		$composeObject  = $compObject->where('idProduct', ($articleObject->idProduct))->findAll();
		if ($composeObject != NULL) {
			foreach ($composeObject as $Object) {

				$recipe = new RecipesModel();
				$list = $Object->idRecipe;


				$RecipeName = $recipe->where('idRecipe', $list)->first();
				$RecipeNameObject[] = $RecipeName->name;
			}
		} else {
			$RecipeNameObject[] = "";
		}



		if (UserController::getLoggedInUser() != array()) {
			$user = UserController::getLoggedInUser();
			$this->twig->display('templates/detailArticle.html', ['user' => $user, 'article' => $article, 'compose' => $RecipeNameObject]);
		} else {
			$this->twig->display('templates/detailArticle.html', ['article' => $article, 'compose' => $RecipeNameObject]);
		}
	}

	// $articleModel = new ArticlesModel();
	// $article = $articleModel->where('idArticle', $idArticle)
	// ->first();


	// // var_dump( $article->idProduct);
	// $comp = new IngredientrecipeModel();


	// $compose  = $comp->where('idProduct', ($article->idProduct))->findAll();
	// foreach( $compose as $com){
	// 	var_dump( $com->idRecipe);
	// }

}
