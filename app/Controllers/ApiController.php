<?php
namespace App\Controllers;

use App\Models\RecipesModel;
use App\Models\ParagraphModel;
use App\Models\TokenModel;
class ApiController extends BaseController
{ 
 /**
  * index
  *
  * @return string
  */
 public function index()
 {
  return view('api_help');
 }
  
 /**
  * recipes
  *
  * @param  mixed $token
  * @return void
  */
 public function recipes($token){
  if($this->token($token)==true){
   $model =new RecipesModel();
   $recipes = $model->findAllForApi();
   header('Content-Type: application/json');
   echo json_encode($recipes);
   die;
  }
 } 
 /**
  * category
  *
  * @param  mixed $token
  * @param  mixed $cat
  * @return void
  */
 public function category($token,$cat)
 {
   if($this->token($token)==true){
   $model =new RecipesModel();
   $recipes = $model->findCatForApi($cat);
   header('Content-Type: application/json');
   echo json_encode($recipes);
   die;
  }
 } 
 /**
  * ingredient
  *
  * @param  mixed $token
  * @param  mixed $idRecipe
  * @return void
  */
 public function ingredient($token,$idRecipe)
 {
  if($this->token($token)==true){
   $model =new RecipesModel();
   $recipes = $model->findIngredientForApi($idRecipe);
   header('Content-Type: application/json');
   echo json_encode($recipes);
   die;
 }
} 
 /**
  * search
  *
  * @param  mixed $token
  * @param  mixed $name
  * @return void
  */
 public function search($token,$name)
 {
  if($this->token($token)==true){
   $model =new RecipesModel();
   $recipes = $model->findRecipeForApi($name);
   header('Content-Type: application/json');
   echo json_encode($recipes);
   die;
  }
 } 
 /**
  * paragraph
  *
  * @param  mixed $token
  * @param  mixed $idRecipe
  * @return void
  */
 public function paragraph($token,$idRecipe)
 {
  if($this->token($token)==true){
   $model2 =new ParagraphModel();
   $recipes = $model2->findParagraphForApi($idRecipe);
   header('Content-Type: application/json');
   echo json_encode($recipes);
   die;
  }
 } 
 /**
  * token
  *
  * @param  mixed $token
  * @return bool
  */
 public function token($token){
  $model3 =new TokenModel();
  $tokenResult = $model3->where("content",$token)->find();
  if($tokenResult!=null){
    $flag=true;
  }else{
    $flag= false;
  }
  return $flag;

 }

}
