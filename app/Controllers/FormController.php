<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
class FormController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index(){ 
               helper(['form', 'url']);

               //plusieurs consignes sont séparées par un "pipe" 
                       $rules = [
                           'username' => 'required',
                           'password' => 'required|numeric|max_length[10]',
                             'email' => 'required|valid_email'       
                             ];  

               if (! $this->validate($rules))        {
                   echo view('Signup', [
                       'validation' => $this->validator,            
                   ]);
                }
                else        {
                    echo view('validation/Success');
                        } 
                       }
                    }