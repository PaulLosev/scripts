
<?php

// region system settings.
// file connection instances.
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/connect/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/regModule.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/grid.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/retrieveData.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/gamePromotion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'classes/cvsDownload.php';

// the regMod class instance.
$userData = new regModule($mDb);

// set the rpizes / promo class instance.
$promoPrizes = new gamePromotion($mDb);

// set the reg / work grid.
$grid = new grid($mDb);

// set the retreive class instance.
$retrieveNumber = new retrieveData($mDb);

// set the csv class instance.
$salseClass = new cvsDownload($mDb);

// set the sales report request.
$salseReport = isset($_GET['salesreport']) === true
    ? $_GET['salesreport']
    : '';

// only if the sales token set
if (isset($_GET['salesreport']) === true) {

    // set game option
    $gameOption = empty($retrieveNumber->setGames()) === true
        ? 'clients'
        : $retrieveNumber->setGames();

    // set the headers.
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="users_' . $salseReport . '_sales_report_request_on_' . date('Y_m') . '_game_option_' . $gameOption . '.csv"');

    // send the salse report to the user.
    $salseClass->csvDownload('', $salseReport);
}// end if

// autologin
if (isset($_GET['autologin']) === true && empty($_GET['autologin']) === false) {

    // login user
    $userData->autologin($_GET['autologin']);
}// end if

// actual registaration grid.
$regGrid = $grid->continuousGrid();

// set the grid id by cookie.
$userGrid = isset($_COOKIE['userGrid']) === true
    ? $_COOKIE['userGrid']
    : $regGrid;

// set user id.
$userId = isset($_COOKIE['id']) === true
    ? $_COOKIE['id']
    : '';

// set the user name.
$userName = $userData->getUserName($userGrid, $userId);

// set the reg module status.
$regModuleStatus = $userData->getRegModuleStatus();

// update cookies.
if (isset($_COOKIE['userGrid']) === true) {

    // update the cookies.
    if ($userData->setCookie($userGrid, $userId) === true) {

        // send confirmation.
        echo '<script>

                // confirm on cookie update.
                console.log("%ccookies updated", "color: green; font-size: 1vw");
              </script>';
    }// end if
}// end if

// set grid visibily for none / registered users
$gridVisibily = isset($_COOKIE['userGrid']) === false
    ? 'style="display: none"'
    : '';
// endregion system settings
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>TransPerfect Squares Promotion</title>
        <meta charset="UTF-8">
        <meta name="description" content="Choose a square, watch the game, and win with TransPerfect!" />
        <meta name="author" content="TP, MarComm, Paul Losev">
        <meta name="robots" content="noindex" />
        <meta name="googlebot" content="noindex" />
        <meta name="googlebot-news" content="nosnippet">
        <meta name="viewport" content="width=device-width, initial-scale=.6, maximum-scale=.6, user-scalable=1" />
        <link rel="icon" type="image/png" href="/img/favicon.ico" />
        <meta property="og:image" content="https://promo.transperfect.com/img/social-squares.jpg" />
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,500;0,600;0,700;1,500;1,600;1,700&display=swap" rel="stylesheet">
        <link href="/css/footbalGame.css?<?php echo time(); ?>" rel="stylesheet">
        <link href="/css/mobileVersion.css?<?php echo time(); ?>" rel="stylesheet">
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
        <script src="js/losevJS.js?<?php echo time(); ?>"></script>
    </head>
    <body>

        <!-- ./ the system tpl connect -->
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/misc/templates.php'; ?>

        <!-- project wrapper -->
        <div class="containerWrapper">
            <div class="containerHeader">

                <!-- header container -->
                <div class="headerLogoContainer">
                    <img src="/img/tppromo.png" class="actualLogo" />
                </div>

                <?php

                    // check for a logut token.
                    if (isset($_GET['logout']) === true) {

                        echo '<!-- project navigation -->
                                <div class="projectNavigation">
                                    <button class="logInbutton"
                                            title="delete the whole module after the development"
                                            style="display: ">logout
                                    </button>' . PHP_EOL;
                    }// end if
                ?>

                </div>
                <!-- project navigation -->
            </div>

            <!-- project Body container -->
            <div class="containerBody">
                <div class="containerBodyHeader">

                    <?php $grid->setGreetings($userName, $retrieveNumber->getTeams()[0]['color'], $retrieveNumber->getTeams()[1]['color']); ?>
                </div>

                <!-- promotional block container -->
                <div class="promotionalBlockContainer">

                    <?php $retrieveNumber->setWiners($userGrid); ?>
                    <?php $promoPrizes->populatePormo(); ?>
                </div>
                <!-- promotional block container -->

                <div class="gridLayoutContainer" <?php echo $gridVisibily; ?> data-grid="<?php echo $regGrid; ?>">

                    <!-- ./ the top grid container -->
                    <div class="gridTopSide">

                        <!-- ./ top team color and name container -->
                        <div class="topTeamGridHeader" style="background: <?php echo $retrieveNumber->getTeams()[0]['color']; ?>">

                            <!-- ./ set the name and color of each team. -->
                            <?php echo $retrieveNumber->getTeams()[0]['name']; ?>
                        </div>

                        <!-- ./ actuall grid container -->
                        <div class="squareContainer logAdjuster">
                            <img src="/img/TPlog.png" width="55" class="actualLog" />
                        </div>

                        <!-- ./ set the top line of nubmers -->
                        <?php $retrieveNumber->setGridRandom('topGrid');?>
                    </div>
                    <!-- ./ the top grid container -->

                    <!-- ./ the left grid container -->
                    <div class="gridLeftSide">

                        <!-- ./ left team color and name container -->
                        <div class="leftTeamGridHeader" style="background: <?php echo $retrieveNumber->getTeams()[1]['color']; ?>">

                            <?php echo $retrieveNumber->getTeams()[1]['name']; ?>
                        </div>

                        <!-- ./ set the left line of nubmers -->
                        <?php $retrieveNumber->setGridRandom('leftGrid'); ?>
                    </div>
                    <!-- ./ the left grid container -->

                    <!-- ./ the main grid container -->
                    <div class="mainGridContainer">
                        <?php

                            // set the reg module status
                            $regModuleMultipleStatus = $regModuleStatus['regStatus'] === 'open'
                                ? $regVariator = 'none'
                                : (isset($_COOKIE['userGrid']) === true
                                    ? $regVariator = 'none'
                                    : $regVariator = '');
                        ?>

                        <!-- ./ the reg module close contaner -->
                        <div class="regModuleClosed" style="display: <?php echo $regModuleMultipleStatus; ?>">
                            <div class="regModuleClosedBody">

                                <h3>Registration is Closed</h3>

                                <p>
                                    Thank you for your participation.
                                </p>
                                <p>
                                    All grids have been closed and numbers have been randomly assigned.
                                </p>
                                <p>
                                    If you missed out this year, <a href="mailto:webpromotions@transperfect.com">email us</a>
                                    to make sure you get your invitation early for next year!
                                </p>
                            </div>
                        </div>
                        <!-- ./ the reg module close contaner -->

                        <!-- set the grid (reg or user) -->
                        <?php $grid->setRegGrid($userGrid); ?>
                    </div>
                    <!-- ./ the main grid container -->
                </div>

            </div>
            <!-- project Body container -->

            <!-- project footer container -->
            <div class="containerFooter">

                <?php $promoPrizes->setFooterData(); ?>
            </div>
            <!-- project footer container -->
        </div>
        <!-- end project ui wrapper -->
    </body>
</html>
