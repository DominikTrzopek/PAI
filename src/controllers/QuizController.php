<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Quiz.php';
require_once __DIR__.'/../models/Question.php';
require_once __DIR__.'/../repository/QuizRepository.php';

class QuizController extends AppController
{
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png','image/jpg','image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];

    public function createQuiz(){

        session_start();
        if(!isset($_SESSION['quizId'])) {
            $_SESSION['quizId'] = uniqid();
        }
        $quizRepository = new QuizRepository();

        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])){

            move_uploaded_file($_FILES['file']['tmp_name'],dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']);


            $password_hashed = password_hash($_POST['password'],PASSWORD_DEFAULT,['cost'=>12]);
            $quiz = new Quiz($_POST['name'],$_POST['description'],$_POST['topic'],$_FILES['file']['name'], $_POST['time'], $_SESSION['quizId'],$password_hashed);
            $quizRepository->insertQuiz($quiz);

            return $this->render("addQuestion", ['messages' => $this->messages,'quiz' => $quiz->getId()]);
        }

        $this->render('createQuiz', ['messages' => $this->messages]);

    }


    public function editQuiz(){

        $quizRepository = new QuizRepository();
        if(isset($_POST['finish'])) {

            $quizId = $_POST['finish'];
            $this->render('mainPage', ['messages' => $this->messages]);
        }
        if(isset($_POST['add'])) {
            $quizId = $_POST['add'];
            $question = new Question($quizId, $_POST['content'], $_POST['correct'], $_POST['incorrect1'], $_POST['incorrect2'], $_POST['incorrect3']);
            $quizRepository->insertQuestion($question);

            $this->render('addQuestion', ['messages' => $this->messages,'quiz' => $quizId]);
        }
        if(isset($_POST['previous'])) {
            $quizId = $_POST['previous'];
            $question = $quizRepository->getQuestions($quizId);
            $this->render('showQuestion',  ['messages' => $this->messages,'question' => $question]);
        }



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