<?php

    // keep errors alive
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
    // set usage
    use admin\classes\deleteData;
    // connect classes
    require_once $_SERVER['DOCUMENT_ROOT'] . 'trivia/admin/classes/deleteData.php';
    // set the class instance
    $connect = new deleteData();
    // call the double entry check
    $connect->deleteQuestionGroup($_POST);
    // endregion
