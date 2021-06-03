<?php

namespace App\Models;

use CodeIgniter\Model;

class TokenModel extends Model
{
 protected $table         = 'token';
 protected $allowedFields = ['idToken','content','devise'];
 protected $returnType    = 'App\Entities\Token';


}