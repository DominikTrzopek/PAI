<?php

class User
{
    private $email;
    private $password;
    private $name = null;
    private $surname = null;
    private $id;

    public function __construct(string $email,string $password,string $id)
    {
        $this->email = $email;
        $this->password = $password;
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }


    public function setEmail(string $email)
    {
        $this->email = $email;
    }


    public function getPassword(): string
    {
        return $this->password;
    }


    public function setPassword(string $password)
    {
        $this->password = $password;
    }


    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }


    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

}