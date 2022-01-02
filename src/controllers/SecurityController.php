<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController
{

    public function login(){

        $userRepository = new UserRepository();

        if(!$this->isPost()){
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = $userRepository->getUser($email);

        if(!$user){
            return $this->render('login', ['messages' => ['User not exists!']]);
        }

        if($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email does not exist!']]);
        }

        if(!password_verify($password,$user->getPassword())){
            return $this->render('login', ['messages'=>['Incorrect password!']]);
        }

        session_start();
        $_SESSION["user"] = $user->getId();

        return $this->render('mainPage');

    }

    public function createAccount(){

        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordRepeat = $_POST['passwordRepeat'];

        if(!$this->isPost()){
            return $this->render('createAccount');
        }

        if($password !== $passwordRepeat){
            return $this->render('createAccount',['messages'=>['password and confirmed password are not the same']]);
        }

        if(is_null($password) or empty($password)){
            return $this->render('createAccount',['messages'=>['password empty']]);
        }

        if(is_null($email) or empty($email)){
            return $this->render('createAccount',['messages'=>['email empty']]);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->render('createAccount',['messages'=>['Invalid email address']]);
        }

        $userRepository = new UserRepository();
        $user = $userRepository->getUser($email);

        if($user){
            return $this->render('createAccount', ['messages' => ['User with this email already exist!']]);
        }

        $password_hashed = password_hash($password,PASSWORD_DEFAULT,['cost'=>12]);
        $userRepository->insertUser($email,$password_hashed);

        $this->render('login', ['messages'=>['Account created, you can log in!']]);
    }

    public function logout(){
        session_start();
        unset($_SESSION['user']);
        $this->render('login');
    }

}