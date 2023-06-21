
/**
 * Set user color.
 */
jQuery(function($) {

    // set the system spinner.
    var systemSpinner = $('.actualSystemSpinner');

    // set the complete notification container.
    var notificationContainer = $('.notificationBody');

    // set user id input.
    var userEmail = $('input[name=userToChangeColor]');

    // set the color change trigger.
    var colorChangeTrigger = $('.setColor');

    // set user email value var.
    var userEmailValue = '';

    // set the confirm text vars.
    var confirmTextDelete = 'Please, provide user email';
    var noUserFound = 'No user has been found';

    //
    // clean up the input if clicked.
    userEmail.bind({

        //
        click: function() {

            // reset email input.
            userEmail.val('');
        }// end click()
    })// end bind()

    //
    colorChangeTrigger.bind({

        click: function() {

            // set the color var.
            var newColor = $('input[name=userColor]').val();

            // set the value.
            userEmailValue = userEmail.val();

            // if empty email (validation first step)
            if (userEmailValue === '') {

                // scroll to top.
                $('html, body').animate({ scrollTop: 0 }, 200);

                // show error notification.
                notificationContainer.text(confirmTextDelete).addClass('redConfirm').show();

                // hide the notification.
                setTimeout(function() {

                    // hide notification.
                    notificationContainer.fadeOut('fast', function() {

                        // remove error class.
                        $(this).removeClass('redConfirm');
                    });
                }, 2000)// end setTimeout()
            }// end if

            // check if user in the DB (validation second step)
            if (userEmailValue !== '') {

                // set db variator
                var dbconnect = colorChangeTrigger.attr('dbconnect');

                // scroll to top.
                $('html, body').animate({ scrollTop: 0 }, 200);

                //
                $.ajax({
                    url: '/phpScripts/userCheckBeforeDeletion.php' + dbconnect,
                    type: 'post',
                    data: {
                        user: userEmailValue,
                    },

                    success: function(returnedInvoke) {

                        // set the bool
                        var userBool = returnedInvoke.trim();

                        //
                        if (userBool === 'true') {

                            // set db variator
                            var dbconnect = colorChangeTrigger.attr('dbconnect');

                            //
                            $.ajax({
                                url: '/phpScripts/userSetColor.php' + dbconnect,
                                type: 'post',
                                data: {
                                    userId: userEmailValue,
                                    color: newColor,
                                },

                                success: function(deleted) {

                                    // track some data.
                                    console.log(deleted);

                                    // scroll to top.
                                    $('html, body').animate({ scrollTop: 0 }, 200);

                                    // show error notification.
                                    notificationContainer.text(deleted).addClass('greenConfirm').show();


                                    // hide the notification.
                                    setTimeout(function() {

                                        // hide notification.
                                        notificationContainer.fadeOut('fast', function() {

                                            // location reload.
                                            location.reload();
                                        });
                                    }, 2000)// end setTimeout()
                                },

                                beforeSend: function() {

                                    // show the system spinner.
                                    systemSpinner.fadeIn(200);
                                },

                                complete: function() {

                                    // show the system spinner.
                                    systemSpinner.fadeOut(200);
                                }// end complete()
                            })// end ajax()

                            //
                        } else {

                            // scroll to top.
                            $('html, body').animate({ scrollTop: 0 }, 200);

                            // show error notification.
                            notificationContainer.text(noUserFound).addClass('redConfirm').show();

                            // hide the notification.
                            setTimeout(function() {

                                // hide notification.
                                notificationContainer.fadeOut('fast', function() {

                                    // remove error class.
                                    $(this).removeClass('redConfirm');
                                });
                            }, 2000)// end setTimeout()

                        }// end if
                    },

                    beforeSend: function() {

                        // show the system spinner.
                        systemSpinner.fadeIn(200);

                    },

                    complete: function() {

                        // show the system spinner.
                        systemSpinner.fadeOut(200);

                    }// end complete()
                })// end ajax()
            }// end if
        }// end click()
    })// end bind()
})// end jQuery
