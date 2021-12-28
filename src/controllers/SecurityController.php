<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController
{
    public function login(){
        //to usunac
        $user = new user('benDover@omega.lul','admin','ben','dover');

        if(!$this->isPost()){
            return $this->render('login');
        }

        $email = $_POST["email"];

        $password = $_POST["password"];



        if($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email does not exist!']]);

        }

        if($user->getPassword() !== $password){
            return $this->render('login', ['messages'=>['Incorrect password!']]);
        }

        return $this->render('mainPage');

    }

}