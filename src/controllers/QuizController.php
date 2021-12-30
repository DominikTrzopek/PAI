<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Quiz.php';
require_once __DIR__.'/../models/Question.php';

class QuizController extends AppController
{
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png','image/jpg','image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];

    public function createQuiz(){
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])){

            move_uploaded_file($_FILES['file']['tmp_name'],dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']);


            $password_hashed = password_hash($_POST['password'],PASSWORD_DEFAULT,['cost'=>12]);
            $quiz = new Quiz($_POST['name'],$_POST['description'],$_POST['topic'],$_FILES['file']['name'],$password_hashed);



            return $this->render("addQuestion", ['messages' => $this->messages,'quiz' => $quiz->getId()]);
        }

        $this->render('createQuiz', ['messages' => $this->messages]);

    }


    public function editQuiz(){
        $quizId = $_POST['finish'];
        $question = new Question($quizId, $_POST['content'],$_POST['correct'],$_POST['incorrect1'],$_POST['incorrect2'],$_POST['incorrect3']);
        $this->render('mainPage',['messages' => $this->messages]);

    }

    private function validate(array $file):bool
    {
        if($file['size'] > self::MAX_FILE_SIZE){
            $this->messages[] = 'File is to large for destination system.';
            return false;
        }

        if(!isset($file['type']) or !in_array($file['type'], self::SUPPORTED_TYPES)){
            $this->messages[] = 'Not supported file type';
            return false;
        }

        return true;
    }
}