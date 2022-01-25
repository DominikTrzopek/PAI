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
            $questionId = $quizRepository->insertQuestion($quizId, $_POST['content']);
            $quizRepository->insertAnswer($_POST['correct'],$questionId,1);
            $quizRepository->insertAnswer($_POST['incorrect1'],$questionId,'false');
            $quizRepository->insertAnswer($_POST['incorrect2'],$questionId,'false');
            $quizRepository->insertAnswer($_POST['incorrect3'],$questionId,'false');

            $this->render('addQuestion', ['messages' => $this->messages,'quiz' => $quizId]);
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
        unset($_SESSION['questionNumber']);
        unset($_SESSION['score']);
        unset($_SESSION['quiz']);
        if(isset($_SESSION['user'])) {
            setcookie("remainingTime", "", time() - 3600);
            $quizRepository = new QuizRepository();
            $quizzes = $quizRepository->getQuizzes($_SESSION['user'], "all");
        }
        $this->render('mainPage',['quizzes' => $quizzes]);
    }

    public function startQuiz(){
        session_start();
        $this->checkLogin();
        $str = $_GET['next'];
        list($quizId,$answerId) = explode(" ",$str);

        if(!isset($_SESSION['questionNumber'])){

            $_SESSION['questionNumber'] = 0;
            $_SESSION['score'] = 0;
            $_SESSION['quiz'] = $quizId;
        }

        $quizRepository = new QuizRepository();
        $quiz = $quizRepository->getQuizFromId($quizId);
        $time = $quiz->getTime();
        $_SESSION['time'] = $time;
        setcookie("time", $time, time() + ($time + 1), "/");

        if(!isset($_COOKIE['remainingTime'])){
            setcookie("remainingTime", $time, time() + (60), "/");
        }


        $questions = $quizRepository->getQuestions($quizId);
        $allQuestions = count($questions);

        setcookie("numberOfQuestion", $_SESSION['questionNumber'], time() + (60), "/");
        setcookie("maxQuestion", $allQuestions, time() + (60), "/");

        $question = $questions[ $_SESSION['questionNumber']];
        $answers = $quizRepository->getAnswers($question->getQuestionId());
        shuffle($answers);
        $this->render('doQuiz', ['question' => $question, 'answers' => $answers, 'quizId' => $quizId, 'all' => $allQuestions, ]);

    }

    function checkAnswer(int $id):bool{
        session_start();
        //$_SESSION['lastAnswer'] = $id;
        $quizRepository = new QuizRepository();
        $answer = $quizRepository->getAnswerFromId($id);
        if($answer->getIsCorrect() == true and isset($_COOKIE['time'])){
            $_SESSION['score']++;
            return true;
        }
        return false;
    }

    public function endQuiz(){
        $quizRepository = new QuizRepository();
        session_start();
        $str = $_POST['end'];
        list($score,$quizId,$maxScore) = explode(" ",$str);
        $quizRepository->insertScore($quizId,$_SESSION['user'],$score,$maxScore);
        unset($_SESSION['questionNumber']);
        unset($_SESSION['score']);
        unset($_SESSION['lastAnswer']);

        $this->mainPage();

    }

    public function nextQuestion(){

        session_start();
        $this->checkLogin();
        $quizRepository = new QuizRepository();
        $questions = $quizRepository->getQuestions($_SESSION['quiz']);
        $allQuestions = count($questions);

        setcookie("numberOfQuestion", $_SESSION['questionNumber'] + 1, time() + (60), "/");
        setcookie("maxQuestion",$allQuestions, time() + (60), "/");
        setcookie("time", $_SESSION['time'], time() + ($_SESSION['time'] + 1), "/");


        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {

            $content = trim(file_get_contents("php://input"));
            $answerId = json_decode($content, true);
            $isCorrect = $this->checkAnswer($answerId);

            header('Content-Type: application/json');
            http_response_code(200);

            if ($_SESSION['questionNumber'] + 1 >= count($questions)) {

                $score = $_SESSION['score'];

                $array = array(
                    "score" => $score,
                    "maxQuestion" => $allQuestions,
                    "quizId" => $_SESSION['quiz'],
                    "isCorrect" => $isCorrect,
                );
                echo json_encode($array);


            }
            else {

                $_SESSION['questionNumber']++;

                $question = $questions[$_SESSION['questionNumber']];

                $array = array(
                    "question" => $question->getContent(),
                    "numberOfQuestion" => $_SESSION['questionNumber'],
                    "maxQuestion" => $allQuestions,
                    "questionId" => $question->getQuestionId(),
                    "isCorrect" => $isCorrect,
                );
                echo json_encode($array);

            }
        }
    }

    public function nextAnswers(){

        $quizRepository = new QuizRepository();
        session_start();
        $this->checkLogin();
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            $answers = $quizRepository->getAnswers($decoded);
            shuffle($answers);

            $array = array(
                "textA" => $answers[0]->getText(),
                "textB" => $answers[1]->getText(),
                "textC" => $answers[2]->getText(),
                "textD" => $answers[3]->getText(),
                "valueA" => $answers[0]->getAnswerId(),
                "valueB" => $answers[1]->getAnswerId(),
                "valueC" => $answers[2]->getAnswerId(),
                "valueD" => $answers[3]->getAnswerId(),
            );

            header('Content-Type: application/json');
            http_response_code(200);

            echo json_encode($array);

        }
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

    public function searchQuiz(){

        $quizRepository = new QuizRepository();
        session_start();
        $this->checkLogin();
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-Type: application/json');
            http_response_code(200);

            echo json_encode($quizRepository->getAllQuizzesFromName($decoded['search'],$_SESSION['user'], "all"));

        }
    }

}