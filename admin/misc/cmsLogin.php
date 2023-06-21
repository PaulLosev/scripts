
<?php

// region system settings.
// file connection instances.
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/connect/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/login.php';

// set the login class instance.
$login = new login($mDb);

// set input pass value.
$passFromUser = empty($_POST['pass']) === false
    ? $_POST['pass']
    : '';

// login user
$login->validateInput($passFromUser);
