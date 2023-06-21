
<?php

// region system settings.
// file connection instances.
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/connect/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/regModule.php';

// set the retrieve class instance.
$userCheck = new regModule($mDb);

// set user id
$endUser = empty($_POST['userId']) === false
    ? $_POST['userId']
    : '';

// set user id
$color = empty($_POST['color']) === false
    ? $_POST['color']
    : '';

// check if user exists.
$userCheck->userSetColor($endUser, $color);
