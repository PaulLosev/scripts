<?php

    // keep errors alive
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
    // set usage
    use admin\classes\validateData;
    // connect classes
    require_once $_SERVER['DOCUMENT_ROOT'] . 'trivia/admin/classes/validateData.php';
    // set the class instance
    $connect = new validateData();
    // call the double entry check
    $connect->validateGroupName($_POST);
    // endregion
