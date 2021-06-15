<?php

namespace App\Models;

use CodeIgniter\Model;

class GradesModel extends Model
{

    protected $table         = 'grades';
      /**
     * @var array<string> $allowedFields 
     */
    protected $allowedFields = ['idUsers','idRecipe','rating'];
    protected $returnType    = 'App\Entities\Grades';
    protected $primaryKey = 'idUsers';
    
}