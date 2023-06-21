<?php

    ini_set('display_errors', '1');
    error_reporting(E_ALL);

    // Setting errors
    use classes\emailValidation;
    use classes\formUI;
    use classes\html;
    // connect classes
    require_once $_SERVER['DOCUMENT_ROOT'] . '/trivia/classes/formUI.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/trivia/classes/emailValidation.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/trivia/classes/html.php';
    // set class instance
    $htmlBuild = new html();
    $validateEmail = new emailValidation();
    $formUIBuild = new formUI();
    // set project head
    $htmlBuild->projectHead();
    // set email input
    $formUIBuild->buildFormInput();
    // set project footer
    $htmlBuild->projectFooter();
    // endregion
