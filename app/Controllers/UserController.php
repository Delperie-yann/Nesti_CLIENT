<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Entities\Users;
use App\Config\Services;

class UserController extends BaseController
{
    protected static $loggedInUser;
    protected static $dataCart;


    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $data = [];
        helper(['form']);
        $this->twig->display('base.html');
    }


    /**
     * login
     *
     * @return void
     */
    public function login()
    {

        helper("form");

        if (!empty($_POST)) {
            $error = 0;
            $login     = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
            $password     = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            if (!preg_match("/^[A-Z]{1}[a-z]{3,20}/", $login)) {
                $data['loginError'] = true;
                $error = 1;
            }

            // Test 1: Does the entire string only contain 0-7 characters? Fail.
            // Test 2: Does the entire string contain no alpha characters? Fail.
            // Test 3: Does the entire string contain no digits? Fail.

            if (preg_match("/^(.{0,7}|[^a-z]*|[^\d]*)$/", $password)) {
                $data['loginError'] = true;
                $error = 1;
            }

            if ($error == 0) {
                $encrypter  = \Config\Services::encrypter();
                $login = $_COOKIE['login']    = $encrypter->encrypt($login);
                $password = $_COOKIE['password'] = $encrypter->encrypt($password);
                $model = new UsersModel();

                $user = $model->findUser($encrypter->decrypt($login));
                $userlogin = $user->login;
                $array = array('login' => $userlogin, 'flag' => "b");
                $userIsBlocked = $model->where($array)->find();
                
                if ($userIsBlocked == array()) {

                    if (isset($password) == true) {

                        self::setLoggedInUser($user, $password);
                        $this->twig->display('templates/intro.html', ['user' => $user]);
                    } else {
                        $this->twig->display('templates/login.html');
                    };
                } else {
                    $data['loginBlocked'] = true;
                    $this->twig->display('templates/login.html', ['loginBlocked' => $data]);
                }
            } else {
                $this->twig->display('templates/login.html', ['loginError' => $data]);
            }
        } else {
            $this->twig->display('templates/login.html');
        }
    }
    /**
     * getLoggedInUser
     *
     * @return Object
     */
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

    /**
     * setLoggedInUser
     *
     * @param  mixed $user
     * @param  mixed $plaintextPassword
     * @return Object
     */
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

    /**
     * register
     *
     * @return void
     */
    public function register()
    {
        $encrypter = \Config\Services::encrypter();
        helper(['form']);

        $model = new UsersModel();
        $data = [];
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

            $userAllReady = $model->where("login",  $login)->find();
           
            if ($userAllReady == array()) {

                if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $email)) {
                    $dataError['emailError'] = true;
                    $error = 1;
                }
                if (!preg_match("/^[a-zA-Z-' ]*$/", $login)) {
                    $dataError['loginError'] = true;
                    $error = 1;
                }
                if (!preg_match("/^\d{5}$/", $zipcode)) {
                    $error        = 1;
                    $dataError['zipcodeError'] = true;
                }
                if (preg_match("/^(.{0,7}|[^a-z]*|[^\d]*)$/", $password)) {
                    $dataError['passwordError'] = true;
                    $error = 1;
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


                    $user  = $model->insert($data);

                    return redirect()->to('/login');
                } else {
                    $this->twig->display('templates/register.html', $dataError);
                }
            } else {
                $dataError['user'] = true;
                $this->twig->display('templates/register.html', $dataError);
            }
        }

        $this->twig->display('templates/register.html');
    }
    /**
     * intro
     *
     * @return void
     */
    public function intro()
    {
        $this->twig->display('layout/partials/_nav.html');
    }

    /**
     * logout
     *
     * @return void
     */
    public function logout()
    {
        helper('cookie');
        setcookie("login", null, 2147483647, '/');
        setcookie("password", null, 2147483647, '/');
        self::setloggedInUser(null);

        $this->twig->display('base.html');
        die();
    }
}
