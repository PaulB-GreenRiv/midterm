<?php
/*
 * Paul B.
    SDEV 328 - Midterm
    5/14/21
 */

//Validates Name
function validName($name)
{
    return strlen(trim($name)) >= 2;
}

//Validates Questions
function validQuestions($quest)
{
    $validQuestions = getQuestions();

    foreach ($quest as $userChoice) {
        if (!in_array($userChoice, $validQuestions)) {
            return false;
        }
    }
    return true;
}