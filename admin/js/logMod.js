
/**
 * Login Module
 */
jQuery(function() {

    // set the access container
    var accessContainr = $('.accesMod');

    // set the access form
    var accessForm = $('.accessForm');

    // set the pass input.
    var systemLogIn = $('.systemLogIn');

    // set the login trigger.
    var systemLogButton = $('.systemLogButton');

    // set the error token container.
    var errorToken = $('.logModErrorContainer');

    // set the uri hash
    var initiateLogin = window.location.hash;

    // set the complete notification container.
    var notificationContainer = $('.loginError');

    // set the system spinner.
    var systemSpinner = $('.actualSystemSpinner');

    //
    if (initiateLogin === '#granted') {

        // show the granted status.
        accessContainr.text('').addClass('granted');

        // show the access form.
        accessForm.fadeIn(200);

        // hide error token error.
        errorToken.hide();

        //
        systemLogButton.on({

            //
            click: function() {

                // set the pass valus.
                var passVal = systemLogIn.val();

                // if not empty input.
                if (passVal !== '') {

                    // set db variator
                    var dbconnect = $(this).attr('dbconnect');

                    //
                    $.ajax({
                        url: '/admin/misc/cmsLogin.php' + dbconnect,
                        type: 'post',
                        data: {
                            pass: passVal,
                        },

                        success: function (returnedCall) {

                            // if returned true.
                            if (returnedCall.trim() === 'true') {

                                // set db variator
                                var dbconnect = systemLogButton.attr('dbconnect');

                                //
                                $.ajax({
                                    url: '/admin/misc/systemLogin.php' + dbconnect,
                                   type: 'post',
                                   data: {
                                       access: 'granted',
                                   },

                                   success: function(granted) {
                                        console.log(granted);
                                   },

                                    beforeSend: function () {

                                        // show system sipnner.
                                        systemSpinner.fadeIn(200);
                                    },

                                    complete: function () {

                                        // hide system spinner.
                                        systemSpinner.fadeOut(200);

                                        // location reload.
                                        location.reload();
                                    }// end complete()
                                })// end ajax()

                            // if password is incorrect.
                            } else {

                                // show the confirmation.
                                notificationContainer.text(returnedCall).fadeIn(200);

                                // hide the notification.
                                setTimeout(function() {

                                    // hide notification.
                                    notificationContainer.fadeOut(200);
                                }, 3000)// end setTimeout()
                            }// end if
                        },

                        beforeSend: function () {

                            // show system sipnner.
                            systemSpinner.fadeIn(200);
                        },

                        complete: function () {

                            // hide system spinner.
                            systemSpinner.fadeOut(200);
                        }

                    })// end ajax()

                // if empty input.
                } else {

                    // show the confirmation.
                    notificationContainer.text('Please, provide system password').fadeIn(200);

                    // hide the notification.
                    setTimeout(function() {

                        // hide notification.
                        notificationContainer.fadeOut(200);
                    }, 3000)// end setTimeout()
                }// edn if
            }// end click()
        })// end on()

    } else {

        // show system token error.
        errorToken.fadeIn(200);

        // show the denided status.
        accessContainr.text('').addClass('denied');

        // hide the access form.
        accessForm.hide();

    }// end if
})// end jQuery
