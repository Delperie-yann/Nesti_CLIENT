<?php

namespace App\Models;

use CodeIgniter\Model;

class GradesModel extends Model
{

    protected $table         = 'grades';
    protected $allowedFields = ['idRecipe','idRecipe','rating'];
    protected $returnType    = 'App\Entities\Grades';
    // protected $primaryKey = 'idUsers';
    
}