<?php

class Score{
    private $score;
    private $date;
    private $quizName;
    private $numberOfQuestions;

    public function __construct($score, $date, $quizName, $numberOfQuestions)
    {
        $this->score = $score;
        $this->date = $date;
        $this->quizName = $quizName;
        $this->numberOfQuestions = $numberOfQuestions;
    }

    public function getScore()
    {
        return $this->score;
    }


    public function getDate()
    {
        return $this->date;
    }


    public function getQuizName()
    {
        return $this->quizName;
    }


    public function getNumberOfQuestions()
    {
        return $this->numberOfQuestions;
    }




}