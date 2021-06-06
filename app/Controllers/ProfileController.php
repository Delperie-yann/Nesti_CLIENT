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

    $lastName  = filter_input(INPUT_POST, 'userLastname', FILTER_SANITIZE_STRING);
    $firstName = filter_input(INPUT_POST, 'userFirstname', FILTER_SANITIZE_STRING);
    $town      = filter_input(INPUT_POST, "userTown", FILTER_SANITIZE_STRING);
    $login     = filter_input(INPUT_POST, 'userLogin', FILTER_SANITIZE_STRING);
    $email     = filter_input(INPUT_POST, 'userEmail', FILTER_VALIDATE_EMAIL);
    $address1  = filter_input(INPUT_POST, 'userAddress1', FILTER_SANITIZE_STRING);
    $address2  = filter_input(INPUT_POST, 'userAddress2', FILTER_SANITIZE_STRING);
    if (isset($_POST['userZipCode'])) {
      $zipCode = filter_var($_POST['userZipCode'], FILTER_SANITIZE_NUMBER_INT);
    }

   // Aaaaaa ^[A-Z]{1}[a-z]{3,20}

    if (isset($_POST['profileForm'])) {
      $error     = 0;
      if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $email)) {
        $data['emailError'] = true;
        $error = 1;
      }
      if (!preg_match("/^[A-Z]{1}[a-z]{3,20}/", $login)) {
        $data['loginError'] = true;
        $error = 1;
      }
      if (!preg_match("/^\d{5}$/", $zipCode)) {
        $error        = 1;
        $data['zipcodeError'] = true;
      }
     
  

      if ($error == 0) {
        $dataUser = [
          'lastName'  => $lastName,
          'firstName' => $firstName,
          'login'     => $login,
          'email'     => $email,
          'address1'  => $address1,
          'address2'  => $address2,
          'zipCode'   => $zipCode,
          'idCity'    => $this->towncontrole($town),
        ];

        $userProfile = new UsersModel();
        $userProfile->update($user->idUsers, $dataUser);
        return redirect()->to('/profile/');
      }
    }
    $this->twig->display('templates/profile.html', $data);
  }

 
  public function countEle($str)
  {

    $length = strlen($str);

    if ($length < 50) {
      if (str_contains("[^a-zA-Z0-9_]", $str) != false) {
        $secur = true;
        var_dump($str);
      }
    } else {
      $secur = false;
    }
    return $secur;
  }

  public static function towncontrole($town)
  {
    if (isset($town)) {
    
    $model  = new CityModel();
    $cities = $model->where('name', $town)->find();
    // $cities[0]->idCity;
    if ($cities == null) {
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
