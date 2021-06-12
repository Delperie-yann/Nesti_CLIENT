<?php

namespace App\Models;

use CodeIgniter\Model;


class LotModel extends Model
{
    protected $table         = 'lot';
      /**
     * @var array<string> $allowedFields 
     */
    protected $allowedFields = ['idProduct','idRecipe','quantity','recipePosition','idUnit'];
    protected $returnType    = 'App\Entities\Lot';


   
}