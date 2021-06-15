<?php

namespace App\Models;

use CodeIgniter\Model;

class ConnectionLogModel extends Model
{  
  
    protected $table         = 'connectionlog';
      /**
     * @var array<string> $allowedFields 
     */
    protected $allowedFields = ['idUserLog','dateConnection','idUsers'];
    protected $returnType    = 'App\Entities\ConnectionLog';
    protected $primaryKey = 'idUserLog';

}