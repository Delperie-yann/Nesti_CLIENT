<?php

namespace App\Entities;

use CodeIgniter\Entity;
use App\Models\GradesModel;
use App\Models\UsersModel;
use App\Models\CatModel;
use App\Models\ImageModel;

class Recipes extends Entity
{
   // need to have rating in dbb
   public function getGrade($number)
   {
      $grade = new GradesModel();
      $compose = $grade->where('idRecipe', $number)->findAll();
      $tot = 0;
      if ($compose != Null) {
         foreach ($compose as $comp) {
            $ratingOne = (int) ($comp->rating);
            $tot =  $tot + $ratingOne;
         }
         $round = round($tot / count($compose), 0);
      } else {
         $round = 0;
      }
      return   $round;
   }

   public function getComName($number)
   {
      $name = new UsersModel();
      $compose = $name->where('idUsers', $number)->find();


      $name = $compose[0]->name;
      // var_dump($name);
      return   $name;
   }
   public function getCat($number)
   {
      $cat = new CatModel();
      $tag = $cat->where('id', $number)->find();
      $name = $tag[0]->name;
      // var_dump($name);
      return   $name;
   }
   public function getImageName($idImage)
   {
      $fomrt = new ImageModel();
      $image = $fomrt->where('idImage', $idImage)->find();

      // foreach ($num as $number){
      $name = $image[0]->name;
      // var_dump(  $name);
      // }
      return   $name;
   }
   public function getImageExtend($idImage)
   {
      $fomrt = new ImageModel();
      $image = $fomrt->where('idImage', $idImage)->find();

      // foreach ($num as $number){
      $val = $image[0]->fileExtension;
      // var_dump(  $name);
      // }
      return   $val;
   }

   //     private $idRecipe;
   //     private $dateCreation;
   //     private $name;
   //     private $difficulty;
   //     private $portions;
   //     private $flag;
   //     private $preparationTime;
   //     private $idChef;
   //     private $idImage;

   //     /**
   //      * Get the value of dateCreation
   //      */
   //     public function getDateCreation()
   //     {
   //         return $this->dateCreation;
   //     }

   //     /**
   //      * Set the value of dateCreation
   //      *
   //      * @return self
   //      */
   //     public function setDateCreation($dateCreation): self
   //     {
   //         $this->dateCreation = $dateCreation;

   //         return $this;
   //     }

   //     /**
   //      * Get the value of idRecipe
   //      */
   //     public function getIdRecipe()
   //     {
   //         return $this->idRecipe;
   //     }

   //     /**
   //      * Set the value of idRecipe
   //      *
   //      * @return self
   //      */
   //     public function setIdRecipe($idRecipe): self
   //     {
   //         $this->idRecipe = $idRecipe;

   //         return $this;
   //     }

   //     /**
   //      * Get the value of name
   //      */
   //     public function getName()
   //     {
   //         return $this->name;
   //     }

   //     /**
   //      * Set the value of name
   //      *
   //      * @return  self
   //      */
   //     public function setName($name)
   //     {
   //         $this->name = $name;

   //         return $this;
   //     }

   //     /**
   //      * Get the value of difficulty
   //      */
   //     public function getDifficulty()
   //     {
   //         return $this->difficulty;
   //     }

   //     /**
   //      * Set the value of difficulty
   //      *
   //      * @return  self
   //      */
   //     public function setDifficulty($difficulty)
   //     {
   //         $this->difficulty = $difficulty;

   //         return $this;
   //     }

   //     /**
   //      * Get the value of for
   //      */
   //     public function getPortions()
   //     {
   //         return $this->portions;
   //     }

   //     /**
   //      * Set the value of for
   //      *
   //      * @return  self
   //      */
   //     public function setPortions($portions)
   //     {
   //         $this->portions = $portions;

   //         return $this;
   //     }

   //     /**
   //      * Get the value of flag
   //      */
   //     public function getFlag()
   //     {
   //         return $this->flag;
   //     }

   //     /**
   //      * Set the value of flag
   //      *
   //      * @return self
   //      */
   //     public function setFlag($flag): self
   //     {
   //         $this->flag = $flag;

