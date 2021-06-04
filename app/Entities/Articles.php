<?php

namespace App\Entities;

use CodeIgniter\Entity;
use App\Models\ArticlesModel;
use App\Models\ProductModel;
use App\Models\ImageModel;
use App\Models\ArticlePriceModel;

class Articles extends Entity
{
   /**
    * @param string $idProduct
    * @return ProductModel|string
    */
   public function getNameOfArticle(string $idProduct)
   {
      $grade = new ProductModel();
      $ArticleName = $grade->where('idProduct', $idProduct)->find();

      $name = $ArticleName[0]->name;

      return   $name;
   }
 /**
    * @param string $idImage
    * @return ImageModel|string
    */
   public function getImageName( string $idImage)
   {
      $fomrt = new ImageModel();
      $image = $fomrt->where('idImage', $idImage)->find();
      $name = $image[0]->name;
      return   $name;
   }
    /**
    * @param string $idImage
    * @return ImageModel|string
    */
   public function getImageExtend( string $idImage)
   {
      $fomrt = new ImageModel();
      $image = $fomrt->where('idImage', $idImage)->find();
      $val = $image[0]->fileExtension;
      return   $val;
   }

     /**
    * @param string $idArticle
    * @return ArticlePriceModel|string
    */
   public function getPrice( string $idArticle)
   {
      $fomrt = new ArticlePriceModel();
      $prix = $fomrt->where('idArticle', $idArticle)->find();
      $val = $prix[0]->price;
      return   $val;
   }


}
