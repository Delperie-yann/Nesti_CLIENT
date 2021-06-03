<?php
namespace App\Entities;

use CodeIgniter\Entity;
use App\Models\CityModel;

class Users extends Entity
{

   public function getTown($number){
      $grade = new CityModel();
      $cityName = $grade->where('idCity', $number)->find();
   //  var_dump($cityName);
      // foreach ($num as $number){
      $Rating=$cityName[0]->name;
      // }
   return   $Rating ;
      }


   public function isPassword($plaintextPassword)
   {
      return password_verify($plaintextPassword, $this->passwordHash);
   }
//  

}