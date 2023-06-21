
/**
 * Method sets the UI for the quarter winner method.
 */
jQuery(function($) {

    // set quarter winner modal body.
    var quarterWinner = $(".setQuarter");

    // set the upload input for the values.
    var leftSide = $("input[name=leftSideNumber]");
    var rightSide = $("input[name=rightSideNumber]");

    // set the left value container.
    var leftValueContainer = $(".theLeftGridLineContaner");
    var rightValueContainer = $(".theRightGridLineContaner");

    // set the value containers.
    var leftValue = leftValueContainer.children(".leftLineGrid");
    var rightValue = rightValueContainer.children(".rightLineGrid");

    // set the system spinner.
    var systemSpinner = $(".actualSystemSpinner");

    // set the complete notification container.
    var notificationContainer = $(".notificationBody");

    // set the left value.
    leftValue.on({

        //
        click: function() {

            // set the actual value and sned it to the prep container.
            var value = $(this).attr("data-picked-id-left");

            // set the value to the left checked container.
            leftSide.val(value);
        }// end click()
    })// end on()

    // set the left value.
    rightValue.on({

        //
        click: function() {

            // set the actual value and sned it to the prep container.
            var value = $(this).attr("data-picked-id-left");

            // set the value to the left checked container.
            rightSide.val(value);
        }// end click()
    })// end on()

    // set the submit button.
    var saveQuarterWinner = $(".submitQuarterWinnerData");

    // set the validation error container.
    var valContainerQuater = $(".actualErrorQuaers");

    //
    saveQuarterWinner.on({

        //
        click: function() {

            // set the values.
            var containerId = $("input[name=actualContainerId]").val();
            var leftValue = $("input[name=leftSideNumber]").val();
            var rightValue = $("input[name=rightSideNumber]").val();

            // hide the validation error each time.
            valContainerQuater.fadeOut(100);

            // track some data.
            console.log("id " + containerId + " left " + leftValue + " right " + rightValue);

            // some validation.
            if (leftValue === "" || rightValue === "") {

                // show the error.
                valContainerQuater.fadeIn(100);

            // if the scenario has no validation errors.
            } else {

                // set db variator
                var dbconnect = $(this).attr('dbconnect');

                //
                $.ajax({
                    url: '/phpScripts/saveQuarterWinner.php' + dbconnect,
                    type: "post",
                    data: {
                        container: containerId,
                        leftValue: leftValue,
                        rightValue: rightValue,
                    },

                    success: function(dataTrack) {
                        console.log(dataTrack);

                        // set the notification body.
                        notificationContainer.delay(1500)
                            .text("SAVED")
                            .addClass("greenConfirm")
                            .show();
                    },

                    beforeSend: function () {

                        // show the spinner.
                        systemSpinner.fadeIn(100);
                    },

                    complete: function() {

                        // hide the module.
                        quarterWinner.fadeOut(100);

                        // hide nitification.
                        notificationContainer.fadeOut(100);

                        // hide the systme spinner.
                        systemSpinner.fadeOut(100);

                        //
                        setTimeout(function() {
                            //
                            location.reload();
                        }, 300)// end setTimeout()
                    }// end ompelete()
                })// end ajax()
            }// end if
        }// end click()
    })// end on()
    /* set quarter winner method */
})// end function()
