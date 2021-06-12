<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Users;
class UsersModel extends Model
{

    protected $table         = 'users';
    /**
     * @var array<string> $allowedFields 
     */
    protected $allowedFields = ['idUsers', 'lastName', 'firstName', 'passwordHash', 'email', 'flag', 'login', 'address1', 'address2', 'zipCode', 'idCity'];
    protected $returnType    = 'App\Entities\Users';
   
    protected $primaryKey = 'idUsers';

   
    /**
     * @param string $login
     * @return Users|object|null
     */
    public function findUser(string $login) 
    {
        return $this->where("login", $login)->first();
    }
};
