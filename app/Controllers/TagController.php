<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\RecipesModel;

class TagController extends BaseController
{
    public function recipes($cat){
        // var_dump($cat);

        $user = UserController::getLoggedInUser();
        $recipesModel = new RecipesModel();
		$recipes = $recipesModel->where('idCat', $cat)
		->findAll();
        foreach($recipes as $recipe){
			if($recipe->idImage==Null){
				$recipe->idImage = "404";
			}

        $this->twig->display('templates/recipes.html', ['user' => $user,'recipes' => $recipes]);
    
 }



    // public function allTags()
    // {
    //     $model = new UsersModel();
    //     $tags = $model->findAll();
        
    //     $this->twig->display('tag/allTags.html', ['tags' => $tags]);
    // }

    // public function createTag()
    // {
    //     helper("form");
    //     $model = new TagModel();

    //     if (isset($_POST['name'])) {
    //         $rules = [
    //             'name' => 'required|is_unique[tag.name]',
    //         ];

    //         if ($this->validate($rules)) {

    //             $data  = ['name' => $_POST['name']];
    //             $model->insert($data);
    //             $newId = $model->getInsertID();
    //             return redirect()->to(base_url('tags/' . $newId));
    //         }

    //         return $this->twig->render('tag/createTag.html', ['validation' => $this->validator,]);
    //     }

    //     $this->twig->display('tag/createTag.html');
    // }

    // public function editTag($id)
    // {
    //     $model = new TagModel();
    //     $tag = $model->find($id);
    //     if (isset($_POST['name'])) {

    //         $rules = [
    //             'name' => 'required|is_unique[tag.name, id, '.$id.']',
    //         ];

    //         if ($this->validate($rules)) {

    //             $data  = ['name' => $_POST['name']];
    //             $model->update($id, $data);

    //             return redirect()->to(base_url('tags/' . $id));
    //         }

    //         return $this->twig->render('tag/editTag.html', ['validation' => $this->validator, 'tag' => $tag]);
    //     }

    //     $this->twig->display('tag/editTag.html', ['tag' => $tag]);
    // }

    // public function read($id)
    // {
    //     $model = new TagModel();
    //     $tag = $model->find($id);
    //     $this->twig->display('tag/oneTag.html', ['tag' => $tag]);
    // }

    // public function searchTag()
    // {   
        
    //     $this->twig->display('tag/searchTag.html');
    // }
}
}