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
   public function getUnit(string $number)
   {
      $unit = new UnitModel();
      $compose = $unit->where('idUnit', $number)->find();
      $idNameUnit = $compose[0]->name;
      return   $idNameUnit;
   }
   /**
    * @param string $number
    * @return ProductModel|string
    */
   public function getProdName(string $number)
   {
      $prod = new ProductModel();
      $product = $prod->where('idProduct', $number)->find();

      $idNameProd = $product[0]->name;
      return   $idNameProd;
   }
}
