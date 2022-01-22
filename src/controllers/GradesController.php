<?php

class GradesController extends DefaultController {

    public function scores(){

        session_start();
        $quizRepository = new QuizRepository();
        $scores = $quizRepository->getScores($_SESSION['user']);
        $scores = array_reverse($scores);
        $this->render("scores", ["scores" => $scores]);

    }

    public function searchScores(){
        $quizRepository = new QuizRepository();
        session_start();
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode($quizRepository->getAllScoresFromNameOrDate($decoded['search'],$_SESSION['user']));

        }
    }

}