
<?php

// region system settings.
// file connection instances.
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/connect/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/regModule.php';

// set the reg module class instance.
$regModule = new regModule($mDb);

// set the reg module status.
$regStat = isset($_POST['close']) === true
    ? $_POST['close']
    : '';

// close registration.
$regModule->closeRegModule($regStat);
