<?php

namespace App\Controllers;

use App\Entities\ArticlePrice;
use App\Models\UsersModel;
use App\Models\RecipesModel;
use App\Models\ParagraphModel;
use App\Models\UnitModel;
use App\Models\IngredientrecipeModel;
use App\Models\ProductModel;
use App\Models\GradesModel;
use App\Models\ArticlesModel;
use App\Models\LotModel;

class ArticleController extends BaseController
{
	public function index()
	{

	
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
	{$data["slug"]="article";
		helper("form");
		
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
				$RecipeNameObject[] = $RecipeName;
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

	

}
