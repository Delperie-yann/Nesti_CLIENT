<?php

namespace App\Models;

use CodeIgniter\Model;

class TokenModel extends Model
{
 protected $table         = 'token';
   /**
     * @var array<string> $allowedFields 
     */
 protected $allowedFields = ['idToken','content','devise'];
 protected $returnType    = 'App\Entities\Token';


}