<?php

    // keep errors alive
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
    // set usage
    use admin\classes\saveData;
    // connect classes
    require_once $_SERVER['DOCUMENT_ROOT'] . 'trivia/admin/classes/saveData.php';
    // set the class instance
    $connect = new saveData();
    // call the double entry check
    $connect->saveMethod($_POST);
    // endregion
