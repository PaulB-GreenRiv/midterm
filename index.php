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
$f3->route('GET|POST /survey', function($f3){

    //Reinitialize session array
    $_SESSION = array();

    //Initialize fields
    $nameField = "";
    $questField = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        //Assign POST to fields
        $nameField = $_POST['name'];
        $questField = implode(", ", $_POST['quest']);
        //Send fields to session
        $_SESSION['name'] = $nameField;
        $_SESSION['quest'] = $questField;

        header('location: summary');
    }

    $f3->set('questions', getQuestions());

    $view = new Template();
    echo $view->render('views/survey.html');
});

//Summary Route
$f3->route('GET|POST /summary', function($f3) {
    $view = new Template();
    echo $view->render('views/summary.html');
});

//Run Fat-Free
$f3->run();