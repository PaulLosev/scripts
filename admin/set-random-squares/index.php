
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

// set the retreiveData class instance.
$getDbNumbers = new retrieveData($mDb);

// set the loging class instace.
$login = new login($mDb);

// set the cms header.
$cmsHtml->setHeader($getDbNumbers->setGames());

// check for cookies;
$login->checkCookies();
?>

<!-- ./ cms body container -->
<div class="contentBody">

    <!-- reg module file connetction -->
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/admin/misc/adminTemplates.php'; ?>

    <!-- grid set module connect -->
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/admin/misc/confirmMod.php'; ?>

    <!-- ./ css injection -->
    <link href="/admin/css/setRandomSquares.css" rel="stylesheet" />
    <!-- ./ css injection -->

    <!-- ./ go back button -->
    <div class="goBack" onclick="location.href='/admin/<?php echo $getDbNumbers->setGames(); ?>'">GO BACK</div>
    <div class="whereAmI">SET THE SQUARES</div>
    <!-- ./ go back button -->

    <!-- ./ navigation container -->
    <div class="otherContainer">

        <div class="setRandomSquaresContainer">
            <h3>Set the top line of numbers</h3>
            <p>from left to right</p>

            <!-- ./ the first row -->
            <div id="fisrtRow">

                <!-- ./ set the inputs -->
                <?php $getDbNumbers->setRandomSquares('top'); ?>
            </div>
            <!-- ./ the first row -->

            <!-- ./ decor block -->
            <div class="decorBlock">
                <div class="randomValueInputDecor"></div>
                <div class="randomValueInputDecor"></div>
                <div class="randomValueInputDecor"></div>
            </div>
            <!-- ./ decor block -->

            <div class="resetGrid">
                <button class="resetButtonTop">Reset</button>
            </div>
        </div>

        <div class="setRandomSquaresContainerLeftLine">
            <h3>Set the left line of numbers</h3>
            <p>from top to bottom</p>

            <!-- ./ the second row -->
            <div id="secondRow">

                <!-- ./ decor block -->
                <div class="decorBlockLeft">
                    <div class="randomValueInputDecorLeft"></div>
                    <div class="randomValueInputDecorLeft"></div>
                    <div class="randomValueInputDecorLeft"></div>
                </div>
                <!-- ./ decor block -->

                <!-- ./ set the inputs -->
                <?php $getDbNumbers->setRandomSquares('left'); ?>
            </div>
            <!-- ./ the second row -->

            <div class="resetGridLeft">
                <button class="resetButton">Reset</button>
            </div>
        </div>

        <div class="resetButtonContainer">

            <button class="<?php echo $getDbNumbers->setSaveRandomGridButton(); ?>" data-save="true" dbconnect="<?=$getDbNumbers->setGames(); ?>">SAVE</button>
        </div>

        <!-- ./ erro container -->
        <div class="errorContainer">

        </div>
        <!-- ./ erro container -->
    </div>
    <!-- ./ navigation container -->
</div>
<!-- ./ cms body container -->

<?php

    // set the footer html.
    $cmsHtml->setFooter();
