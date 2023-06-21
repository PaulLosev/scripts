
<?php

    // Setting errors
    ini_set('display_errors', '1');
    error_reporting(E_ALL);

    // connect classes
    require_once $_SERVER['DOCUMENT_ROOT'] . 'cup/classes/csvReport.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . 'cup/classes/continentalSeparation.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . 'cup/classes/gameSettings.php';

    // set class csv report instance
    $csv = new csvReport();
    // set continental class instance
    $continental = new continentalSeparation();
    // game options
    // connect game settings class
    $settings = new gameSettings();

    // set reg mode options
    $settings->callRegSettings($_GET);

    // cast get and initiate report class
    $_GET['report'] = empty($_GET['report']) === false
        // set report logic
        ? $csv->csvDownload($_GET)
        : '';
?>
<!DOCTYPE html>
<html lang="<?php echo $continental->setDefaulLangCode(); ?>">
    <head>
        <title><?php echo $continental->getBrand(); ?> Cup Challenge</title>
        <meta charset="UTF-8">
        <meta name="description" content="Register today and win." />
        <meta property="og:image" content="/cup/images/social-share-transperfect.jpg" />
        <meta name="author" content="TP, MarComm, Paul Losev.">
        <meta name="robots" content="noindex" />
        <meta name="googlebot" content="noindex" />
        <meta name="googlebot-news" content="nosnippet">
        <meta name="viewport" content="width=device-width, initial-scale=.6, maximum-scale=.6, user-scalable=1" />
        <link rel="icon" type="image/png" href="/img/favicon.ico" />
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,500;0,600;0,700;1,500;1,600;1,700&display=swap" rel="stylesheet">
        <link href="https://promo.transperfect.com/cup/css/sgscc.css?<?php echo time(); ?>" rel="stylesheet">
        <link href="/cup/css/gameForm.css?<?php echo time(); ?>" rel="stylesheet">
        <link href="/cup/css/langMode.css?<?php echo time(); ?>" rel="stylesheet">
        <link href="/cup/css/mobile.css?<?php echo time(); ?>" rel="stylesheet">
        <!-- ./ jQuery servers -->
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" type="text/javascript"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" type="text/javascript"></script>
        <!-- ./ jQuery servers -->
    </head>
    <body>

    <!-- ./ main container wrapper -->
    <div class="mainGamesWrapper mobileWraper">

        <!-- ./ content -->
        <!-- ./ promotional container -->
        <div class="leftPromotionalContainer">
            <div class="gameRulesContainer">

                <?php $continental->setRulesWithContinental(); ?>
            </div>
        </div>
        <!-- ./ promotional container -->

        <!-- ./ game play container -->
        <div class="gamePlayContainer">

            <!-- ./ game play body -->
            <div class="gamePlayBody">

                <!-- ./ game play header -->
                <div class="gamePlayHeader">

                    <!-- ./ mobile version rules container -->
                    <div class="rulesOnMobile">
                        <button class="mobileRulesTrigger">RULES</button>
                        <div class="gameRulesContainerMobile" style="display: none">
                            <div class="gameRulsCloseMobileContainer">X</div>
                            <div class="rulesBodyMobile">
                                <!-- ./ return rules to mobile container -->
                            </div>
                        </div>
                    </div>
                    <!-- ./ mobile version rules container -->

                    <!-- ./ game header image logo -->
                    <img width="100%" height="100%" src="/cup/images/Desktop/Screen%201/logo.png" alt="logo" />
                </div>
                <!-- ./ game play header -->

                <!-- ./ game play playground -->
                <div class="gamePlayPlayground">

                    <!-- ./ data set returns -->
                </div>
                <!-- ./ game play playground -->
            </div>
            <!-- ./ game play body -->

        </div>
        <!-- ./ game play container -->
        <!-- ./ content -->

    </div>
    <!-- ./ main container wrapper -->
    </body>
</html>

<!-- ./ game logic class connect -->
<script src="/cup/js/gameLogic.js?<?php echo time(); ?>" type="text/javascript"></script>
<!-- ./ game logic class connect -->
