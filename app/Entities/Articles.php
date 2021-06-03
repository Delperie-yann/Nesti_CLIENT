<?php
namespace App\Entities;

use CodeIgniter\Entity;
use App\Models\ArticlesModel;
use App\Models\ProductModel;
use App\Models\ImageModel;
use App\Models\ArticlePriceModel;

class Articles extends Entity
{

        public function getNameOfArticle($idProduct){
                $grade = new ProductModel();
                $ArticleName = $grade->where('idProduct', $idProduct)->find();
             //  var_dump($cityName);
                // foreach ($num as $number){
                $name=$ArticleName[0]->name;
                // }
             return   $name ;
                }

                public function getImageName($idImage){
                        $fomrt = new ImageModel();
                        $image = $fomrt->where('idImage', $idImage)->find();
                      
                        // foreach ($num as $number){
                        $name=$image[0]->name;
                        // var_dump(  $name);
                        // }
                     return   $name ;
                        } 
                        public function getImageExtend($idImage){
                                $fomrt = new ImageModel();
                                $image = $fomrt->where('idImage', $idImage)->find();
                              
                                // foreach ($num as $number){
                                $val=$image[0]->fileExtension;
                                // var_dump(  $name);
                                // }
                             return   $val ;
                                } 
                                public function getPrice($idArticle){
                                 $fomrt = new ArticlePriceModel();
                                 $prix = $fomrt->where('idArticle', $idArticle)->find();
                               
                                 // foreach ($num as $number){
                                 $val=$prix[0]->price;

                                 // var_dump(  $name);
                                 // }
                              return   $val ;
                                 }                  


        // private $idArticle;
        // private $unitQuantity;
        // private $flag;
        // private $dateCreation;
        // private $dateModification;
        // private $idImage;
        // private $idUnit;
        // private $idProduct;

        // /**
        //  * Get the value of idArticle
        //  */
        // public function getIdArticle()
        // {
        //         return $this->idArticle;
        // }

        // /**
        //  * Set the value of idArticle
        //  */
        // public function setIdArticle($idArticle): self
        // {
        //         $this->idArticle = $idArticle;

        //         return $this;
        // }

        // /**
        //  * Get the value of unitQuantity
        //  */
        // public function getUnitQuantity()
        // {
        //         return $this->unitQuantity;
        // }

        // /**
        //  * Set the value of unitQuantity
        //  */
        // public function setUnitQuantity($unitQuantity): self
        // {
        //         $this->unitQuantity = $unitQuantity;

        //         return $this;
        // }

        // /**
        //  * Get the value of flag
        //  */
        // public function getFlag()
        // {
        //         return $this->flag;
        // }

        // /**
        //  * Set the value of flag
        //  */
        // public function setFlag($flag): self
        // {
        //         $this->flag = $flag;

        //         return $this;
        // }

        // /**
        //  * Get the value of dateCreation
        //  */
        // public function getDateCreation()
        // {
        //         return $this->dateCreation;
        // }

        // /**
        //  * Set the value of dateCreation
        //  */
        // public function setDateCreation($dateCreation): self
        // {
        //         $this->dateCreation = $dateCreation;

        //         return $this;
        // }

        // /**
        //  * Get the value of dateModification
        //  */
        // public function getDateModification()
        // {
        //         return $this->dateModification;
        // }

        // /**
        //  * Set the value of dateModification
        //  */
        // public function setDateModification($dateModification): self
        // {
        //         $this->dateModification = $dateModification;

        //         return $this;
        // }

        // /**
        //  * Get the value of idImage
        //  */
        // public function getIdImage()
        // {
        //         return $this->idImage;
        // }

        // /**
        //  * Set the value of idImage
        //  */
        // public function setIdImage($idImage): self
        // {
        //         $this->idImage = $idImage;

        //         return $this;
        // }

        // /**
        //  * Get the value of unit
        //  */

        // public function getIdUnit()
        // {
        //         if ($unit = "UNITE") {
        //                 $this->unit = "";
        //         }

        //         return $this->unit;
        // }

        // /**
        //  * Set the value of unit
        //  */
        // public function setIdUnit($unit): self
        // {
        //         $this->unit = $unit;

