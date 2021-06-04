<?php

namespace App\Models;

use CodeIgniter\Model;

class CityModel extends Model
{  
  
    protected $table         = 'city';
      /**
     * @var array<string> $allowedFields 
     */
    protected $allowedFields = ['idCity','name'];
    protected $returnType    = 'App\Entities\City';
    // protected $useTimestamps = true;
  

}