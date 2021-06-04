<?php

namespace App\Models;

use CodeIgniter\Model;


class ingredientrecipeModel extends Model
{
    protected $table         = 'ingredientrecipe';
      /**
     * @var array<string> $allowedFields 
     */
    protected $allowedFields = ['idProduct'];
    protected $returnType    = 'App\Entities\Ingredientrecipe';


   
}