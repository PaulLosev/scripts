<?php

// file connection instances.r
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/connect/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/regModule.php';

// set the class instance.
$userLogin = new regModule($mDb);

// set the email id.
$userEmail = empty($_POST['userEmail']) === false
    ? $_POST['userEmail']
    : '';

// log in.
$userLogin->userLogin($userEmail);
