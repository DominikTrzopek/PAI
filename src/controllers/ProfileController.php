<?php

class ProfileController extends AppController{

    public function viewProfile(){
        session_start();
        $this->checkLogin();
        $userRepository = new UserRepository();
        $user = $userRepository->getUserFromId($_SESSION['user']);
        $this->render('viewProfile',['user' => $user]);
    }

    public function editProfile(){

        session_start();
        $this->checkLogin();
        $messages[] = null;
        $userRepository = new UserRepository();
        $user = $userRepository->getUserFromId($_SESSION['user']);

        if(isset($_POST['editButton'])){

            if(!$this->isPost()){
                return $this->render('viewProfile',['user' => $user]);
            }

            $email = $_POST["email"];
            if($email == null){
                $email = $user->getEmail();
            }
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $email = $user->getEmail();
                $messages[] = "invalid email format";
            }
            $name = $_POST["name"];
            if($name == null){
                $name = $user->getName();
            }
            $surname = $_POST["surname"];
            if($surname == null){
                $surname = $user->getSurname();
            }
            $userRepository->editUser($email,$name,$surname,$_SESSION['user']);
            $user = $userRepository->getUserFromId($_SESSION['user']);
            $this->render('viewProfile',['user' => $user, 'messages' => $messages]);
        }
        else{
            $this->render('editProfile',['user' => $user]);
        }
    }


}