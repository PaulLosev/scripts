<?php

    // keep errors alive
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
    // set usage
    use admin\classes\updateData;
    // connect classes
    require_once $_SERVER['DOCUMENT_ROOT'] . 'trivia/admin/classes/updateData.php';
    // set the class instance
    $connect = new updateData();
    // call the double entry check
    $connect->updateGroupName($_POST);
    // endregion
