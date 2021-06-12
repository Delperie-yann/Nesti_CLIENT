<?php

namespace App\Controllers;

use App\Models\CityModel;
use App\Models\UsersModel;

class ProfileController extends BaseController
{
  public function index()
  {

    helper("form");

    $user        = UserController::getLoggedInUser();
    $data = [
      'user' => $user,
    ];
   
    if (isset($_POST['profileForm'])) {
      $rules = [
        'userLastname'   => [
          "rules" => "required|max_length[150]|min_length[3]",
          "errors" => [
            "required" => "Un email est nécessaire",
            "max_length" => "Votre nom ne contient pas assez de caractère",
            "min_length" => "Votre nom ne contient pas assez de caractère"
          ]
        ],
        'userFirstname'   => [
          "rules" => "required|max_length[150]|min_length[3]",
          "errors" => [
            "required" => "Un prénom est nécessaire",
            "max_length" => "Votre prénom contient trop de caractère",
            "min_length" => "Votre prénom ne contient pas assez de caractère"
          ]
        ],
       
        "userZipCode" => [
          "rules" => 'required|regex_match[/^\d{5}$/]',
          "errors" => [
              "required" => "Un code postale est nécessaire",
              "regex_match" => "Votre code postal doit contenir 5 chiffres",

          ]
        ],
       
        "userTown" => [
          "rules" => "required|max_length[150]|min_length[3]",
          "errors" => [
              "required" => "Une ville est nécessaire",
              "max_length" => "Votre ville contient trop de caractère",
              "min_length" => "Votre ville ne contient pas assez de caractère"
          ]
        ],
      ];
      if ($this->validate($rules)) {
        $lastName  = $this->request->getPost('userLastname');
        $firstName = $this->request->getPost('userFirstname');
        $town      = $this->request->getPost("userTown");
      
        $address1  = $this->request->getPost('userAddress1');
        $address2  = $this->request->getPost('userAddress2');
        $zipCode   = $this->request->getPost('userZipCode');

        $dataUser = [
          'lastName'  => $lastName,
          'firstName' => $firstName,
          'login'     => $user->login,
          'email'     => $user->email,
          'address1'  => $address1,
          'address2'  => $address2,
          'zipCode'   => $zipCode,
          'idCity'    => $this->towncontrole($town),
        ];

        $userProfile = new UsersModel();
        $userProfile->update($user->idUsers, $dataUser);
        return redirect()->to('/profile/');
      }   else {
        $data["validation"] = $this->validator;
    }
    }
    $this->twig->display('templates/profile.html', $data);
  }




  public static function towncontrole($town)
  {
    if (isset($town)) {

      $model  = new CityModel();
      $cities = $model->where('name', $town)->find();
    
      if ($cities == array()) {
        $data = array(
          'name' => $town,
        );
        $newTown = $model->insert($data, true);
        $idTown  = $newTown;
      } else {
        $idTown = $cities[0]->idCity;
      }
      return $idTown;
    }
  }
}
