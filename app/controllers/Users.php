<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index(){


        $data = [
            "title" => 'login page',
            "email" => '',
            "email_err" => '',
            "password" => '',
            "password_err" => ''
        ];
        $this->view('users/login', $data);
    }

    public function loginAjax(){
        $data = [
            "title" => 'login ajax page',
            "email" => '',
            "email_err" => '',
            "password" => '',
            "password_err" => ''
        ];
        $this->view('users/login-ajax', $data);
    }

    public function register(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                "title" => 'login ajax page',
                "name" => trim($_POST['name']),
                "name_err" => '',
                "email" => trim($_POST['email']),
                "email_err" => '',
                "username" => trim($_POST['username']),
                "username_err" => '',
                "password" => trim($_POST['password']),
                "password_err" => '',
                "confirm_password" => trim($_POST['confirm_password']),
                "confirm_password_err" => ''
            ];

            if(empty($data['name'])){
              $data['name_err'] = 'name must be entered';
            }else{

            }

            if(empty($data['email'])){
                $data['email_err'] = 'email must be entered';
            }else{

            }

            if(empty($data['username'])){
                $data['username_err'] = 'username must be entered';
            }else{

            }

            if(empty($data['password'])){
                $data['password_err'] = 'password must be entered';
            }else{

            }

            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'must confirm password be entered';
            }else{

            }
        }else {
            $data = [
                "title" => 'login ajax page',
                "name" => '',
                "name_err" => '',
                "email" => '',
                "email_err" => '',
                "username" => '',
                "username_err" => '',
                "password" => '',
                "password_err" => '',
                "confirm_password" => '',
                "confirm_password_err" => ''
            ];
        }
        $this->view('users/register', $data);
    }

    public function registerAjax(){
        $data = [
            "title" => 'login ajax page',
            "name" => '',
            "name_err" => '',
            "email" => '',
            "email_err" => '',
            "username" => '',
            "username_err" => '',
            "password" => '',
            "password_err" => '',
            "confirm_password" => '',
            "confirm_password_err" => ''
        ];
        $this->view('users/register-ajax', $data);
    }
}