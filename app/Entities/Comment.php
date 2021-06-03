<?php
namespace App\Entities;

use CodeIgniter\Entity;
use App\Models\UsersModel;

class  Comment  extends Entity
{

    public function getName($id){
        $grade = new UsersModel();
        $userName = $grade->where('idUsers', $id)->find();
     //  var_dump($cityName);
        // foreach ($num as $number){
        $isname=$userName[0]->lastName.' '.$userName[0]->firstName ;
        // }
     return   $isname ;
        }


    // public function getState($entity)
    // {
    //     if ($entity->getFlag() == "a") {
    //         $state = "Approuvé";
    //     } else if ($entity->getFlag() == "b") {
    //         $state = "Bloqué";
            
    //     } else {
    //         $state = "Annulé";
    //     }
    //     return $state;
    
    // }
}

