<?php

class Quiz{
    private $name;
    private $description;
    private $topic;
    private $image;
    private $id;
    private $creator;
    private $password;
    private $time;
    private $numberOfQuestions;

    public function __construct($name, $description, $topic, $image, $time, $id,$creator,$password=null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->topic = $topic;
        $this->image = $image;
        $this->password = $password;
        $this->id = $id;
        $this->creator = $creator;
        $this->time = $time;
    }

    public function getNumberOfQuestions():int
    {
        return $this->numberOfQuestions;
    }


    public function setNumberOfQuestions(int $numberOfQuestions)
    {
        $this->numberOfQuestions = $numberOfQuestions;
    }

    public function getTime():int
    {
        return $this->time;
    }

    public function setTime(int $time)
    {
        $this->time = $time;
    }


    public function getCreator():string
    {
        return $this->creator;
    }


    public function setCreator(string $creator)
    {
        $this->creator = $creator;
    }


    public function getPassword():string
    {
        return $this->password;
    }


    public function setPassword(string $password)
    {
        $this->password = $password;
    }


    public function getName():string
    {
        return $this->name;
    }


    public function setName(string $name)
    {
        $this->name = $name;
    }


    public function getDescription():string
    {
        return $this->description;
    }


    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getTopic():string
    {
        return $this->topic;
    }


    public function setTopic(string $topic)
    {
        $this->topic = $topic;
    }


    public function getImage():string
    {
        return $this->image;
    }


    public function setImage(string $image)
    {
        $this->image = $image;
    }


    public function getId():string
    {
        return $this->id;
    }


}
