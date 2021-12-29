<?php

require_once 'AppController.php';


class QuizController extends AppController
{
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png','image/jpg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];

    public function createQuiz(){
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])){

            move_uploaded_file($_FILES['file']['tmp_name'],dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']);

            return $this->render("addQuestion", ['messages' => $this->messages]);
        }

        $this->render('createQuiz', ['messages' => $this->messages]);

    }


    public function editQuiz(){
        $this->render('addQuestion');
    }

    private function validate(array $file):bool
    {
        if($file['size'] > self::MAX_FILE_SIZE){
            $this->messages[] = 'File is to large for destination system.';
            return false;
        }

        if(!isset($file['type']) or !in_array($file['type'], self::SUPPORTED_TYPES)){
            $this->messages[] = 'File type is not supported.';
            return false;
        }

        return true;
    }
}