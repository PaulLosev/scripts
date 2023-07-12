<?php

    // keep errors alive
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
    // set usage
    use admin\classes\modules;
    // connect classes
    require_once $_SERVER['DOCUMENT_ROOT'] . 'trivia/admin/classes/modules.php';
    // set the class instance
    $connect = new modules();
    // call the double entry check
    $connect->triviaQuestions($_POST);
    // endregion
