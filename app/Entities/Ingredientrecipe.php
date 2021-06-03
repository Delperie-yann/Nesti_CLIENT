<?php
namespace App\Entities;

use CodeIgniter\Entity;
use App\Models\UnitModel;
use App\Models\ProductModel;

class Ingredientrecipe extends Entity
{

//...
public function getUnit($number){
    $unit = new UnitModel();
    $compose = $unit->where('idUnit', $number)->find();
    // var_dump($compose[0]->name);
    // foreach ($num as $number){
    $idNameUnit=$compose[0]->name;
    // }
 return   $idNameUnit ;
    }
 public function getProdName($number){
    $prod = new ProductModel();
    $product = $prod->where('idProduct', $number)->find();
    // var_dump($compose[0]->name);
    // foreach ($num as $number){
    $idNameProd=$product[0]->name;
    // }
 return   $idNameProd ;
    }
//  public function getIdProduct($idArticle){
//    $fomrt = new ProductModel();
//    $idProd = $fomrt->where('idArticle', $idArticle)->find();
 
//    // foreach ($num as $number){
//    $val=$idProd[0]->idProduct;
//    // var_dump(  $val);
//    // }
// return   $val ;
//    } 

}

