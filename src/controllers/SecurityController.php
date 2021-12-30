<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';


class SecurityController extends AppController
{

    public function login(){
        //to usunac
        $user = new user('benDover@omega.lul',password_hash('admin',PASSWORD_DEFAULT,['cost'=>12]),'ben','dover');

        if(!$this->isPost()){
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        if($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email does not exist!']]);
        }

        if(!password_verify($password,$user->getPassword())){
            return $this->render('login', ['messages'=>['Incorrect password!']]);
        }

        setcookie ("userid",$user->getId(),time()+ 3600);

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

        $password_hashed = password_hash($password,PASSWORD_DEFAULT,['cost'=>12]);

        $this->render('login', ['messages'=>['Account created, you can log in!']]);
    }

    public function logout(){
        setcookie ("username","",time()-3600);
        $this->render('login');
    }

}