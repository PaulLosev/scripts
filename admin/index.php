
<?php

// region system settings.
// file connection instances.
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/connect/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/setHtml.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/retrieveData.php';

// set the html class instance.
$cmsHtml = new setHtml();

// set the retreiveData class instance.
$getDbNumbers = new retrieveData($mDb);

// set db tracker
$option = $getDbNumbers->setGames();

// set the cms header.
$cmsHtml->setHeader($option);

// set the cookie check var.
$cookieCheck = isset($_COOKIE['permission']) === true && $_COOKIE['permission'] === 'granted'
    ? ''
    : include $_SERVER['DOCUMENT_ROOT'] . 'admin/misc/loginMod.php';

// set the locked notification
$locked = $getDbNumbers->setSaveRandomGridButton() === $getDbNumbers::DISABLED_CLASS
    ? '<span class="usersNotified" title="The grid numbers set. The users notified.">locked</span>'
    : '';

// set acess link
$accessLink = empty($locked) === true
    ? '/admin/set-random-squares/' . $getDbNumbers->setGames()
    : '';
?>
  
    <div class="contentBody">
        <div class="navigation">
            <ul>
                <li><a href="<?php echo $accessLink; ?>">SET GRID SQUARES</a>
                    <?php echo $locked; ?>
                </li>
                <li><a href="/admin/set-quarter-winner/<?php echo $getDbNumbers->setGames(); ?>">SET QUARTER WINNERS</a></li>
                <li><a href="/admin/promo-block/<?php echo $getDbNumbers->setGames(); ?>">SET HELP LINK</a></li>
                <li><a href="/admin/system-report/<?php echo $getDbNumbers->setGames(); ?>">SYSTEM REPORT</a></li>
                <li><a href="/admin/settings/<?php echo $getDbNumbers->setGames(); ?>">SETTINGS</a></li>
            </ul>
        </div>
    </div>

<?php

    // set the footer html.
    $cmsHtml->setFooter();
