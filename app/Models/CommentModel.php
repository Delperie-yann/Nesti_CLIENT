<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{  
  
    protected $table         = 'comment';
      /**
     * @var array<string> $allowedFields 
     */
    protected $allowedFields = ['idRecipe','idUsers','commentTitle','commentContent','dateCreation','flag','idModerator'];
    protected $returnType    = 'App\Entities\Comment';
    protected $primaryKey = 'idUsers';

}