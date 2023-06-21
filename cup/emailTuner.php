
<?php

// connect class
require_once $_SERVER['DOCUMENT_ROOT'] . 'cup/classes/emailSendOut.php';

// set class instance
$email = new emailSendOut();

// call test method
$email->sendEmailNotification('paul2house@gmail.com', 'ru');
