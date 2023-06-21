
<?php

// set classes
require_once $_SERVER['DOCUMENT_ROOT'] . 'march-madness/classes/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'march-madness/classes/formUI.php';
// set class instance
$formUI = new formUI($mDb);

// TODO:set a part of CMS logic
// close registration
isset($_GET['closed']) === false
    ? $formUI->gameClosed()
    : '';
?>
<!DOCTYPE HTML>
<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <meta name="author" content="Paul Losev, TPT">
    <meta name="viewport" content="width=device-width, initial-scale=.6, maximum-scale=.6, user-scalable=0" />
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/coderitual/odoo/feature/codevember16/lib/odoo.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="/march-madness/js/madnessclass.js?=<?php echo time(); ?>"></script>
    <link href="/march-madness/css/style.css?=<?php echo time(); ?>" rel="stylesheet" />
</head>
<body>

<!-- ./ game main wraper container -->
<div class="gameContainer">

    <!-- ./ game animation container -->
    <div class="gameAnimation" style="display: none">

        <h2>Thank you for playing!</h2>
        <div class="mainAnimationConatainer">

            <!-- ./ animation conatiner -->
            <div class="animationItmeContainer">

                <!-- ./ animation conatiner headline -->
                <span>Your Cinderella team is</span>

                <div class="js-odoo">Cinderella</div>
            </div>

            <!-- ./ animation conatiner -->
            <div class="animationItmeContainer">

                <!-- ./ animation conatiner headline -->
                <span>Your Blue Chip team is</span>

                <div class="js-odoo2">Blue Chip</div>
            </div>
        </div>

        <!-- ./ animation conatiner thankyou notes -->
        <p>If your Cinderella wins its first full field game, you win a $25 Amazon gift card.</p>
        <p>If your Blue Chip team wins the tournament, you win a $100 Amazon, Apple or VISA gift card.</p>
        <h2>Good luck!</h2>
    </div>

    <!-- ./ game safe container -->
    <div id="safeContainer">

        <!-- ./ game header container -->
        <div class="gameHeader" style="background: right center url('/march-madness/img/bs.png') no-repeat; background-size: 50% auto">


            <img src="https://cdn-forpci1.actonsoftware.com/acton/attachment/687/f-273c2279-05e1-4b47-8b21-0c460ab680e4/2/-/-/-/-/?v=" style="width:100%" />

            <?php /*    <!-- ./ logo container -->
                <span class="TPlogo">
                   <img src="/march-madness/img/tplog.png" />
                </span>

                <!-- ./ game motto container -->
                <span class="firstLine">Cinderellas</span>
                <span class="secondLine">and</span>
                <span class="thirdLine">Blue Chips</span>
               */ ?>
        </div>
        <!-- ./ game header container -->

        <!-- ./ game play container -->
        <div class="gameFormContainer">

            <!-- ./ info container -->
            <div class="infoContainer" style="background: top center url('/march-madness/img/bck.png') no-repeat">
                <div class="infoContainerBody">
                    <h2></h2>

                    <!-- ./ info -->
                    <p><strong>The rules are simple.</strong></p>

                    <P>Upon signing up, you will be randomly assigned two teams: a Cinderella team (a 9 through 16 seed) and a Blue Chip team (a 1 through 8 seed).</p>

                    <P>If your Cinderella wins its first full-field game, you win the Cinderella prize: a $25 Amazon gift card.</p>

                    <P>If your Blue Chip goes all the way and wins the tournament, you win the Blue Chip prize: a $100 Amazon, Apple or VISA gift card.</p>

                    <!-- ./ links -->
                    <?php
                    /*
                    <div class="infoContainerLinks">
                        <a href="#">Demo</a>
                        <a href="#">Demo</a>
                        <a href="#">Demo</a>
                    </div>
                    */
                    ?>
                </div>
            </div>

            <!-- ./ form container -->
            <div class="formItemContainer">
                <h2>Please complete all fields to play</h2>

                <!-- ./ set form items -->
                <?php $formUI->setFormUI(); ?>

                <!-- ./ submit button container -->
                <div class="formItem">
                    <button class="submitForm" onclick="logic.validate($(this).parent().parent())">Submit Your Info</button>
                </div>
            </div>
        </div>
        <!-- ./ game play container -->

        <!-- ./ game footer container -->
        <div class="gameFooter">

            <P>A maximum of one entry per person is allowed.</p>

            <P>While we welcome you to invite professional colleagues and contacts to the game, we ask that you limit referrals to your close business network only. TransPerfect reserves the right to invalidate entries from personal email addresses or from individuals who are unable to name the TransPerfect representative who invited them to play.</P>

            <P>&copy; <?php echo gmdate('Y');?> All Rights Reserved. TransPerfect</P>



        </div>
        <!-- ./ game footer container -->
    </div>

</div>
</body>
<script>

    // set the class instance
    let logic = new submitFormData();
</script>
</html>
