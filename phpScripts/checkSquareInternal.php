
<?php

// region system settings.
// file connection instances.
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/connect/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/regModule.php';

// set regMod class instance
$regMod = new regModule($mDb);

// check quare
$regMod->validateSquare($_POST);
