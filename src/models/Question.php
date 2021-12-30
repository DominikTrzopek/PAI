<?php

class Question{
    private $quizId;
    private $questionId;
    Private $content;
    private $correct;
    private $incorrect1;
    private $incorrect2;
    private $incorrect3;


    public function __construct($quizId, $content, $correct, $incorrect1, $incorrect2, $incorrect3)
    {
        $this->quizId = $quizId;
        $this->content = $content;
        $this->correct = $correct;
        $this->incorrect1 = $incorrect1;
        $this->incorrect2 = $incorrect2;
        $this->incorrect3 = $incorrect3;
        $this->questionId = uniqid();
    }


    public function getQuizId()
    {
        return $this->quizId;
    }


    public function setQuizId($quizId)
    {
        $this->quizId = $quizId;
    }


    public function getQuestionId(): string
    {
        return $this->questionId;
    }


    public function setQuestionId(string $questionId)
    {
        $this->questionId = $questionId;
    }


    public function getContent()
    {
        return $this->content;
    }


    public function setContent($content)
    {
        $this->content = $content;
    }


    public function getCorrect()
    {
        return $this->correct;
    }


    public function setCorrect($correct)
    {
        $this->correct = $correct;
    }


    public function getIncorrect1()
    {
        return $this->incorrect1;
    }


    public function setIncorrect1($incorrect1)
    {
        $this->incorrect1 = $incorrect1;
    }


    public function getIncorrect2()
    {
        return $this->incorrect2;
    }


    public function setIncorrect2($incorrect2)
    {
        $this->incorrect2 = $incorrect2;
    }


    public function getIncorrect3()
    {
        return $this->incorrect3;
    }


    public function setIncorrect3($incorrect3)
    {
        $this->incorrect3 = $incorrect3;
    }

}