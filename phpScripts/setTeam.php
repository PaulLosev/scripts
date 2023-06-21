<?php

// region system settings.
// file connection instances.
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/connect/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/retrieveData.php';

// set the retreive data class instance.
$resetSystem = new retrieveData($mDb);

// reset system.
$resetSystem->setTeams($_POST);
