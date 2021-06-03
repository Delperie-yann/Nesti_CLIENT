<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{  
  
    protected $table         = 'comment';
    protected $allowedFields = ['idRecipe','idUsers','commentTitle','commentContent','flag'];
    protected $returnType    = 'App\Entities\Comment';
    // protected $useTimestamps = true;
    protected $primaryKey = 'idUsers';

}