<?php

namespace App\Entities;

use CodeIgniter\Entity;
use App\Models\UnitModel;
use App\Models\ProductModel;

class Ingredientrecipe extends Entity
{

   /**
    * @param string $number
    * @return UnitModel|string
    */
   public function getUnit()
   {
      $unit = new UnitModel();
      $compose = $unit->where('idUnit', $this->idUnit)->find();
      $idNameUnit =  $compose? $compose[0]->name:"";
      return   $idNameUnit;
   }
   /**
    * @param string $number
    * @return ProductModel|string
    */
   public function getProdName()
   {
      $prod = new ProductModel();
      $product = $prod->where('idProduct', $this->idProduct)->find();

      $idNameProd = $product?$product[0]->name:"";
      return   $idNameProd;
   }
}
