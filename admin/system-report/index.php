
<?php

// region system settings.
// file connection instances.
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/connect/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/retrieveData.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/regModule.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/setHtml.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/login.php';

// set the html class instance.
$cmsHtml = new setHtml();

// set the regModule class instance.
$getSystemData = new regModule($mDb);

// set the loging class instace.
$login = new login($mDb);

// set retrieveData class instance
$getGames = new retrieveData($mDb);

// set the cms header.
$cmsHtml->setHeader($getGames->setGames());

// check for cookies;
$login->checkCookies();

// set the total grid.
$totalUserGrid = $getSystemData->getGrid()['grid'];

// set the total of users
$userTotal = count($getSystemData->selectAllRegisteredUsers());
?>

<!-- ./ cms body container -->
<div class="contentBody">

    <!-- reg module file connetction -->
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/admin/misc/adminTemplates.php'; ?>

    <!-- ./ go back button -->
    <div class="goBack" onclick="location.href='/admin/<?php echo $getGames->setGames(); ?>'">GO BACK</div>
    <div class="whereAmI">SYSTEM REPORT</div>
    <!-- ./ go back button -->

    <!-- ./ navigation container -->
    <div class="otherContainer">
        <div class="totalGrid">

            <p>Total Grids</p>
            <div class="totalCircle">
                <h3>
                    <?php echo $totalUserGrid; ?>
                </h3>
            </div>
        </div>
        <div class="totalGrid">

            <p>Total Registered Users</p>
            <div class="totalCircle">
                <h3>
                    <?php echo $userTotal; ?>
                </h3>
            </div>
        </div>
        <div class="totalGrid">
            <a href="/admin/misc/cvsCreator.php<?php echo $getGames->setGames(); ?>">
                <p><span>Download</span></p>
            </a> User Report
        </div>
        <div class="totalGrid">
            <a href="/admin/misc/winnerReport.php<?php echo $getGames->setGames(); ?>">
                <p><span>Download</span></p>
            </a> Winner Report
        </div>
    </div>
    <!-- ./ navigation container -->
</div>
<!-- ./ cms body container -->
<?php

// set the footer html.
$cmsHtml->setFooter();
