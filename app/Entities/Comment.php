<?php
namespace App\Entities;

use CodeIgniter\Entity;
use App\Models\UsersModel;

class  Comment  extends Entity
{
  /**
    * @param string $id
    * @return UsersModel|string
    */
    public function getName($id){
        $grade = new UsersModel();
        $userName = $grade->where('idUsers', $id)->find();
    
        $isname=$userName[0]->lastName.' '.$userName[0]->firstName ;
      
     return   $isname ;
        }


}

