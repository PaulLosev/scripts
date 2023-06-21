
<?php

// Setting errors
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Making a connection by POD class to MySql.
if (isset($_GET['public']) === true) {

    // public game
    $mDb = new PDO('mysql:host=;dbname=', '', '');
} else if (isset($_GET['internal']) === true) {

    // internal game
    $mDb = new PDO('mysql:host=;dbname=', '', '');
    $bdcheck = 'internal db';
} else {

    // clients game
    $mDb = new PDO('mysql:host=;dbname=', '', '');
}// end if
