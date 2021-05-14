<?php

//This is my controller for the diner project

//Turn on error-reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Instantiate Fat-Free
$f3 = Base::instance();

//Require autoload file
require_once ('vendor/autoload.php');
require_once ('model/data-layer.php');

//Define default route
$f3->route('GET /', function(){
    //Display the home page
    $view = new Template();
    echo $view->render('views/home.html');
});

//Survey Route
$f3->route('GET /survey', function(){
    //Display the home page
    $view = new Template();
    echo $view->render('views/survey.html');
});

//Run Fat-Free
$f3->run();