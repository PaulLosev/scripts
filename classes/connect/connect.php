
<?php

// Setting errors
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Making a connection by POD class to MySql.
if (isset($_GET['public']) === true) {

    // public game
    $mDb = new PDO('mysql:host=tpt-web4-db;dbname=promo_transperfectbowl', 'promo_transperfectbowl', 'gSE-T/349iq3Pvx');
} else if (isset($_GET['internal']) === true) {

    // internal game
    $mDb = new PDO('mysql:host=10.10.23.220;dbname=centralized', 'tptdbuser', 'tptdb2022');
    $bdcheck = 'internal db';
} else {

    // clients game
    $mDb = new PDO('mysql:host=tpt-web4-db;dbname=promo', 'promo', 'c,wiejF83V.3');
}// end if
