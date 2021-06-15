<?php

namespace App\Controllers;

class BuyController extends BaseController
{

   /**
    * index
    *
    * @return void
    */
   public function index()
   {
      $data["slug"]="buy";
      $launchBuy = false;
      helper("form");
      $user = UserController::getLoggedInUser();
      
      if ($_POST != NULL) {
      


        if (isset($_POST['validatepayment'])) {
         $this->luhnpayment();
         die;
      }
         if (isset($_POST['validateOrder'])) {
            $launchBuy = true;
            $this->twig->display('templates/buy.html', ['user' => $user, 'launchBuy' => $launchBuy]);
          die;
         }
      }
      $this->twig->display('templates/buy.html', ['user' => $user]);
   }

   /**
    * luhnpayment
    *
    * @return void
    */
   public function luhnpayment()
   {


      helper("form");
      $user = UserController::getLoggedInUser();
    
      if ($_POST != NULL) {
         $numero=$_POST['card-num'];
        
         $longueur = 16;
         if ((strlen($numero) == $longueur) && preg_match("#[0-9]{" . $longueur . "}#i", $numero)) {
            // si la longueur est bonne et que l'on n'a que des chiffres
            /* on décompose le numéro dans un tableau  */
            for ($i = 0; $i < $longueur; $i++) {
               $tableauChiffresNumero[$i] = substr($numero, $i, 1);
            }
            /* on parcours le tableau pour additionner les chiffres */
            $luhn = 0; // clef de luhn à tester
            for ($i = 0; $i < $longueur; $i++) {
               if ($i % 2 == 0) { // si le rang est pair (0,2,4 etc.)
                  if (($tableauChiffresNumero[$i] * 2) > 9) {
                     // On regarde si son double est > à 9
                     $tableauChiffresNumero[$i] = ($tableauChiffresNumero[$i] * 2) - 9;
                     //si oui on lui retire 9
                     // et on remplace la valeur
                     // par ce double corrigé
                  } else {

                     $tableauChiffresNumero[$i] = $tableauChiffresNumero[$i] * 2;
                     // si non on remplace la valeur
                     // par le double
                  }
               }
               $luhn = $luhn + $tableauChiffresNumero[$i];
               // on additionne le chiffre à la clef de luhn
            }

            /* test de la divition par 10 */
            if ($luhn % 10 == 0) {
               $validationpay=[
                  'name'=>$_POST['card-num']
               ];
               $this->twig->display('templates/buy.html', ['user' => $user, 'validationpay' => $validationpay]);
               return true;
            } else {
               $error=1;
               $this->twig->display('templates/buy.html', ['user' => $user,'error'=>$error]);
               return false;
            }
         } else {
            $errorNumber=1;
            $this->twig->display('templates/buy.html', ['user' => $user,'errorNumber'=>$errorNumber]);
            return false;
            // la valeur fournie n'est pas conforme (caractère non numérique ou mauvaise
            // longueur)
         }
      }


     
   }
}
