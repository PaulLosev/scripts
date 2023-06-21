
<?php

// region system settings.
// file connection instances.
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/connect/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/regModule.php';

// set the retrieve class instance.
$passwordChange = new regModule($mDb);

// set user id
$password = empty($_POST['cmsPass']) === false
    ? $_POST['cmsPass']
    : '';

// password change.
$passwordChange->passChange($password);
