<?php

namespace App\Models;

use CodeIgniter\Model;

class CatModel extends Model
{  
  
    protected $table         = 'cat';
      /**
     * @var array<string> $allowedFields 
     */
    protected $allowedFields = ['id','name'];
    protected $returnType    = 'App\Entities\Tag';
}