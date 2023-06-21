
<!-- ./ losev CSM login mod -->
<!-- ./ css injection -->
<link href="/admin/css/logMod.css" rel="stylesheet" />
<!-- ./ css injection -->

<div class="cmsLogMod">
    <div class="letterDecorationModal">

        LOSEV CMS
    </div>
    <div class="logModContainer">

        <!-- ./ Error container -->
        <div class="loginError"></div>

        <div class="logModErrorContainer">
            <span>Please,</span> provide system token
        </div>

        <!-- ./ access mod container -->
        <div class="accesModContainer">

            <div class="accesMod"></div>
        </div>
        <!-- ./ access mod container -->

        <div class="accessForm" style="display: none">
            <input type="password" name="systemLogIn" class="systemLogIn" placeholder="input password ..." />
            <button class="systemLogButton" dbconnect="<?php echo $getDbNumbers->setGames(); ?>">Login</button>
        </div>
    </div>
</div>

<!-- ./ java script injection -->
<script src="/admin/js/logMod.js" ></script>
<!-- ./ java script injection -->
<!-- ./ losev CSM login mod -->
