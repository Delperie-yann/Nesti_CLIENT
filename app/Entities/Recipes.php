<?php

namespace App\Entities;

use CodeIgniter\Entity;
use App\Entities\Grades;
use App\Models\GradesModel;
use App\Models\UsersModel;
use App\Models\CatModel;
use App\Models\ImageModel;
use PhpParser\Node\Expr\Cast\String_;

class Recipes extends Entity
{
 /**
    * @param string $number
    * @return Grades|float|int
    */
   public function getGrade(string $number) 
   {
      $grade = new GradesModel();
      $compose = $grade->where('idRecipe', $number)->findAll();
      $tot = 0;
      if ($compose != Null) {
         foreach ($compose as $comp) {
            $ratingOne = (int) ($comp->rating);
            $tot =  $tot + $ratingOne;
         }
         $round = round($tot / count($compose), 1);
      } else {
         $round = 0;
      }
      return   $round;
   }
 /**
    * @param string $number
    * @return UsersModel|null
    */
   public function getComName($number) 
   {
      $name = new UsersModel();
      $compose = $name->where('idUsers', $number)->find();
      $name = $compose ? $compose[0]->name : "";
      return   $name;
   }
    
   /**
    * getCat
    *
    * @return CatModel|null
    */
   public function getCat() 
   {
      $cat = new CatModel();
      $tag = $cat->where('id',$this->idCat)->find();
      $name = $tag ? $tag[0]->name : "";
    
     return   $name;
   }
   /**
    * @param string $idImage
    * @return ImageModel|null
    */
   public function getImageName(string $idImage) 
   {
      $fomrt = new ImageModel();
      $image = $fomrt->where('idImage', $idImage)->find();
      $name = $image?$image[0]->name : "";
      return   $name;
   }
   /**
    * @param string $idImage
    * @return ImageModel|null
    */
   public function getImageExtend(string $idImage)
   {
      $fomrt = new ImageModel();
      $image = $fomrt->where('idImage', $idImage)->find();
      $val = $image? $image[0]->fileExtension: "";
      return   $val;
   }
}
