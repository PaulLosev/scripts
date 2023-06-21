
<!-- ./ css injection -->
<link href="/css/modalModules.css" rel="stylesheet" />
<!-- ./ css injection -->

<div class="regModule" style="display: none">
    <div class="rerModuleContainer">

        <!-- set the system spinner -->
        <div class="systemSpinner" style="display: none">

            <img src="/img/gameSpinner.svg" class="spinnerActual" />
        </div>
        <!-- end of the system spinner container -->

        <div class="regModuleCloseButton">X</div>
        <div class="regModuleFormContainer">
            <div class="regModuleFormHeader">

                <h2>Registration</h2>
                <p>Please, complete the form to play the game.</p>
            </div>

            <div class="validationNote">
                <div class="actualValidationConfirmation">
                    requared fields
                </div>
            </div>

            <form onsubmit="return false" method="post" id="regValidation">
                <input type="text" name="firstName" placeholder="First Name" class="regModuleInput" />
                <input type="text" name="lastName" placeholder="Last Name" class="regModuleInput" />
                <select class="regModuleInput widerSelect" name="tpState">
                    <option value="">Please select your location</option>
                    <?php

                        //
                        $promoPrizes->setTPstates();

                        // set the rep value.
                        $repValue = isset($_GET['email']) === true
                            ? $_GET['email']
                            : '';

                        // set the system variator.
                        $variator = isset($_GET['email']) === true
                            ? 'hidden'
                            : 'text';
                    ?>
                </select>
                <input type="hidden" name="userCustomLocation" placeholder="Please provide your location" class="regModuleInput" />
                <input type="text" name="userPosition" placeholder="Position / Title" class="regModuleInput" />
                <input type="text" name="userCompany" placeholder="Company / Organization" class="regModuleInput" />
                <input type="email" name="userEmail" placeholder="Email@gamil.com" class="regModuleInput" />
                <input type="<?php echo $variator; ?>"
                       name="userRep"
                       placeholder="Who invited you to play?"
                       class="regModuleInput"
                       value="<?php echo $repValue; ?>" />
                <input type="hidden" name="grid" value="" />
                <input type="hidden" name="square" value="" />
                <input type="submit" class="regModuleButton" dbconnect="<?php echo $retrieveNumber->setGames(); ?>" value="SUBMIT" />
            </form>
        </div>
    </div>
    <div class="notFoundError">

        <!-- ./ return thru java -->
    </div>
</div>

<div class="regModuleConfirmation" style="display: none">
    <div class="rerModuleContainer confirmationalDonsky">
        <div class="regModuleFormContainer">
            <div class="regModuleFormHeader">

                <h2>Game On!</h2>
                <p>Thanks for playing</p>

                <p class="adDonsky">
                    You have been successfully registered!
                        <br />
                    You can return to this page at any time to check your entry.
                        <br />
                            <br />
                    We’ll notify you when registration closes and the grid numbers are set.
                        <br />
                    Winners will also be notified after the big game.
                </p>
                <p>
                    <button class="afterTheReg" style="width: 40%">Good Luck</button>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="regModuleLogin" style="display: none">
    <div class="rerModuleContainer confirmationalDonsky">

        <!-- set the system spinner -->
        <div class="systemSpinner" style="display: none">

            <img src="/img/gameSpinner.svg" class="spinnerActual" />
        </div>
        <!-- end of the system spinner container -->

        <div class="regModuleCloseButton">X</div>
        <div class="regModuleFormContainer">
            <div class="regModuleFormHeader">

                <h2>Grid Check</h2>
                <p>Please enter your email</p>
            </div>

            <div class="validationNote">
                <div class="actualValidationConfirmation">
                    requared field
                </div>
            </div>

            <form onsubmit="return false">
                <input type="email" name="userEmailLogIn" placeholder="Email" class="regModuleInput" required />
                <input type="submit" class="logModuleButton" dbconnect="<?php echo $retrieveNumber->setGames(); ?>" value="SUBMIT" />
            </form>

        </div>
    </div>
    <div class="notFoundError">

        The email is not in the system
    </div>
</div>
