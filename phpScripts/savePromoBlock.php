
<?php

// region system settings.
// file connection instances.
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/connect/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/retrieveData.php';

// set the class instance.
$saveUpdatedBlock = new retrieveData($mDb);

// save the item.
$saveUpdatedBlock->saveUpdatedBlock($_POST);
