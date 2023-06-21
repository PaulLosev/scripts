
<?php

// connect class
require_once $_SERVER['DOCUMENT_ROOT'] . 'cup/classes/gameTranslate.php';

// set class instance
$translate = new gameTranslate();

// call test method
$translate->translate($_POST);
