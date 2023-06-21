
<?php

// connect class
require_once $_SERVER['DOCUMENT_ROOT'] . 'cup/classes/continentalSeparation.php';

// set class instance
$currencyDaya = new continentalSeparation();

// call test method
$currencyDaya->getUserContinentCurrency();
