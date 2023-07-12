<?php

    ini_set('display_errors', '1');
    error_reporting(E_ALL);

    // set usages
    use admin\classes\html;
    use admin\classes\modules;

    // connect classes
    require_once $_SERVER['DOCUMENT_ROOT'] . 'trivia/admin/classes/modules.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . 'trivia/admin/classes/html.php';
    // set class instances
    $html = new html();
    $modules = new modules();
    // set admin html
    $html->projectHead();
    // set admin html
    $html->projectFooter();
