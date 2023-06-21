
/**
 * Password change.
 */
jQuery(function($) {

    // set the system spinner.
    var systemSpinner = $('.actualSystemSpinner');

    // set the complete notification container.
    var notificationContainer = $('.notificationBody');

    // set the input container
    var userEmail = $('input[name=cmsPassReset]');

    // set delete user button.
    var resetPassBtn = $('.resetPass');

    // set the confirm text var.
    var confirmText = 'Please, provide a password';

    // set user email value var.
    var newPassValue = '';


    // clean up the input if clicked.
    userEmail.bind({

        //
        click: function() {

            // reset email input.
            userEmail.val('');
        }// end click()
    })// end bind()

    //
    resetPassBtn.bind({

        //
        click: function() {

            // set the value.
            newPassValue = userEmail.val();

            // if empty email (validation first step)
            if (newPassValue === '') {

                // scroll to top.
                $('html, body').animate({ scrollTop: 0 }, 200);

                // show error notification.
                notificationContainer.text(confirmText).addClass('redConfirm').show();

                // hide the notification.
                setTimeout(function() {

                    // hide notification.
                    notificationContainer.fadeOut('fast', function() {

                        // remove error class.
                        $(this).removeClass('redConfirm');
                    });
                }, 2000)// end setTimeout()

            // check if user in the DB (validation second step)
            } else {

                // set db variator
                var dbconnect = resetPassBtn.attr('dbconnect');

                // scroll to top.
                $('html, body').animate({ scrollTop: 0 }, 200);

                //
                $.ajax({
                    url: '/phpScripts/cmsPassChange.php' + dbconnect,
                   type: 'post',
                   data: {
                        cmsPass: newPassValue,
                   },

                   success: function(callBack) {

                       // scroll to top.
                       $('html, body').animate({ scrollTop: 0 }, 200);

                       // show error notification.
                       notificationContainer.text(callBack).addClass('greenConfirm').show();

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

                console.log(newPassValue);
            }// end if
        }// end click()
    })// ned bind()
})// jQuery endregion
