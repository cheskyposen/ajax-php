<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                "title" => 'login page',
                "username" => trim($_POST['username']),
                "username_err" => '',
                "password" => trim($_POST['password']),
                "password_err" => '',
                "success" => ''
            ];

            if(empty($data['username'])){
                $data['username_err'] = "email must be entered";
            }else{
                if(!$user = $this->userModel->findUserByUsername($data['username'])){
                    $data['username_err'] = "email not found";
                }
            }
            if(empty($data['password'])){
                $data['password_err'] = "password must be entered";
            }
            if(empty($data['username_err']) && empty($data['password_err'])){
                if(!$this->userModel->login($data['username'], $data['password'])){
                    $data['password_err'] = "password does not match";
                }else{
                    $data['success'] = 'you have successfully logged in';
                }
            }
        }else {
            $data = [
                "title" => 'login page',
                "username" => '',
                "username_err" => '',
                "password" => '',
                "password_err" => '',
                "success" => ''
            ];
        }
        $this->view('users/login', $data);
    }

    public function loginAjax(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                "title" => 'login Ajax page',
                "username" => trim($_POST['username']),
                "username_err" => '',
                "password" => trim($_POST['password']),
                "password_err" => '',
                "success" => ''
            ];

            if(empty($data['username'])){
                $data['username_err'] = "username must be entered";
            }else{
                if(!$user = $this->userModel->findUserByUsername($data['username'])){
                    $data['username_err'] = "username not found";
                }
            }
            if(empty($data['password'])){
                $data['password_err'] = "password must be entered";
            }
            if(empty($data['username_err']) && empty($data['password_err'])){
                if(!$this->userModel->login($data['username'], $data['password'])){
                    $data['password_err'] = "password does not match";
                }else{
                    $data['success'] = 'you have successfully logged in';
                }
            }
            header('Content-type: application/json');
            echo json_encode($data);
        }else {
            $data = [
                "title" => 'login Ajax page',
                "username" => '',
                "username_err" => '',
                "password" => '',
                "password_err" => '',
                "success" => ''
            ];
            $this->view('users/login-ajax', $data);
        }
    }

    public function register(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                "title" => 'register page',
                "name" => trim($_POST['name']),
                "name_err" => '',
                "age" => trim($_POST['age']),
                "age_err" => '',
                "email" => trim($_POST['email']),
                "email_err" => '',
                "username" => trim($_POST['username']),
                "username_err" => '',
                "password" => trim($_POST['password']),
                "password_err" => '',
                "confirm_password" => trim($_POST['confirm_password']),
                "confirm_password_err" => '',
                "success" => ''
            ];

            if(empty($data['name'])){
              $data['name_err'] = 'name must be entered';
            }

            if(empty($data['age'])){
                $data['age_err'] = 'age must be entered';
            }elseif(intval($data['age']) <= 0){
                $data['age_err'] = 'age can not be 0 or below';
            }

            if(empty($data['email'])){
                $data['email_err'] = 'email must be entered';
            }

            if(empty($data['username'])){
                $data['username_err'] = 'username must be entered';
            }elseif($this->userModel->findUserByUsername($data['username'])){
                $data['username_err'] = 'username already taken';
            }

            if(empty($data['password'])){
                $data['password_err'] = 'password must be entered';
            }

            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'confirm password must be entered';
            }elseif($data['password'] !== $data['confirm_password']){
                $data['confirm_password_err'] = 'password does not match';
            }

            if(empty($data['name_err']) && empty($data['age_err']) && empty($data['username_err']) && empty($data['email_err'])
                && empty($data['password_err']) && empty($data['confirm_password_err'])){
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                if ($this->userModel->register($data)){
                    $data['success'] = 'you have successfully registered';
                }else{
                    $data['success'] = 'some error happened';
                }
                $data['password'] = $data['confirm_password'];
            }
        }else {
            $data = [
                "title" => 'register page',
                "name" => '',
                "name_err" => '',
                "age" => '',
                "age_err" => '',
                "email" => '',
                "email_err" => '',
                "username" => '',
                "username_err" => '',
                "password" => '',
                "password_err" => '',
                "confirm_password" => '',
                "confirm_password_err" => '',
                "success" => ''
            ];
        }
        $this->view('users/register', $data);
    }

    public function registerAjax(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                "title" => 'register Ajax page',
                "name" => trim($_POST['name']),
                "name_err" => '',
                "age" => trim($_POST['age']),
                "age_err" => '',
                "email" => trim($_POST['email']),
                "email_err" => '',
                "username" => trim($_POST['username']),
                "username_err" => '',
                "password" => trim($_POST['password']),
                "password_err" => '',
                "confirm_password" => trim($_POST['confirm_password']),
                "confirm_password_err" => '',
                "success" => ''
            ];

            if(empty($data['name'])){
                $data['name_err'] = 'name must be entered';
            }

            if(empty($data['age'])){
                $data['age_err'] = 'age must be entered';
            }elseif(intval($data['age']) <= 0){
                $data['age_err'] = 'age can not be 0 or below';
            }

            if(empty($data['email'])){
                $data['email_err'] = 'email must be entered';
            }

            if(empty($data['username'])){
                $data['username_err'] = 'username must be entered';
            }elseif($this->userModel->findUserByUsername($data['username'])){
                $data['username_err'] = 'username already taken';
            }

            if(empty($data['password'])){
                $data['password_err'] = 'password must be entered';
            }

            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'confirm password must be entered';
            }elseif($data['password'] !== $data['confirm_password']){
                $data['confirm_password_err'] = 'password does not match';
            }

            if(empty($data['name_err']) && empty($data['age_err']) && empty($data['username_err']) && empty($data['email_err'])
                && empty($data['password_err']) && empty($data['confirm_password_err'])){
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                if ($this->userModel->register($data)){
                    $data['success'] = 'you have successfully registered';
                }else{
                    $data['success'] = 'some error happened';
                }
                $data['password'] = $data['confirm_password'];
            }
            header('Content-type: application/json');
            echo json_encode($data);
        }else {
            $data = [
                "title" => 'register Ajax page',
                "name" => '',
                "name_err" => '',
                "age" => '',
                "age_err" => '',
                "email" => '',
                "email_err" => '',
                "username" => '',
                "username_err" => '',
                "password" => '',
                "password_err" => '',
                "confirm_password" => '',
                "confirm_password_err" => '',
                "success" => ''
            ];
            $this->view('users/register-ajax', $data);
        }
    }
}