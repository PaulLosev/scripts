
<?php

// region system settings.
// file connection instances.
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/connect/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/retrieveData.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/regModule.php';

// set the retrieve data instance.
$retrieveData = new retrieveData($mDb);

// save the queares.
$retrieveData->saveRandomSquare($_POST);
