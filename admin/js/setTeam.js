
/**
 * Set user color.
 */
jQuery(function($) {

    // set the system spinner.
    var systemSpinner = $('.actualSystemSpinner');

    // set the complete notification container.
    var notificationContainer = $('.notificationBody');

    // set the color / name change trigger.
    var setTeamTrigger = $('.setTeam');

    // set the confirm text vars.
    var confirmTextTeam = 'Please select a team';
    var confirmNameTeam = 'Please provide team name';

    //
    setTeamTrigger.bind({

        //
        click: function() {

            // set the team id.
            var teamId = $('select[name=teamId]').val();

            // set team name.
            var teamName = $('input[name=teamName]').val();

            // set the color var.
            var newColor = $('input[name=setTeamColor]').val();

            // if empty email (validation first step)
            if (teamId === '') {

                // scroll to top.
                $('html, body').animate({ scrollTop: 0 }, 200);

                // show error notification.
                notificationContainer.text(confirmTextTeam).addClass('redConfirm').show();

                // hide the notification.
                setTimeout(function() {

                    // hide notification.
                    notificationContainer.fadeOut('fast', function() {

                        // remove error class.
                        $(this).removeClass('redConfirm');
                    });
                }, 2000)// end setTimeout()
            }// end if

            // if empty email (validation first step)
            if (teamName === '') {

                // scroll to top.
                $('html, body').animate({ scrollTop: 0 }, 200);

                // show error notification.
                notificationContainer.text(confirmNameTeam).addClass('redConfirm').show();

                // hide the notification.
                setTimeout(function() {

                    // hide notification.
                    notificationContainer.fadeOut('fast', function() {

                        // remove error class.
                        $(this).removeClass('redConfirm');
                    });
                }, 2000)// end setTimeout()
            }// end if

            // if all validated values came.
            if (teamId !== '' && teamName !== '') {

                // set db variator
                var dbconnect = setTeamTrigger.attr('dbconnect');

                // set the ajax call to the php.
                $.ajax({
                    url: '/phpScripts/setTeam.php' + dbconnect,
                   type: 'post',
                   data: {
                       teamId: teamId,
                       teamName: teamName,
                       teamColor: newColor,
                   },

                   success: function(returnedData) {

                       // set the bool
                       var teamBool = returnedData.trim();

                       //
                       $('html, body').animate({ scrollTop: 0 }, 200);

                       // show error notification.
                       notificationContainer.text(teamBool).addClass('greenConfirm').show();

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
                   }//end complete
                })// end ajax()
            }// end if
        }// end click()
    })// end bind()
})// end jQuery