        //         return $this;
        // }

        // /**
        //  * Get the value of idProduct
        //  */
        // public function getIdProduct()
        // {
        //         return $this->idProduct;
        // }

        // /**
        //  * Set the value of idProduct
        //  */
        // public function setIdProduct($idProduct): self
        // {
        //         $this->idProduct = $idProduct;

        //         return $this;
        // }

        // public function getName()
        // {
        //         $name = new ModelProduct();
        //         // var_dump($this->idProduct);
        //         $name1 = $name->readOneBy("idProduct", $this->idProduct);

        //         // var_dump($name1);
        //         return  $name1->getName();
        // }

        // public function getPrice()
        // {
        //         $name = new ModelArticleprice();
        //         // var_dump($this->idProduct);
        //         $name2 = $name->readAllBy("idArticle", $this->idArticle);
        //         // prendre le dernier prix de vente
        //         foreach ($name2 as $price) {
        //                 $val = $price->getPrice();
        //         }

        //         return $val;
        // }

        // public function setArticleFromArray($recipe)
        // {

        //         foreach ($recipe as $key => $value) {

        //                 $this->$key = $value;
        //         }
        // }

        // public function getLastimport()
        // {
        //         $name = new ModelImportation();
        //         // var_dump($this->idProduct);
        //         $name3 = $name->readOneBy("idArticle", $this->idArticle);

        //         // var_dump($name3->getImportationDate());
        //         return  $name3->getImportationDate();
        // }

        // public function getStock()
        // {
        //         $name = new ModelLot();
        //         // var_dump($this->idProduct);
        //         $name4 = $name->readOneBy("idArticle", $this->idArticle);

        //         // var_dump($name4->getquantity());
        //         return  $name4->getQuantity();
        // }

        // public function getUnitName()
        // {
        //         $unit = new ModelUnit();
        //         // var_dump($this->idProduct);
        //         $unit1 = $unit->readOneBy("idUnit", $this->idUnit);
        //         $unity = $unit1->getName();
        //         //  var_dump($unity);

        //         // var_dump($unit1->getName());
        //         return  $unity;
        // }

        // public function getType()
        // {
        //         $model = new ModelProduct();
        //         $data  = $model->findChildType("ingredient", "product", $this->getIdProduct());
        //         // var_dump($data);
        //         if ($data != Null) {
        //                 $type = "ingredient";
        //         } else {
        //                 $type = "";
        //         }

        //         return $type;
        // }

        // public function isIngredient(): bool
        // {

        //         return $this->getType() != null;
        // }
        // public function getLots(){
        //         $lot= new ModelLot();
        //         $lot=$lot->readOneBy("idArticle",$this->getIdArticle());
               
        //         return $lot;
        // }
                

        // public function getFactoryName()
        // {
        //         $article = new ModelArticles();
        //         $name = $article->readOneBy("idArticle", $this->getIdArticle());
        //         $factoryName = $name->getUnitQuantity() . " " . ($name->getUnitName() == 'UNITE' ? '' : $name->getUnitName()) . " " . $name->getName();

        //         return  $factoryName;
        // }

        // public function getArticleQuantIn(){
        //         return $this->getLots();
        // }

        // public function getNbBought()
        // {
        //     $totalQuantity = 0;
        //     foreach ($this->getLots() as $lot) {
        //         $totalQuantity += $this->getLots()->getQuantity();
                
        //     }
        //     return $totalQuantity;
        // }
        
        // public function getArticlePrices()
        // {
        //         $model = new ModelArticleprice();
              
        //         $articlePrices = $model->readAllBy("idArticle", $this->getIdArticle());
        //         return $articlePrices;
        // }

        // public function getLastPriceAt(String $dateMax): String
        // {
        //         $maxDate = 0;
        //         $arrayArticlePrice = $this->getArticlePrices();
            
        //         foreach ($arrayArticlePrice as $value) {
        //                 $date = strtotime($value->getDateStart());
        //                 if ($date <= $dateMax) {
        //                         if ($maxDate <  $date) {
        //                                 $maxDate =  $date;
        //                                 $price = $value->getPrice();
        //                         }
        //                 }
        //         }
        //         return $price;
        // }
}