
<?php

// Setting errors
ini_set('display_errors', '1');
error_reporting(E_ALL);

// set the classes.
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/connect/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/regModule.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/grid.php';

// set the regModule class instance.
$addUser = new regModule($mDb);

// reg new user.
$addUser->regNewUser($_POST);
