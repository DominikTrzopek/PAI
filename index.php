<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'],'/');
$path = parse_url($path,PHP_URL_PATH);

Routing::get('index','DefaultController');
Routing::get('mainPage','DefaultController');
Routing::get('createAccount','DefaultController');
Routing::post('login','SecurityController');
Routing::run($path);
