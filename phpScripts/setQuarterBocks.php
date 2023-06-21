
<?php

// region system settings.
// file connection instances.
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/connect/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/retrieveData.php';

// set the retreive class instance.
$retreiveData = new retrieveData($mDb);

// set the quarter id.
$quarter = empty($_POST['id']) === false
    ? $_POST['id']
    : false;

// set db variator
$db = empty($_POST['db']) === false
    ? $_POST['db']
    : false;

// pre set the quarters.
$retreiveData->preSetEachQuarter($quarter, $db);
