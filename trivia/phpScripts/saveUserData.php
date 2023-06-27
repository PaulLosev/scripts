<?php

    // connect classes
    echo 'email type: ' . $_POST['emailType'] . PHP_EOL;
    echo 'method: ' . $_POST['method'] . PHP_EOL;
    print_r(json_decode($_POST['user']));
    print_r(json_decode($_POST['answers']));