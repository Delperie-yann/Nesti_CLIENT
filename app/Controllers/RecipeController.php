<?php

namespace App\Controllers;

use App\Entities\Grades;

use App\Models\UsersModel;
use \DateTime; 
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

	
		$this->twig->display('intro.html');
	}
	public function recipes()
	{
		
		$recipesModel = new RecipesModel();
		$recipes = $recipesModel->where('flag', 'a')->findAll();

		foreach ($recipes as $rec) {
			if ($rec->idImage == Null) {
				$rec->idImage = "404";
			}
		};

		if (UserController::getLoggedInUser() != array()) {
			$user = UserController::getLoggedInUser();
			$this->twig->display('templates/recipes.html', ['user' => $user, 'recipes' => $recipes]);
		} else {
			$this->twig->display('templates/recipes.html', ['recipes' => $recipes]);
		}
	}
	public function detailsRecipe($id)
	{
		helper("form");

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
	
		$compose = $comp->where('idRecipe', $id)->findAll();


		$user = UserController::getLoggedInUser();
		$comm = new CommentModel();

		$comment = $comm->where('idRecipe', $id)->findAll();


		if (UserController::getLoggedInUser() != array()) {



			$grad = new GradesModel();
			$data2 = [
				'idRecipe'    => $id,
				'idUsers' => $user->idUsers
			];
			$hisRating = $grad->where($data2)->findAll();
			$this->twig->display('templates/detailRecipe.html', ['user' => $user, 'recipes' => $recipes, 'prep' => $Prep, 'compose' => $compose, 'comment' => $comment, 'ratting' => $hisRating]);
		} else {
			$this->twig->display('templates/detailRecipe.html', ['recipes' => $recipes, 'prep' => $Prep, 'compose' => $compose, 'comment' => $comment]);
		}
	}


	public function editdetailsrecipe($idRecipe)
	{
		helper("form");
		$user  = UserController::getLoggedInUser();
		$commentTitle  =  $this->request->getPost('titleCom',FILTER_SANITIZE_STRING);
		$commentContent =  $this->request->getPost('textCom',FILTER_SANITIZE_STRING);
		$rating =  $this->request->getPost('rating',FILTER_SANITIZE_NUMBER_INT);
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
		if ($commentTitle != "" && $commentContent != "") {
			helper('date');
			
			
		date_default_timezone_set('Europe/Paris');
		$dateNow= date('y-m-d H:i:s');
			
			$data = [
				'idRecipe'    => $idRecipe,
				'idUsers' => $user->idUsers,
				'commentTitle' => $commentTitle,
				'commentContent' => $commentContent,
				'flag' => 'w',
				'idModerator' => '1',
				'dateCreation'=> $dateNow
			];
			$userProfile = new CommentModel();
			$dataExist = [
				'idRecipe'    => $idRecipe,
				'idUsers' => $user->idUsers
			];
			$isExistcomp = $userProfile->where($dataExist)->find();
			if ($isExistcomp == array()) {
				$userProfile->insert($data);
			} else {
				$userProfile->replace($data);
			}
		}
		return redirect()->to('/detailsRecipe/' . $idRecipe);
	}
}
// 