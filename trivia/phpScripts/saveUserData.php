<?php

    // keep errors alive
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
    // set usage
    use classes\saveUserData;
    // connect classes
    require_once $_SERVER['DOCUMENT_ROOT'] . 'trivia/classes/saveUserData.php';
    // set the class instance
    $connect = new saveUserData();
    // call the double entry check
    $connect->save($_POST);
    // endregion
