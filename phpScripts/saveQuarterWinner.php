
<?php

// region system settings.
// file connection instances.
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/connect/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/retrieveData.php';

// set the retreive class instance.
$retreiveData = new retrieveData($mDb);

// save quater winners.
$retreiveData->saveQuaterWinners($_POST);
