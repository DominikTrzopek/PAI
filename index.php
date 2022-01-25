<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'],'/');
$path = parse_url($path,PHP_URL_PATH);

Routing::get('index','DefaultController');
Routing::get('mainPage','QuizController');
//Routing::get('createAccount','DefaultController');
Routing::post('login','SecurityController');
Routing::post('createAccount','SecurityController');
Routing::post('logout','SecurityController');
Routing::post('createQuiz','QuizController');
Routing::post('editQuiz','QuizController');
Routing::get('startQuiz','QuizController');
Routing::post('endQuiz','QuizController');
Routing::get('viewProfile','ProfileController');
Routing::post('editProfile','ProfileController');
Routing::post('joinQuiz','QuizController');
Routing::post('searchQuiz','QuizController');
Routing::get('scores','GradesController');
Routing::post('searchScores','GradesController');
Routing::get('manageQuizzes','QuizEditionController');
Routing::post('changeQuiz','QuizEditionController');
Routing::post('deleteQuestion','QuizEditionController');
Routing::post('searchQuestions','QuizEditionController');
Routing::post('searchManageOwner','QuizEditionController');
Routing::post('searchManageMember','QuizEditionController');
Routing::post('nextQuestion','QuizController');
Routing::post('nextAnswers','QuizController');
Routing::run($path);
