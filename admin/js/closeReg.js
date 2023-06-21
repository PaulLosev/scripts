
/**
 * Close Registration
 */
jQuery(function() {

    // set the system spinner.
    var systemSpinner = $('.actualSystemSpinner');

    // set the complete notification container.
    var notificationContainer = $('.notificationBody');

    // set the reset button.
    var closeReg = $('.initiateCloseReg');

    // set the confirmation conatainer.
    var confirmation = $('.closeUpInitiated');

    // set the modal
    var resetmodal = $('.theLeftSideCloseInputsContaner');

    //
    closeReg.bind({

        //
        dblclick: function() {

            // set db variator
            var dbconnect = closeReg.attr('dbconnect');

            //
            systemSpinner.fadeIn(100);

            //
            confirmation.text('initiated').addClass('initiated').animate({ width: '14vw', left: '-30px'}, 1700);

            // hide the module.
            resetmodal.hide();

            $.ajax({
                url: '/phpScripts/closeReg.php' + dbconnect,
                type: 'post',
                data: {
                    close: 'closed',
                },

                success: function(returnedData) {

                    // track php return.
                    console.log(returnedData);

                    //
                    setTimeout(function() {

                        //
                        confirmation.text('')
                            .animate({width: '0'}, 200);

                        //
                        notificationContainer.fadeOut('slow', function() {

                            //
                            location.reload();
                        });
                    }, 2500);
                },

                beforeSend: function() {

                    //
                    systemSpinner.fadeIn(100);

                },

                complete: function() {

                    //
                    setTimeout(function() {

                        //
                        systemSpinner.hide();

                        //
                        confirmation.text('done').addClass('greenConfirm');

                        // set the notification body.
                        notificationContainer.text('Registration has been closed').addClass('greenConfirm').show();
                    }, 1300);
                }// end complete()
            })// end ajax()
        },

        //
        click: function() {

            //
            resetmodal.fadeToggle(50);
        }// end click()
    })// end bind()
})// end ajax()