   //         return $this;
   //     }

   //     /**
   //      * Get the value of preparationTime
   //      */
   //     public function getPreparationTime()
   //     {
   //         return $this->preparationTime;
   //     }

   //     /**
   //      * Set the value of preparationTime
   //      *
   //      * @return self
   //      */
   //     public function setPreparationTime($preparationTime): self
   //     {
   //         $this->preparationTime = $preparationTime;

   //         return $this;
   //     }

   //     /**
   //      * Get the value of idChef
   //      */
   //     public function getIdChef()
   //     {
   //         return $this->idChef;
   //     }

   //     /**
   //      * Set the value of idChef
   //      *
   //      * @return self
   //      */
   //     public function setIdChef($idChef): self
   //     {
   //         $this->idChef = $idChef;

   //         return $this;
   //     }

   //     /**
   //      * Get the value of chief
   //      */
   //     public function getChef()
   //     {
   //         $model = new ModelUsers();
   //         $chef = $model->readOneBy("idUsers", $this->getIdChef());
   //         $fullName = $chef->getLastname() .' '. $chef->getFirstname(); 
   //         return $fullName;
   //     }

   //     public function setRecipeFromArray($recipe)
   //     {
   //         // var_dump($recipe);
   //         foreach ($recipe as $key => $value) {

   //             $this->$key = $value;
   //         }
   //     }

   //     /**
   //      * Get the value of idImage
   //      */
   //     public function getIdImage()
   //     {
   //         return $this->idImage;
   //     }

   //     /**
   //      * Set the value of idImage
   //      *
   //      * @return  self
   //      */
   //     public function setIdImage($idImage)
   //     {
   //         $this->idImage = $idImage;

   //         return $this;
   //     }

   //     /*---------------------------------------------------------------*/
   //     /*
   //     Titre : Convertie de secondes en heures, minutes et secondes                                                          

   //     URL   : https://phpsources.net/code_s.php?id=939
   //     Date édition     : 15 Fév 2019                                                                                        
   //     Date mise à jour : 19 Aout 2019                                                                                      
   //     Rapport de la maj:                                                                                                    
   //     - fonctionnement du code vérifié                                                                                    
   // */
   //     /*---------------------------------------------------------------*/

   //     function ConvertisseurTime($Time)
   //     {
   //         if ($Time < 3600) {
   //             $heures = 0;

   //             if ($Time < 60) {
   //                 $minutes = 0;
   //             } else {
   //                 $minutes = round($Time / 60);
   //             }

   //             $secondes = floor($Time % 60);
   //         } else {
   //             $heures = round($Time / 3600);
   //             $secondes = round($Time % 3600);
   //             $minutes = floor($secondes / 60);
   //         }
   //         $secondes2 = round($secondes % 60);

   //         $TimeFinal = "$heures h $minutes min $secondes2 s";
   //         return $TimeFinal;
   //     }

   //     function getIdColor()
   //     {
   //         $color = "text-dark";

   //         if ($this->flag == "a") {
   //             $color = "bg-1";
   //         }
   //         if ($this->flag == "b") {
   //             $color = "bg-2";
   //         }
   //         return $color;
   //     }

   //     public function getImages()
   //     {
   //         $model = new ModelImages();
   //         $images = $model->readOneBy("idImage", $this->getIdImage());
   //         return $images;
   //     }

   //     public function displayImages()
   //     {
   //         $imageName = $this->getImages()->getName();
   //         $imageExtension = $this->getImages()->getFileExtension();
   //         return base_url() . "public/img/recipes/$imageName.$imageExtension";
   //     }

   //     public function getParagraphs()
   //     {
   //         $model = new ModelParagraph();
   //         $paragraphs = $model->readAllBy("idRecipe", $this->getIdRecipe());
   //         return $paragraphs;
   //     }
   //     public function getRatting()
   //     {
   //        $model = new ModelRating();
   //        $logs = $model->readAllBy("idRecipe", $this->getIdRecipe());
   //     //  var_dump(  $logs);
   //        return $logs;
   //     }
}
