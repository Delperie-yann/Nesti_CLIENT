<?php

namespace App\Models;

use CodeIgniter\Model;

class ImageModel extends Model
{  
  
    protected $table         = 'image';
      /**
     * @var array<string> $allowedFields 
     */
    protected $allowedFields = ['idImage','dateCreation','name','fileExtension'];
    protected $returnType    = 'App\Entities\Images';
    // protected $useTimestamps = true;
}
