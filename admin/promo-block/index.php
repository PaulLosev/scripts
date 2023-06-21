
<?php

// region system settings.
// file connection instances.
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/connect/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/retrieveData.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/setHtml.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/login.php';

// set the html class instance.
$cmsHtml = new setHtml();

// set the loging class instace.
$login = new login($mDb);

// set the retreive class instance.
$getDbNumbers = new retrieveData($mDb);

// set the cms header.
$cmsHtml->setHeader($getDbNumbers->setGames());

// check for cookies;
$login->checkCookies();
?>
<!-- ./ cms body container -->
<div class="contentBody">

    <!-- reg module file connetction -->
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/admin/misc/adminTemplates.php'; ?>

    <!-- ./ go back button -->
    <div class="goBack" onclick="location.href='/admin/<?php echo $getDbNumbers->setGames(); ?>'">GO BACK</div>
    <div class="whereAmI">SET HELP LINK</div>
    <!-- ./ go back button -->

    <!-- ./ navigation container -->
    <div class="navigation">
        <ul>
            <li class="promoBlockTrigger" data-block-id="1" dbconnect="<?php echo $getDbNumbers->setGames(); ?>">HELP LINK</li>
        </ul>
    </div>
    <!-- ./ navigation container -->
</div>
<!-- ./ cms body container -->

<?php

    // set the footer html.
    $cmsHtml->setFooter();
