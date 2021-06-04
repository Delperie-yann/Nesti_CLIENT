<?php

namespace App\Controllers;

use App\Entities\Grades;
use App\Models\UsersModel;

use App\Models\RecipesModel;
use App\Models\ParagraphModel;
use App\Models\UnitModel;
use App\Models\IngredientrecipeModel;
use App\Models\ProductModel;
use App\Models\GradesModel;
use App\Models\CommentModel;

/**
 * @property $twig
 */
class RecipeController extends BaseController
{
	
	public function index()
	{
		$user  = UserController::getLoggedInUser();
		$this->twig->display('intro.html', ['user' => $user]);
	}
	public function recipes()
	{
		$user = UserController::getLoggedInUser();
		$recipesModel = new RecipesModel();
		$recipes = $recipesModel->where('flag', 'a')
			->findAll();

		foreach ($recipes as $rec) {
			if ($rec->idImage == Null) {
				$rec->idImage = "404";
			}
		};


		$this->twig->display('templates/recipes.html', ['user' => $user, 'recipes' => $recipes]);
	}
	public function detailsRecipe($id)
	{
		helper("form");
		$user = UserController::getLoggedInUser();
		$recipesModel = new RecipesModel();
		$recipes = $recipesModel->where('idRecipe', $id)
			->findAll();
		foreach ($recipes as $rec) {
			if ($rec->idImage == Null) {
				$rec->idImage = "404";
			}
		};
		$paragraph = new ParagraphModel();
		$Prep = $paragraph->where('idRecipe', $id)->findAll();
		$comp = new IngredientrecipeModel();
		$compose = $comp->where('idRecipe', $id)->find();

		$comm = new CommentModel();
		$comment = $comm->where('idRecipe', $id)->findAll();
		$grad = new GradesModel();
		$data2 = [
			'idRecipe'    => $id,
			'idUsers' => $user->idUsers
		];
		$hisRating = $grad->where($data2)->findAll();


		$this->twig->display('templates/detailRecipe.html', ['user' => $user, 'recipes' => $recipes, 'prep' => $Prep, 'compose' => $compose, 'comment' => $comment, 'ratting' => $hisRating]);
	}


	public function editdetailsrecipe($idRecipe)
	{
		helper("form");
		$user  = UserController::getLoggedInUser();
		$commentTitle  = filter_input(INPUT_POST, 'titleCom', FILTER_SANITIZE_STRING);
		$commentContent = filter_input(INPUT_POST, 'textCom', FILTER_SANITIZE_STRING);
		$rating = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_STRING);
		if ($rating != NULL) {
			$dataGrade = [
				'idUsers' => $user->idUsers,
				'idRecipe' => $idRecipe,
				'rating' => $rating
			];
			$grad = new GradesModel();
			$isExist = $grad->where('idUsers', $user->idUsers);
			if ($isExist == true && $dataGrade != Null) {

				$grad = new GradesModel();
				$grad->replace($dataGrade);
			} else {
				$grad = new GradesModel();
				$grad->insert($dataGrade);
			}
		}

		$data = [
			'idRecipe'    => $idRecipe,
			'idUsers' => $user->idUsers,
			'commentTitle' => $commentTitle,
			'commentContent' => $commentContent,
			'flag' => 'w',
			'idModerator' => '1'


		];


		$userProfile = new CommentModel();
		$dataExist = [
			'idRecipe'    => $idRecipe,
			'idUsers' => $user->idUsers
		];
		$userProfile->where($dataExist)->find();
		if ($userProfile == Null) {
			$userProfile->insert($data);
			
		}

		return redirect()->to('/detailsRecipe/' . $idRecipe);
	}
}
// 