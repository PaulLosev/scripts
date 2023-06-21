
<?php

// region system settings.
// file connection instances.
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/connect/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/retrieveData.php';

$setBlockData = new retrieveData($mDb);

// set the block id.
$blockId = empty($_POST['promoBlockId']) === false
    ? $_POST['promoBlockId']
    : '';

// set the data.
$setBlockData->setPromoBlock($blockId);
