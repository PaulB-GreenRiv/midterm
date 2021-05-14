<?php

//This is my controller for the diner project

//Turn on error-reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require autoload file
require_once ('vendor/autoload.php');
require_once ('model/data-layer.php');

//Instantiate Fat-Free
$f3 = Base::instance();



//Define default route
$f3->route('GET /', function(){
    //Display the home page
    $view = new Template();
    echo $view->render('views/home.html');
});

//Survey Route
$f3->route('GET /survey', function($f3){
    //Display the home page

    $f3->set('questions', getQuestions());

    $view = new Template();
    echo $view->render('views/survey.html');
});

//Run Fat-Free
$f3->run();