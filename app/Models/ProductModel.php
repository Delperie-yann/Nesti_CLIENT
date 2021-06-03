<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
 protected $table         = 'product';
 protected $allowedFields = ['idProduct'];
 protected $returnType    = 'App\Entities\Product';


}