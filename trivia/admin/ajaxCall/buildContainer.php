<?php

    // keep errors alive
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
    // set usage
    use admin\classes\containerBuilderClass;
    // connect classes
    require_once $_SERVER['DOCUMENT_ROOT'] . 'trivia/admin/classes/containerBuilderClass.php';
    // set the class instance
    $connect = new containerBuilderClass();
    // call the double entry check
    $connect->setMethod($_POST);
    // endregion
