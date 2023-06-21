/**
 * Main methods.
 */
jQuery(function($) {

    // set the cookie.
    var userCookie = $.cookie('userGrid');

    // set login / logout buttons.
    var logInbutton = $('.afterLogin');
    var logOutButton = $('.logInbutton');

    // change container if cookie grid.
    if (userCookie !== undefined) {

        // set the items container.
        var squareWithId = $();

        // show the logout button.
        logOutButton.show();

    // if cookies set
    } else {

        // set the items container.
        var squareWithId = $('.mainGridContainer');
    }// end if

    // set the main grid children.
    var anItem = squareWithId.children();

    // set the reg module.
    var regModule = $('.regModule');

    // set the reg module close button.
    var regModuleCloseButton = $('.regModuleCloseButton');

    // set the regButton trigger.
    var regModuleButton = $('.regModuleButton');

    // set the body html container.
    var overflowControl = $('html, body');

    // set the rules container.
    var rulesConatier = $('.regModuleRules');

    // set the spinner container.
    var systemSpiner = $('.systemSpinner');

    // set the form parent container.
    var regValidation = $('#regValidation');

    // set the input children containers.
    var regFormData = regValidation.children('.regModuleInput');

    // set the validation notification container.
    var actualValidationConfirmation = $('.actualValidationConfirmation');

    // set the logo container.
    var actualLogo = $('.actualLogo');

    // set the conformational button.
    var afterTheReg = $('.afterTheReg');

    // set the login container.
    var regModuleLogin = $('.regModuleLogin');

    // set the login button.
    var loginFunctionTrigger = $('.logModuleButton');

    // set the error container.
    var errorContainer = $('.notFoundError');

    // set the body, html with no x overflow.
    overflowControl.addClass('xNone');

    // set the dropdown container.
    var locationChange = $('select[name=tpState]');

    // set user custom location.
    var userLocationInput = $('input[name=userCustomLocation]');

    //
    locationChange.change(function() {

        // set the outside USA value.
        var outSide = $(this).val();

        // if the outside USA
        if (outSide === 'out') {

            // show the custom location.
            userLocationInput.attr('type', 'text');
        } else {

            // hide the custom location.
            userLocationInput.attr('type', 'hidden');
        }// end if
    });

    //
    anItem.each(function() {

        // set the value to check.
        var localValue = $(this).attr('data-user');

        // see if no value.
        if (localValue === '') {

            // connect the function
            // to operate with UI.
            locals(this);
        }// end if
    });

    /**
     * Method sends grid Id and square id
     * opens up the regMod popup.
     *
     * @param string locals the id for click().
     */
    function locals(locals) {

        //
        $(locals).on({

            //
            mouseenter: function () {
                $(this).addClass('active');
            },

            //
            mouseleave: function() {
                $(this).removeClass('active');
            },

            //
            click: function () {

                // remove active class from all items.
                anItem.removeClass('active');

                //
                overflowControl.removeClass('xApproved');

                // remove the overflow x.
                overflowControl.addClass('oveflowKill');

                // set the grid.
                var gridUniq = $('.gridLayoutContainer').attr('data-grid');

                // set the id.
                var itemId = $(this).attr('data-value');

                // set the grid container and send grid id.
                $('input[name=grid]').val(gridUniq);

                // set the userSquare container and send square.
                $('input[name=square]').val(itemId);

                // add active class to the item.
                $(this).addClass('active');

                // show the regMod popup.
                regModule.show();

                // scroll to block
                $('html, body').animate({ scrollTop: regModule.offset().top + 200 }, 500);
            }// end click()
        });
    }// end locals()

    // close reg module.
    regModuleCloseButton.on({

        //
        click: function() {

            // close module.
            regModule.fadeOut('fast');

            // close rules.
            rulesConatier.fadeOut('fast');

            //
            overflowControl.addClass('xApproved');

            // set the border to inherit.
            regFormData.css({border: '1px solid rgba(0,0,0,.1)'});

            //
            actualValidationConfirmation.hide();

            //
            regModuleLogin.hide();

            // hide da error.
            errorContainer.hide();
        }// end click()
    });

    //
    regModuleButton.on({

        //
        click: function() {

            // set the user reg data.
            var grid = $('input[name=grid]').val();
            var square = $('input[name=square]').val();

            // set the confirm module.
            var cofirmModule = $('.regModuleConfirmation');

            // set db variator
            var dbconnect = $(this).attr('dbconnect');

            // set the form length.
            var formLenght = regFormData.length - 1;

            // set the approve array.
            var approveArray = [];

            // set methods
            import('/js/squareValidation.js').then((method) => {

                // check square before the rest of actions
                if (dbconnect === '?internal') {

                    // get validated square
                    var validatedSquare = method.validateSquare(grid, square, dbconnect);

                    // set error code by bool
                    if (validatedSquare.trim() === 'true') {

                        // show error
                        errorContainer.html(
                            '<h2>Sorry, this square was just taken.</h2>' +
                            '<button class="okayBtnOnRegMod">Please select another one</button>'
                        ).show();

                        // set close button
                        var closeMod = $('.okayBtnOnRegMod');

                        // close module
                        closeMod.on({

                            //
                            click: function() {

                                // close module.
                                regModule.fadeOut('fast');

                                // close rules.
                                rulesConatier.fadeOut('fast');

                                //
                                overflowControl.addClass('xApproved');

                                // set the border to inherit.
                                regFormData.css({border: '1px solid rgba(0,0,0,.1)'});

                                //
                                actualValidationConfirmation.hide();

                                //
                                regModuleLogin.hide();

                                // hide da error.
                                errorContainer.hide();
                            }// end click()
                        })// end closeMod()
                    // if square is not occupied
                    } else {

                        // call inputs validation
                        approveArray = method.validateInputs(
                            approveArray,
                            regFormData,
                            actualValidationConfirmation,
                            formLenght
                        );

                        // check if email is empty
                        if (approveArray[5] !== '') {

                            // call validate email on Double Entries
                            var userValidatedEmail = method.validateEmail(approveArray[5], dbconnect);

                            // check if email is not set in the db (double enntry)
                            if (userValidatedEmail.trim() !== 'true') {

                                // set validated values total.
                                var validatedTotal = approveArray.length;

                                // the total of all inputs on teh form.
                                console.log('%cTotal inputs on the form:', 'color: yellow');
                                console.log(approveArray);
                                console.log('%c' + validatedTotal + '', 'color: green; font-size: 1vw');

                                // set and end the validation
                                // move data to the db afterwords.
                                if (formLenght === validatedTotal) {

                                    // hide all requared fields notification.
                                    actualValidationConfirmation.hide();

                                    // call save user and move data to zapier method
                                    method.saveUser(
                                        approveArray,
                                        formLenght,
                                        grid,
                                        square,
                                        dbconnect,
                                        actualValidationConfirmation,
                                        systemSpiner
                                    );

                                    // hide the regModule.
                                    regModule.hide();

                                    // track the data.
                                    console.log('%cData sent to Zapier', 'color: green; font-size: .8vw');

                                    // show the conformational popup.
                                    cofirmModule.show();

                                    // hide the system spinner.
                                    systemSpiner.fadeOut('fast');
                                }// end if

                                // if email is in the db, show error (double entry true)
                            } else {

                                // track the double entry
                                console.log('%cEmail Double Entry', 'color: red; font-size: .8vw');

                                // show validation error container.
                                errorContainer.html('Sorry, the email is in the system. Please try another one').show();
                            }// end if
                        }// end if
                    }// end if
                // rest of the games
                } else {

                    // call inputs validation
                    approveArray = method.validateInputs(
                        approveArray,
                        regFormData,
                        actualValidationConfirmation,
                        formLenght
                    );

                    // check if email is empty
                    if (approveArray[5] !== '') {

                        // call validate email on Double Entries
                        var userValidatedEmail = method.validateEmail(approveArray[5], dbconnect);

                        // check if email is not set in the db (double enntry)
                        if (userValidatedEmail.trim() !== 'true') {

                            // set validated values total.
                            var validatedTotal = approveArray.length;

                            // the total of all inputs on teh form.
                            console.log('%cTotal inputs on the form:', 'color: yellow');
                            console.log(approveArray);
                            console.log('%c' + validatedTotal + '', 'color: green; font-size: 1vw');

                            // set and end the validation
                            // move data to the db afterwords.
                            if (formLenght === validatedTotal) {

                                // hide all requared fields notification.
                                actualValidationConfirmation.hide();

                                // call save user and move data to zapier method
                                method.saveUser(
                                    approveArray,
                                    formLenght,
                                    grid,
                                    square,
                                    dbconnect,
                                    actualValidationConfirmation,
                                    systemSpiner
                                );

                                // hide the regModule.
                                regModule.hide();

                                // track the data.
                                console.log('%cData sent to Zapier', 'color: green; font-size: .8vw');

                                // show the conformational popup.
                                cofirmModule.show();

                                // hide the system spinner.
                                systemSpiner.fadeOut('fast');
                            }// end if

                            // if email is in the db, show error (double entry true)
                        } else {

                            // track the double entry
                            console.log('%cEmail Double Entry', 'color: red; font-size: .8vw');

                            // show validation error container.
                            errorContainer.html('Sorry, the email is in the system. Please try another one').show();
                        }// end if
                    }// end if
                }// end if
            })// end import()
        }// end click()
    });

    // login / logout method.
    logInbutton.on({
        click: function () {

            // scroll to block
            $('html, body').animate({scrollTop: regModuleLogin.offset().top + 100}, 500);

            // show the log module.
            regModuleLogin.show();
        }// end click()
    });

    // logout method.
    logOutButton.on({

        //
        click: function() {

            //
            $.ajax({
                url: '/phpScripts/logout.php',
                type: 'post',
                data: {
                    unsetCookie: 'true',
                },

                success: function (out) {
                    console.log(out);
                },

                complete: function () {
                    location.reload();
                }
            })// end ajax call
        }// end click()
    })// end on()

    // log in method.
    loginFunctionTrigger.on({

        //
        click: function () {

            // set the email value.
            var userEmailValue = $('input[name=userEmailLogIn]').val();

            // set input container
            var emailInput = $('input[name=userEmailLogIn]');

            //
            emailInput.on({
                click: function() {

                    // clear da input.
                    $(this).val('');

                    // hide da error.
                    errorContainer.fadeOut('fast');

                    // show all requared fields notification.
                    actualValidationConfirmation.hide();

                    // hide the validation error.
                    emailInput.css({border: '1px solid rgba(0,0,0,.1)'});
                }// end click()
            });

            // check if user in the DB (validation second step)
            if (userEmailValue !== '') {

                // set db variator
                var dbconnect = $(this).attr('dbconnect');

                //
                $.ajax({
                    url: '/phpScripts/userCheckBeforeDeletion.php' + dbconnect,
                    type: 'post',
                    data: {
                        user: userEmailValue,
                    },

                    //
                    success: function(returnedInvoke) {

                        // set the bool
                        var userBool = returnedInvoke.trim();

                        //
                        if (userBool === 'true') {

                            // hide the validation error.
                            emailInput.css({border: '1px solid rgba(0,0,0,.1)'});

                            // set db variator
                            var dbconnect = loginFunctionTrigger.attr('dbconnect');

                            //
                            $.ajax({
                                url: '/phpScripts/login.php' + dbconnect,
                                type: 'post',
                                data: {
                                    userEmail: userEmailValue,
                                },

                                //
                                success: function(data) {

                                    // track some data.
                                    console.log(data);

                                    //
                                    if (data !== 'false') {

                                        //
                                        setTimeout(function() {

                                            // hide log in module.
                                            regModuleLogin.hide();

                                            // reload location.
                                            location.reload();
                                        }, 200);

                                        // if user not found.
                                    } else {

                                        // show error.
                                        errorContainer.fadeIn('fast');
                                    }// end if
                                },

                                //
                                beforeSend: function () {

                                    // show the spinner.
                                    systemSpiner.show();
                                },

                                //
                                complete: function () {

                                    // hide the spinner.
                                    systemSpiner.hide();
                                }// end complete
                            })// end ajax


                        // if empty input.
                        } else {

                            // show the validation error container.
                            errorContainer.show();
                        }// end if
                    },

                    //
                    beforeSend: function() {

                        // show spinner.
                        systemSpiner.show();
                    },

                    complete: function() {

                        // hide spinner.
                        systemSpiner.hide();
                    }// end complete()
                })// end ajax()

            // if no email provided.
            } else {

                // show all requared fields notification.
                actualValidationConfirmation.show();

                // hide the validation error.
                emailInput.css({border: '1px solid #cc0000'});
            }// end if
        }// end click()
    })// end on()
    // endregion login method

    //
    afterTheReg.on({

        //
        click: function() {

            // location reload.
            location.reload();
        }// end click()
    });

    //
    var logAdjuster = $('.actualLog');

    //
    var interval = 10000;

    // tp logo rotating
    setInterval(function() {
        logAdjuster.removeClass('logEffectirxBack')
            .addClass('logEffectirx');

        setTimeout(function() {
            logAdjuster.removeClass('logEffectirx')
                .addClass('logEffectirxBack');
        }, 1500);
    }, interval);

    // main logo zoom in / out
    setInterval(function() {
        actualLogo.removeClass('logZoomOut')
            .addClass('logZoomFor');

        setTimeout(function() {
            actualLogo.removeClass('logZoomFor')
                .addClass('logZoomOut');
        }, 1500);
    }, interval);
    // endregion
});

/**
 * autologin method()
 */
jQuery(function($) {

    // set the autolog button trigger
    var autologTrigger = $('.userAutoLoggedInBody button');

    // set the current url
    var url = new URL(window.location.href);

    //
    autologTrigger.on({

        //
        click: function() {

            //
            url.searchParams.delete('autologin');

            // push the value
            window.history.pushState('', '', url);

            // reload location
            location.reload();
        }// end click()
    })// end On()
})// end jQuery()

/**
 * show grid function()
 */
jQuery(function () {

    // set show game grid trigger
    var showGame = $('.leftSideContainer');

    // set th grid container
    var gridConatiner = $('.gridLayoutContainer');

    //
    showGame.on({

        //
        click: function() {

            //
            $('html, body').animate({ scrollTop: gridConatiner.offset().top + 800 }, 500);

            //
            gridConatiner.slideToggle(100);
        }// end click()
    })// end On()
})// end jQuery()