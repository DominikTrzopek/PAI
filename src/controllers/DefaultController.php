<?php

require_once 'AppController.php';

class DefaultController extends AppController{
    
    public function index(){
        $this->render('login');

    }

    public function mainPage(){
        $this->render('mainPage');
    }

    public function createAccount(){
        $this->render('createAccount');

    }

    public function createQuiz(){
        $this->render('createQuiz');

    }
}