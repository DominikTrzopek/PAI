<?php

class ProfileController extends AppController{

    public function viewProfile(){
        session_start();
        $userRepository = new UserRepository();
        $user = $userRepository->getUserFromId($_SESSION['user']);
        $this->render('viewProfile',['user' => $user]);
    }

    public function editProfile(){
        session_start();
        $userRepository = new UserRepository();
        $user = $userRepository->getUserFromId($_SESSION['user']);
        if(isset($_POST['editButton'])){
            $email = $_POST["email"];
            if($email == null){
                $email = $user->getEmail();
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
            $this->render('viewProfile',['user' => $user]);
        }
        else{
            $this->render('editProfile',['user' => $user]);
        }
    }

}