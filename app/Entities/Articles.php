<?php

namespace App\Entities;

use CodeIgniter\Entity;
use App\Models\ArticlesModel;
use App\Models\ProductModel;
use App\Models\ImageModel;
use App\Models\ArticlePriceModel;
use App\Models\LotModel;
class Articles extends Entity
{

  
   /**
    *
    * @return ProductModel|string
    */
   public function getNameOfArticle()
   {
      $grade = new ProductModel();


     
      $ArticleName = $grade->where('idProduct', $this->idProduct)->find();

      $name = $ArticleName? $ArticleName[0]->name :"";

      return   $name;
   }
   /**
    * @param  $idImage
    * @return ImageModel|string
    */
   public function getImageName( )
   {
      $fomrt = new ImageModel();
      if ($this->idImage != NULL) {
         $image = $fomrt->where('idImage', $this->idImage)->find();
         $name = $image?$image[0]->name:"";
      } else{
         $name = "404image";
      }

      return   $name;
   }
   /**
    * @param  $idImage
    * @return ImageModel|string
    */
   public function getImageExtend( $idImage)
   {
      $fomrt = new ImageModel();
      if ($idImage != NULL) {
      $image = $fomrt->where('idImage', $idImage)->find();
      $val =$image? $image[0]->fileExtension :"";
   } else{
      $val = "jpg";
   }
      return   $val;
   }

   /**
    * 
    * @return ArticlePriceModel|string
    */
   public function getPrice()
   {
      $fomrt = new ArticlePriceModel();
     
      $price = $fomrt->where('idArticle', $this->idArticle)->find();
      if ($price != NULL) {
      $val = $price?$price[0]->price :"";
    } else{
      $val = 0;
   }
      return   $val;
   }
    /**
    * 
    * @return LotModel|string
    */
    public function getLotQuant( )
    {
      $LotModel = new LotModel();
      
      $Lot = $LotModel->where("idArticle", $this->idArticle)->first();
      if($Lot!= Null){
         $val= $Lot->quantity;
      }else{
         $val= 0;
      }
     
      return   $val;
    }
 
   
   
}
