<?php

class GradesController extends DefaultController {

    public function scores(){

        session_start();
        $quizRepository = new QuizRepository();
        $scores = $quizRepository->getScores($_SESSION['user']);
        $scores = array_reverse($scores);
        $this->render("scores", ["scores" => $scores]);

    }

}