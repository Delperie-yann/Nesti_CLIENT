<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticlePriceModel extends Model
{  
  
    protected $table         = 'articleprice';
      /**
     * @var array<string> $allowedFields 
     */
    protected $allowedFields = ['idArticlePrice','dateStart','price','idArticle'];
    protected $returnType    = 'App\Entities\ArticlePrice';
    // protected $useTimestamps = true;
  

}