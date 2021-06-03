<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitModel extends Model
{  
  
    protected $table         = 'unit';
    protected $allowedFields = ['idUnit'];
    protected $returnType    = 'App\Entities\Unit';
    // protected $useTimestamps = true;


  
}