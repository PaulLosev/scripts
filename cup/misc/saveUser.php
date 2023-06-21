
<?php

// connect class
require_once $_SERVER['DOCUMENT_ROOT'] . 'cup/classes/saveData.php';

// set class instance
$saveData = new saveData();

// call test method
$saveData->saveUserData($_POST);
