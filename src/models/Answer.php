<?php

class Answer{
    private $text;
    private $isCorrect;
    private $questionId;
    private $answerId;



    public function __construct($text, $isCorrect, $questionId,$answerId)
    {
        $this->text = $text;
        $this->isCorrect = $isCorrect;
        $this->questionId = $questionId;
        $this->answerId = $answerId;
    }

    public function getAnswerId()
    {
        return $this->answerId;
    }

    public function getText():string
    {
        return $this->text;
    }


    public function setText(string $text)
    {
        $this->text = $text;
    }

    public function getIsCorrect():bool
    {
        return $this->isCorrect;
    }


    public function setIsCorrect(bool $isCorrect)
    {
        $this->isCorrect = $isCorrect;
    }


    public function getQuestionId(): int
    {
        return $this->questionId;
    }

    public function setQuestionId(int $quizId)
    {
        $this->questionId = $quizId;
    }

}