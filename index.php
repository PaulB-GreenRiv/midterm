<?php
/*
 * Paul B.
    SDEV 328 - Midterm
    5/14/21
 */

//This is my controller for the diner project

//Turn on error-reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require autoload file
require_once ('vendor/autoload.php');
require_once ('model/data-layer.php');
require_once ('model/validation.php');

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
        $questionField = $_POST['quest'];


        //Send fields to sessions if valid
        if(validName($nameField)) {
            $_SESSION['name'] = $nameField;
        } else {
            $f3->set('errors["name"]', 'Invalid name');
        }

        if(!empty($questionField) && validQuestions($questionField)) {
            $questField = implode(", ", $_POST['quest']);
            $_SESSION['quest'] = $questField;
        } else {
            $f3->set('errors["quest"]', 'Please fill in at least one checkbox');
            $_SESSION['quest'] = "";
        }

        //Move if there are no errors
        if (empty($f3->get('errors'))) {
            header('location: summary');
        }
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