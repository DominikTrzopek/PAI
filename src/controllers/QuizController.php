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

            if(filter_var($_POST['time'], FILTER_VALIDATE_INT) === false){
                $this->messages[] = "Time needs to be a number";
                $this->render('createQuiz', ['messages' => $this->messages]);
                die();
            }

            $password_hashed = password_hash($_POST['password'],PASSWORD_DEFAULT,['cost'=>12]);
            $quiz = new Quiz($_POST['name'],$_POST['description'],$_POST['topic'],$_FILES['file']['name'], $_POST['time'], $_SESSION['quizId'],$_SESSION['user'],$password_hashed);
            if($quizRepository->getQuizFromName($_POST['name'])){
                $this->messages[] = "Quiz with this name already exists";
                return $this->render('createQuiz', ['messages' => $this->messages]);
            }
            $quizRepository->insertQuiz($quiz);

            return $this->render("addQuestion", ['messages' => $this->messages,'quiz' => $quiz->getId()]);
        }

        $this->render('createQuiz', ['messages' => $this->messages]);

    }


    public function editQuiz(){

        $quizRepository = new QuizRepository();
        if(isset($_POST['finish'])) {

            $quizId = $_POST['finish'];
            $this->mainPage();
        }
        if(isset($_POST['add'])) {
            $quizId = $_POST['add'];
            //$question = new Question($quizId, $_POST['content']);
            $questionId = $quizRepository->insertQuestion($quizId, $_POST['content']);
            $quizRepository->insertAnswer($_POST['correct'],$questionId,1);
            $quizRepository->insertAnswer($_POST['incorrect1'],$questionId,'false');
            $quizRepository->insertAnswer($_POST['incorrect2'],$questionId,'false');
            $quizRepository->insertAnswer($_POST['incorrect3'],$questionId,'false');

            $this->render('addQuestion', ['messages' => $this->messages,'quiz' => $quizId]);
        }
        if(isset($_POST['previous'])) {
            //TODO fix this
            $quizId = $_POST['previous'];
            $question = $quizRepository->getQuestions($quizId);
            $this->render('showQuestion',  ['messages' => $this->messages,'question' => $question]);
        }



    }

    private function validate(array $file):bool
    {

        if($file['size'] > self::MAX_FILE_SIZE){
            $this->messages[] = 'File is to large for destination system!';
            return false;
        }

        if(!isset($file['type']) or !in_array($file['type'], self::SUPPORTED_TYPES)){
            $this->messages[] = 'Not supported file type!';
            return false;
        }

        return true;
    }

    public function mainPage(){
        session_start();
        $quizRepository = new QuizRepository();
        $quizzes = $quizRepository->getQuizzes($_SESSION['user']);
        $this->render('mainPage',['quizzes' => $quizzes]);
    }

    public function startQuiz(){
        session_start();
        $str = $_GET['next'];
        list($quizId,$answerId) = explode(" ",$str);

        if(!isset($_SESSION['questionNumber'])){
            $_SESSION['questionNumber'] = 0;
            $_SESSION['score'] = 0;
        }
        else if(isset($_GET['next']) and $answerId != $_SESSION['lastAnswer']) {
            $_SESSION['questionNumber']++;
        }

        if($answerId != null and $answerId != $_SESSION['lastAnswer']) {
            $this->checkAnswer($answerId);
        }

        $quizRepository = new QuizRepository();
        $quiz = $quizRepository->getQuizFromId($quizId);
        $time = $quiz->getTime();
        setcookie("time", $time, time() + ($time + 1), "/");
        $questions = $quizRepository->getQuestions($quizId);
        $allQuestions = count($questions);
        if($_SESSION['questionNumber'] >= count($questions)){
            unset($_SESSION['questionNumber']);
            $score = $_SESSION['score'];
            unset($_SESSION['score']);
            $this->render('result',['score' => $score, 'all'=>$allQuestions, 'quizId' => $quizId]);
            return;
        }
        $question = $questions[$_SESSION['questionNumber']];
        $answers = $quizRepository->getAnswers($question->getQuestionId());
        shuffle($answers);
        $this->render('doQuiz', ['question' => $question, 'answers' => $answers, 'quizId' => $quizId, 'all' => $allQuestions, ]);

    }

    function checkAnswer(int $id){
        session_start();
        $_SESSION['lastAnswer'] = $id;
        $quizRepository = new QuizRepository();
        $answer = $quizRepository->getAnswerFromId($id);
        if($answer->getIsCorrect() == true and isset($_COOKIE['time'])){
            $_SESSION['score']++;
        }
    }

    public function endQuiz(){
        $quizRepository = new QuizRepository();
        session_start();
        $str = $_POST['end'];
        list($score,$quizId) = explode(" ",$str);
        $quizRepository->insertScore($quizId,$_SESSION['user'],$score);

        $this->mainPage();

    }


    public function joinQuiz(){
        if(isset($_POST['joinButton'])){
            session_start();
            $quizRepository = new QuizRepository();
            $quizName = $_POST['name'];
            $password = $_POST['password'];
            $quiz = $quizRepository->getQuizFromName($quizName);
            if($quiz == null){
                return $this->render('joinQuiz', ['messages' => ["Quiz not found!"]]);
            }
            if(!password_verify($password,$quizRepository->getQuizPassword($quiz[1]) )){
                return $this->render('joinQuiz', ['messages'=> ["Incorrect password"]]);
            }
            $quizRepository->joinQuiz($_SESSION['user'],$quiz[0]->getId());
            return $this->render('joinQuiz',['messages'=> ["Successfully joined quiz!"]]);

        }
        else{
            $this->render('joinQuiz');
        }
    }

    public function search(){
        $quizRepository = new QuizRepository();
        session_start();
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-Type: application/json');
            http_response_code(200);

            echo json_encode($quizRepository->getAllQuizzesFromName($decoded['search'],$_SESSION['user']));

        }
    }

}