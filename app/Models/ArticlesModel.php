<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticlesModel extends Model
{  
  
    protected $table         = 'article';
      /**
     * @var array<string> $allowedFields 
     */
    protected $allowedFields = ['idArticle','unitQuantity','flag','dateCreation','dateModification','idImage','idUnit','idProduct','realName'];
    protected $returnType    = 'App\Entities\Articles';
    // protected $useTimestamps = true;
  

}