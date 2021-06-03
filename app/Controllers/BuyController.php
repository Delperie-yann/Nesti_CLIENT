<?php

namespace App\Controllers;

class BuyController extends BaseController
{

   public function index()
   { 

      $launchBuy = false;
         helper("form");
         $user = UserController::getLoggedInUser();
         if ($_POST != NULL) {
            if (isset($_POST['validateOrder'])) {
               $launchBuy = true;
               $this->twig->display('templates/buy.html', ['user' => $user, 'launchBuy'=>$launchBuy]);
               die();
            }
         } 
         $this->twig->display('templates/buy.html', ['user' => $user]);
      
   }
}
