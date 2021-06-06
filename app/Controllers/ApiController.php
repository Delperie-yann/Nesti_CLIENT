<?php
namespace App\Controllers;

use App\Models\RecipesModel;
use App\Models\ParagraphModel;
use App\Models\TokenModel;
class ApiController extends BaseController
{
 public function index($token)
 {
  return view('api_help');
 }
 public function recipes($token){
  if($this->token($token)==true){
   $model =new RecipesModel();
   $recipes = $model->findAllForApi();
   header('Content-Type: application/json');
   echo json_encode($recipes);
   die;
  }
 }
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
