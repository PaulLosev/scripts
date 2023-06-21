<?php

// file connection instances.r
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/connect/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/regModule.php';

// set the reg class instance.
$deleteCookie = new regModule($mDb);

// unset cookies.
$deleteCookie->setCookie('', '');
