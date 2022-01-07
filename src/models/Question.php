<?php

class Question{
    private $quizId;
    private $questionId;
    Private $content;

    public function __construct($quizId, $content, $questionId)
    {
        $this->quizId = $quizId;
        $this->content = $content;
        $this->questionId = $questionId;
    }


    public function getQuizId()
    {
        return $this->quizId;
    }


    public function setQuizId(int $quizId)
    {
        $this->quizId = $quizId;
    }


    public function getQuestionId():int
    {
        return $this->questionId;
    }


    public function setQuestionId(int $questionId)
    {
        $this->questionId = $questionId;
    }


    public function getContent():string
    {
        return $this->content;
    }


    public function setContent(string $content)
    {
        $this->content = $content;
    }



}