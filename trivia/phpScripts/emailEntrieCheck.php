<?php

    // set usage
    use classes\emailValidation;
    // connect classes
    require_once $_SERVER['DOCUMENT_ROOT'] . 'trivia/classes/emailValidation.php';
    // set the class instance
    $connect = new emailValidation();
    // call the double entry check
    $connect->takeEmailValue($_POST['value']);
    // endregion
