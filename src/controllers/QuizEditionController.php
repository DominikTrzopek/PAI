<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Quiz.php';
require_once __DIR__.'/../models/Question.php';
require_once __DIR__.'/../repository/QuizRepository.php';

class QuizEditionController extends AppController
{
    public function manageQuizzes(){

        session_start();
        unset($_SESSION['quiz']);
        $quizRepository = new QuizRepository();
        $myQuizzes = $quizRepository->getQuizzes($_SESSION['user'], "own");
        $joinedQuizzes = $quizRepository->getQuizzes($_SESSION['user'], "joined");
        $this->render("manageQuizzes", ['myQuizzes' => $myQuizzes, 'joinedQuizzes' => $joinedQuizzes]);

    }

    public function changeQuiz(){
        $quizRepository = new QuizRepository();

        if(isset($_POST['addQuestion'])){
            $id = $_POST['addQuestion'];
            return $this->render("addQuestion", ['quiz' => $id]);
        }
        else if(isset($_POST['deleteQuestion'])){
            $id = $_POST['deleteQuestion'];
            session_start();
            $_SESSION['quiz'] = $id;
            $questions = $quizRepository->getQuestions($id);
            return $this->render("showQuestions", ['questions' => $questions, 'quizId' => $id]);
        }
        else if(isset($_POST['deleteQuiz'])){
            $id = $_POST['deleteQuiz'];
            $quizRepository->deleteQuiz($id);
            return $this->manageQuizzes();
        }
        else  if(isset($_POST['quit'])){
            session_start();
            $id = $_POST['quit'];
            $quizRepository->quitQuiz($_SESSION['user'],$id);
            return $this->manageQuizzes();
        }
    }

    public function deleteQuestion(){

        $str = $_POST['delete'];
        list($questionId,$quizId) = explode(" ",$str);
        $questionId = (int)$questionId;

        $quizRepository = new QuizRepository();
        $quizRepository->deleteQuestion($questionId);

        $questions = $quizRepository->getQuestions($quizId);
        return $this->render("showQuestions", ['questions' => $questions, 'quizId' => $quizId]);


    }

    public function searchQuestions(){
        $this->search("questions");
    }

    public function searchManageOwner(){
        $this->search("owner");
    }

    public function searchManageMember(){
        $this->search("member");
    }

    function search(string $cond){
        $quizRepository = new QuizRepository();
        session_start();
        $id = $_SESSION['quiz'];
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-Type: application/json');
            http_response_code(200);
            if($cond == "questions") {
                echo json_encode($quizRepository->getQuestionsFromName($decoded['search'], $_SESSION['quiz']));
            }
            else if($cond == "owner") {
                echo json_encode($quizRepository->getAllQuizzesFromName($decoded['search'],$_SESSION['user'], "owner"));
            }
            else if($cond == "member") {
                echo json_encode($quizRepository->getAllQuizzesFromName($decoded['search'],$_SESSION['user'], "member"));
            }
        }
    }

}