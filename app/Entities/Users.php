<?php

namespace App\Entities;

use CodeIgniter\Entity;
use App\Models\CityModel;

class Users extends Entity
{


   /**
    * @param string $number
    * @return CityModel|null
    */
   public function getTown(string $number)
   {
      $grade = new CityModel();
      $cityName = $grade->where('idCity', $number)->find();
      $Rating = $cityName[0]->name;
      return   $Rating;
   }

   /**
    * @param string $plaintextPassword
    *  @property string $passwordHash
    * @return Users|bool
    */
   public function isPassword(string $plaintextPassword)
   {
      return password_verify($plaintextPassword, $this->passwordHash);
   }
}
