
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

// set the reg module status.
$regModuleStatus = $getSystemData->getRegModuleStatus();

// unset registration close button on internal game
$internal = isset($_GET['internal']) === true
    ? 'style="display: none"'
    : '';

// set the reg module invocation.
$currentStatus = $regModuleStatus['regStatus'] === 'open'
    ? 'initiateCloseReg'
    : 'regModuleClosed';

// set the button status.
$closeButtonTitle = $regModuleStatus['regStatus'] === 'open'
    ? 'Close'
    : 'Closed';

?>

<!-- ./ cms body container -->
<div class="contentBody">

    <!-- ./ css injection -->
    <link href="/admin/css/systemSettings.css" rel="stylesheet" />
    <!-- ./ css injection -->

    <!-- reg module file connetction -->
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/admin/misc/adminTemplates.php'; ?>

    <!-- ./ go back button -->
    <div class="goBack" onclick="location.href='/admin/<?php echo $getGames->setGames(); ?>'">GO BACK</div>
    <div class="whereAmI">SETTINGS</div>
    <!-- ./ go back button -->

    <!-- ./ navigation container -->
    <div class="otherContainer">

        <!-- ./ System Reset -->
        <div class="totalGrid">

            <p>System Reset</p>
            <div class="systemResetContainer">
                <div class="theLeftSideInputsContaner">
                    <p><span>Warning! </span>you are about to reset the system</p>
                    <p><span>Note: </span>please, make a backup of the system by
                        downloading the reports on the <a href="https://promo.transperfect.com/admin/system-report/<?php echo $getGames->setGames(); ?>">system report page</a>.
                    </p>
                    <p><span>To initiate reset: </span> please, double click the reset button.</p>
                    <p><span>After the reset: </span>you will be able to use the game as you did a year before</p>
                </div>

                <buton class="initiateReset" dbconnect="<?php echo $getGames->setGames(); ?>">Reset</buton>
                <div class="resetInitiated">

                    <!-- ./ javaScript Content -->
                </div>
            </div>
            <!-- ./ reset js -->
            <script src="/admin/js/systemReset.js"></script>
        </div>
        <!-- ./ System Reset -->

        <!-- ./ close reg module -->
        <div class="totalGrid" >

            <p>Close Registration</p>
            <div class="systemCloseUptContainer">
                <div class="theLeftSideCloseInputsContaner">
                    <p><span>Warning: </span>you are about to close the registration!</p>
                    <p><span>Note: </span> registration will open again once the game reset.</p>
                    <p><span>To close the reg module: </span> please, double click the close button.</p>
                </div>

                <buton class="<?php echo $currentStatus; ?>" dbconnect="<?php echo $getGames->setGames(); ?>" <?php echo $internal; ?>>

                    <?php echo $closeButtonTitle; ?>
                </buton>
                <div class="closeUpInitiated">

                    <!-- ./ javaScript Content -->
                </div>
            </div>
            <!-- ./ reset js -->
            <script src="/admin/js/closeReg.js"></script>
        </div>
        <!-- ./ close reg module -->

        <!-- ./ CMS Password Reset -->
        <div class="totalGrid">

            <p>CMS Password Reset</p>
            <div class="deleteUserContainer">
                <input type="text" name="cmsPassReset" class="userToDelete" placeholder="new password ..." />
                <button class="resetPass" dbconnect="<?php echo $getGames->setGames(); ?>">Reset</button>
            </div>
            <!-- ./ CMS password reset js -->
            <script src="/admin/js/cmsPasswordReset.js"></script>
        </div>
        <!-- ./ CMS Password Reset -->

        <!-- ./ delete user method -->
        <div class="totalGrid">

            <p>Delete User</p>
            <div class="deleteUserContainer">
                <input type="email" name="userToDelete" class="userToDelete" placeholder="user email ..." />
                <button class="deleteUser" dbconnect="<?php echo $getGames->setGames(); ?>">Delete</button>
            </div>
            <!-- ./ delete user js -->
            <script src="/admin/js/deleteUser.js"></script>
        </div>
        <!-- ./ delete user method -->

        <!-- ./ CMS Password Reset -->
        <div class="totalGrid setTeamDonsky">

            <p>Set Teams</p>
            <div class="deleteUserContainer">
                <select name="teamId" class="selectTeam">
                    <option value="">Select team</option>
                    <option value=""></option>
                    <option value="1">Top Team</option>
                    <option value="2">Left Team</option>
                </select>
                <input type="text" name="teamName" class="teamName" placeholder="set a team name ..." />
                <input type="color" name="setTeamColor" class="userColor" value="#FFD700" />
                <button class="setTeam" dbconnect="<?php echo $getGames->setGames(); ?>">Set team</button>
            </div>
            <!-- ./ delete user js -->
            <script src="/admin/js/setTeam.js"></script>

        </div>
        <!-- ./ CMS Password Reset -->

        <!-- ./ CMS Password Reset -->
        <div class="totalGrid">

            <p>Set user color</p>
            <div class="deleteUserContainer">
                <input type="email" name="userToChangeColor" class="userToChangeColor" placeholder="user email ..." />
                <input type="color" name="userColor" class="userColor" value="#e66465" />
                <button class="setColor" dbconnect="<?php echo $getGames->setGames(); ?>">Set color</button>
            </div>
            <!-- ./ delete user js -->
            <script src="/admin/js/setColor.js"></script>
        </div>
        <!-- ./ CMS Password Reset -->
    </div>
    <!-- ./ navigation container -->
</div>
<!-- ./ cms body container -->
<?php

// set the footer html.
$cmsHtml->setFooter();
