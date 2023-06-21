
/**
 * System reset
 */
jQuery(function() {

    // set the system spinner.
    var systemSpinner = $('.actualSystemSpinner');

    // set the complete notification container.
    var notificationContainer = $('.notificationBody');

    // set the reset button.
    var reset = $('.initiateReset');

    // set the confirmation conatainer.
    var confirmation = $('.resetInitiated');

    // set the modal
    var resetmodal = $('.theLeftSideInputsContaner');

    reset.bind({

        //
        dblclick: function() {

            // set db variator
            var dbconnect = reset.attr('dbconnect');

            //
            systemSpinner.fadeIn(100);

            //
            confirmation.text('initiated').addClass('initiated').animate({width: '14vw', left: '-30px'}, 1700);

            // hide the module.
            resetmodal.hide();

            $.ajax({
                url: '/phpScripts/systemReset.php' + dbconnect,
                type: 'post',
                data: {
                    reset: 'initiate',
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
                        notificationContainer.text('System has been reset').addClass('greenConfirm').show();
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
