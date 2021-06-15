<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
 protected $table         = 'product';
   /**
     * @var array<string> $allowedFields 
     */
 protected $allowedFields = ['idProduct'];
 protected $returnType    = 'App\Entities\Product';
 protected $primaryKey = 'idProduct';

}