<?php

namespace App\Controllers;

use App\Models\UsersModel;

class UserController extends BaseController
{
    protected static $loggedInUser;
    protected static $dataCart;
    public function index()
    { {

            $data = [];
            helper(['form']);

            $this->twig->display('base.html');
        }
    }
    public function login()
    {

        helper("form");
        $encrypter  = \Config\Services::encrypter();

        // $plainText  = 'This is a plain-text message!';
        // $ciphertext = $encrypter->encrypt($plainText);
        // Outputs: This is a plain-text message!
        // echo $encrypter->decrypt($ciphertext);
        // var_dump($_POST);

        if (!empty($_POST)) {
            // $model->save(['login' => $this->request->getPost('login') ]);
            // $this->input->post('login');
            $_COOKIE['login']    = $login    = $ciphertext    = $encrypter->encrypt($_POST["login"]);
            $_COOKIE['password'] = $password = $ciphertext = $encrypter->encrypt($_POST["password"]);
            $model = new UsersModel();

            $user = $model->findUser($encrypter->decrypt($login));
            // var_dump($login." ".$password);
            // $user->isPassword();

            // var_dump($user->isPassword($password));

            if (isset($password) == true) {
                // password regex : 'A(?=[-_a-zA-Z0-9]*?[A-Z])(?=[-_a-zA-Z0-9]*?[a-z])(?=[-_a-zA-Z0-9]*?[0-9])[-_a-zA-Z0-9]{6,}z'

                // session_start();
                self::setLoggedInUser($user, $password);

                $this->twig->display('templates/intro.html', ['user' => $user]);
            } else {

                $this->twig->display('templates/login.html');
            };
        } else {

            $this->twig->display('templates/login.html');
        }
    }
    public static function getLoggedInUser()
    {
        $encrypter   = \Config\Services::encrypter();
        $passDecript = $encrypter->decrypt($_COOKIE['password']);
        if (self::$loggedInUser == null && isset($_COOKIE['login'])) {
            $model = new UsersModel();
            $user  = $model->findUser($_COOKIE['login']);
            if ($user != null && isset($passDecript)) {
                self::$loggedInUser = $user;
            };
        }
        return self::$loggedInUser;
    }

    public static function setLoggedInUser($user, $plaintextPassword = null)
    {
        $encrypter = \Config\Services::encrypter();
        if ($user != null) {

            self::$loggedInUser = $user;

            $pasdecrypt = $encrypter->decrypt($plaintextPassword);

            setcookie("login", $user->login, 2147483647, '/');
            setcookie("password", $plaintextPassword, 2147483647, '/');
        }
    }

    public function register()
    {
        $encrypter = \Config\Services::encrypter();
        helper(['form']);
        //  var_dump($_POST);

        if (isset($_POST['profileRegister'])) {
            $lastName  = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
            $firstName = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
            $town      = filter_input(INPUT_POST, "city", FILTER_SANITIZE_STRING);
            $login     = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
            $email     = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $address1  = filter_input(INPUT_POST, 'addresse1', FILTER_SANITIZE_STRING);
            $address2  = filter_input(INPUT_POST, 'addresse2', FILTER_SANITIZE_STRING);
            $password  = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $zipcode  = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING);


            $error     = 0;

            if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $email)) {
                $data['email'] = true;
                $error = 1;
            }
            if (!preg_match("/^[a-zA-Z-' ]*$/", $login)) {
                $data['login'] = true;
                $error = 1;
            }
            if (!preg_match("/^\d{5}$/", $zipcode)) {
                $error        = 1;
                $data['zipcode'] = true;
            }

           
            if ($error == 0) {
                $data = [

                    'email'        => $email,
                    'lastName'     => $lastName,
                    'firstName'    => $firstName,
                    'login'        => $login,
                    'passwordHash' => $encrypter->encrypt($password),
                    'address1'     => $address1,
                    'address2'     => $address2,
                    'zipCode'      => $zipcode,
                    'idCity'       => ProfileController::towncontrole($town),
                    'flag'         => 'w',
                ];
                var_dump($data);
                $model = new UsersModel();
                $user  = $model->insert($data);

                return redirect()->to('/login');
            }
        }

        $this->twig->display('templates/register.html');
    }
    public function intro()
    {

        $this->twig->display('layout/partials/_nav.html');
    }
    public function logout()
    {
        helper('cookie');

        // session_destroy();
        setcookie("login", null, 2147483647, '/');
        setcookie("password", null, 2147483647, '/');
        self::setloggedInUser(null);

        $this->twig->display('base.html');
        die();
    }
}
