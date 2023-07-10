<?php

    // keep errors alive
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
    // set usage
    use admin\classes\projectNavigation;
    // connect classes
    require_once $_SERVER['DOCUMENT_ROOT'] . 'trivia/admin/classes/projectNavigation.php';
    // set the class instance
    $connect = new projectNavigation();
    // call the double entry check
    $connect->buildNagivation($_POST);
    // endregion
