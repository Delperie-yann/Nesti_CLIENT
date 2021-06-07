<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\RecipesModel;

class TagController extends BaseController
{
    /**
     * 
     */
    public function recipes($cat){
       // $user = UserController::getLoggedInUser();
        $recipesModel = new RecipesModel();
		$recipes = $recipesModel->where('idCat', $cat)
		->findAll();
        foreach($recipes as $recipe){
			if($recipe->idImage==Null){
				$recipe->idImage = "404";
			}

        $this->twig->display('templates/recipes.html', ['recipes' => $recipes]);
    
 }


}
}