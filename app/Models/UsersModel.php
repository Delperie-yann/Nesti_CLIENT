<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{  
  
    protected $table         = 'users';
    protected $allowedFields = ['idUsers','lastName','firstName','passwordHash','email','flag','login','address1','address2','zipCode','idCity'];
    protected $returnType    = 'App\Entities\Users';
    // protected $useTimestamps = true;
    protected $primaryKey = 'idUsers';
  
    // public function findByLogin($parameter,$value){
    //     $query =  $this->db->query("SELECT * FROM `users` where $parameter = '$value'");
    //     $data=$query->getRow();
    //     // var_dump($data);  
    //     return $data;
    // }
    public function findUser($login)
    {
       return $this->where("login", $login)->first();

       
    }

}