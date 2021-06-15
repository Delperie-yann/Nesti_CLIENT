<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Entities\Users;
use App\Config\Services;
use App\Models\ConnectionLogModel;

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
            $login     = $this->request->getPost('login',FILTER_SANITIZE_STRING);
            $password     = $this->request->getPost('password',FILTER_SANITIZE_STRING);

            // Chek if login is type min Xxxx or max X+x*30
            if (!preg_match("/^[A-Z]{1}[a-z]{3,20}/", $login)) {
                $data['loginError'] = true;
                $error = 1;
            }


            //if chek is ok
            if ($error == 0) {

                $model = new UsersModel();
                //Controle if User exist and if not block
                $array = array('login' => $login, 'flag' => "a");
                $userIsNotBlocked = $model->where($array)->first();

                if ($userIsNotBlocked != array()) {

                    //if exist and not block check password
                    $isPassword = password_verify($password, $userIsNotBlocked->passwordHash);

                    if ($isPassword) {

                        self::setLoggedInUser($userIsNotBlocked, $password);
                        $modelLog= new ConnectionLogModel();
                     
                        $dataLog = ['idUsers'=>$userIsNotBlocked->idUsers];
                        $modelLog->insert($dataLog);
                     
                        $this->twig->display('templates/intro.html', ['user' => $userIsNotBlocked]);
                    } else {
                        $this->twig->display('templates/login.html');
                    };
                } else {
                    $data['loginError'] = true;
                    $this->twig->display('templates/login.html', ['loginError' => $data]);
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
        if (isset($_SESSION['password'])) {

            $passDecript = $encrypter->decrypt($_SESSION['password']);
            if (self::$loggedInUser == null && isset($_SESSION['login'])) {
                $model = new UsersModel();
                $user  = $model->findUser($encrypter->decrypt($_SESSION['login']));
                if ($user != null && isset($passDecript)) {
                    self::$loggedInUser = $user;
                };
            }
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
    public  function setLoggedInUser($user, $plaintextPassword = null)
    {
        $encrypter = \Config\Services::encrypter();

        if ($user != null) {
            $loginEncrypt = $encrypter->encrypt($user->login);
            $passwordEncrypt  = $encrypter->encrypt($plaintextPassword);
            self::$loggedInUser = $user;
            $array = ["login" => $loginEncrypt, "password" => $passwordEncrypt];
            $this->session->set($array);
        }
    }

    /**
     * register
     *
     * @return void
     */
    public function register()
    {
        $data["slug"] = "user";

        $encrypter = \Config\Services::encrypter();
        helper(['form']);

        $model = new UsersModel();
        $data = [];
        if (isset($_POST['profileRegister'])) {

            $rules = [
                "login" => [
                    "rules" => 'required|regex_match[/^[A-Z]{1}[a-z]{3,20}/]|is_unique[users.login]',
                    "errors" => [
                        "required" => "Un login est nécessaire",
                        "regex_match" => "Votre login doit commencer par une majuscule",
                        "is_unique" => "Le login n'est pas disponible."

                    ]
                ],
                "email" => [
                    "rules" => 'required|valid_email|is_unique[users.email]',
                    "errors" => [
                        "required" => "Un email est nécessaire",
                        "is_unique" => "Email indisponible",
                        "valid_email" => "Le format de l'email est incorrect"
                    ]
                ],
                "password" => [
                    "rules" => 'required|regex_match[/^(.{0,30}|[^a-z]*|[^\d]*)$/]|min_length[8]|max_length[30]',
                    "errors" => [
                        "required" => "Il vous faut un mot de passe",
                        "regex_match" => "Votre mot de pass est trop faible...",
                        "min_length" => "Votre mot de passe est trop court",
                        "max_length" => "Votre mot de passe est trop long"

                    ]
                ],
                'firstname'   => [
                    "rules" => "required|max_length[150]|min_length[3]",
                    "errors" => [
                        "required" => "Un prénom est nécessaire",
                        "max_length" => "Votre prénom contient trop de caractère",
                        "min_length" => "Votre prénom ne contient pas assez de caractère"
                    ]
                ],
                'lastname'   => [
                    "rules" => "required|max_length[150]|min_length[3]",
                    "errors" => [
                        "required" => "Un email est nécessaire",
                        "max_length" => "Votre nom ne contient pas assez de caractère",
                        "min_length" => "Votre nom ne contient pas assez de caractère"
                    ]
                ],
                "adresse1" => [
                    "rules" => "required|max_length[150]|min_length[4]",
                    "errors" => [
                        "required" => "Une adresse est nécessaire",
                        "max_length" => "Votre adresse contient trop de caractère",
                        "min_length" => "Votre adresse ne contient pas assez de caractère"
                    ]
                ],
                "adresse2" => [
                    "rules" => "if_exist|max_length[150]",
                    "errors" => [
                        "max_length" => "Votre adresse contient trop de caractère"
                       
                    ]
                ],
                "zipcode" => [
                    "rules" => 'required|regex_match[/^\d{5}$/]',
                    "errors" => [
                        "required" => "Un code postale est nécessaire",
                        "regex_match" => "Votre code postal doit contenir 5 chiffres",

                    ]
                ],
                "city" => [
                    "rules" => "required|max_length[150]|min_length[3]",
                    "errors" => [
                        "required" => "Une ville est nécessaire",
                        "max_length" => "Votre ville contient trop de caractère",
                        "min_length" => "Votre ville ne contient pas assez de caractère"
                    ]
                ]
             
            ];
         
            if ($this->validate($rules)) {
          
                $lastName  = $this->request->getPost('lastname',FILTER_SANITIZE_STRING);
                $firstName = $this->request->getPost('firstname',FILTER_SANITIZE_STRING);
                $town      = $this->request->getPost("city",FILTER_SANITIZE_STRING);
                $login     = $this->request->getPost('login',FILTER_SANITIZE_STRING);
                $email     = $this->request->getPost('email',FILTER_SANITIZE_EMAIL);
                $address1  = $this->request->getPost('adresse1',FILTER_SANITIZE_STRING);
                $address2  = $this->request->getPost('adresse2',FILTER_SANITIZE_STRING);
                $password  = $this->request->getPost('password',FILTER_SANITIZE_STRING);
                $zipcode  = $this->request->getPost('zipcode',FILTER_SANITIZE_NUMBER_INT);
                $userAllReady = $model->where("login",  $login)->find();
                if ($userAllReady == array()) {
                    $dataUser = [
                        'email'        => $email,
                        'lastName'     => $lastName,
                        'firstName'    => $firstName,
                        'login'        => $login,
                        'passwordHash' => password_hash($password, PASSWORD_DEFAULT),
                        'address1'     => $address1,
                        'address2'     => $address2,
                        'zipCode'      => $zipcode,
                        'idCity'       => ProfileController::towncontrole($town),
                        'flag'         => 'w',
                    ];
                    $model->insert($dataUser);
                    return redirect()->to('/login');
                } else {
                  
                    $data["validation"] = $this->validator;
                }
            } else {
              
                $data["validation"] = $this->validator;
            }
        }
        $this->twig->display('templates/register.html',  $data);
    }
    /**
     * intro
     *
     * @return void
     */
    public function intro()
    {
        if (UserController::getLoggedInUser() != array()) {
            $user = UserController::getLoggedInUser();
            $this->twig->display('templates/intro.html', ['user' => $user]);
        } else {
            $this->twig->display('templates/intro.html');
        }
    }

    /**
     * logout
     *
     * @return void
     */
    public function logout()
    {
        self::setloggedInUser(null);
        if (isset($_SESSION["login"])) {
            unset($_SESSION["login"]);
            unset($_SESSION["password"]);
            session_destroy();
        }
        $this->twig->display('base.html');
        die();
    }
}
