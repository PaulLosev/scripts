
<?php

// connect class
require_once $_SERVER['DOCUMENT_ROOT'] . 'cup/classes/gameSettings.php';

// set class instance
$options = new gameSettings();

// call test method
$options->getRegMode();
