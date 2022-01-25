<?php

class AppController{

    private $request;


    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isPost():bool{
        return $this->request === 'POST';
    }

    protected function isGet():bool{
        return $this->request === 'GET';
    }

    protected function render(string $template = null, array $variables = []){
        $templatePath = 'public/views/'.$template.'.php';
        $output = 'File not found';

        session_start();
        if($template != 'login' and $template != 'createAccount'){
            if(!isset($_SESSION['user'])){
                $this->render('login',['messages'=>['Log in!']]);
                return;
            }
        }

        if($template != 'createQuiz' and $template != 'addQuestion'){
            if(isset($_SESSION['quizId'])){
                unset($_SESSION['quizId']);
            }
        }

            if (file_exists($templatePath)) {
                extract($variables);
                ob_start();
                include $templatePath;
                $output = ob_get_clean();
            }

            print $output;


    }

    public function checkLogin(){
        if(!isset($_SESSION['user'])){
            $this->render('login',['messages'=>['Log in!']]);
        }
    }
}