
<?php

// set headers.
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="promo_game_winner_report_' . date('Y_m') . '_losevCMS.csv"');

// region system settings.
// file connection instances.
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/connect/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/cvsDownload.php';

// set the class instance.
$csvSend = new cvsDownload($mDb);

// generate .csv and send it to user.
$csvSend->csvDownload('winnerReport');
