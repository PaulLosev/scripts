
/**
 * Method validates square by id and grid id
 * @param grid
 * @param square
 * @param dbconnect
 * @returns {*}
 */
export function validateSquare(grid, square, dbconnect) {

  // check square accessibility
  return $.ajax({

    // send data to validte
    url: '/phpScripts/checkSquareInternal.php' + dbconnect,
    type: 'post',
    async: false,
    data: {
        grid: grid,
        square: square,
    }
  }).responseText;
}// end validateSquare()

/**
 * Method validates email id on double entry
 * @param email
 * @param dbconnect
 * @returns {*}
 */
export function validateEmail(email, dbconnect) {

    // return validated email value with bool
    return $.ajax({

        //
        url: '/phpScripts/userCheckBeforeDeletion.php' + dbconnect,
        type: 'post',
        async: false,
        data: {user: email}
    }).responseText;
}// end validateEmail()

/**
 * Method validates form inputs
 * @param approveArray
 * @param regModData
 * @param actualValidationConfirmation
 * @returns {*}
 */
export function validateInputs(approveArray, regModData, actualValidationConfirmation, formLenght) {

    // the total of all inputs on teh form.
    console.log('%cTotal inputs on the form:', 'color: white; font-size: .7vw');
    console.log('%c' + formLenght + '', 'color: red; font-size: 1vw');

    // validate values
    regModData.each(function () {

        // set each value in the loop.
        var eachValue = $(this).val();

        // set the hidden attr.
        var hiddenInput = $(this).attr('type');

        // set an individual container.
        var individualContainer = $(this);

        // if no values came from the form.
        if (eachValue === '') {

            // show all required fields notification.
            actualValidationConfirmation.show();

            // if hidden input
            if (hiddenInput === 'hidden') {

                // hide confirmation
                actualValidationConfirmation.hide();
            }// end if

            // set the error border.
            individualContainer.css({border: '1px solid #cc0000'});

            // after the successful validation.
        } else {

            // set the border to inherit.
            individualContainer.css({border: '1px solid rgba(0,0,0,.1)'});

            // push the values to the array.
            approveArray.push(eachValue);
        }// endif
    });

    // Remove item 'out' from array
    // return data
    return approveArray.filter(function(e) {

        // delete 'out' value
        return e !== 'out'
    });
}// end validateInputs()

/**
 * Method saves new user, moves data to Zapier
 * @param approveArray
 * @param formLenght
 * @param dbconnect
 * @param actualValidationConfirmation
 * @param regModule
 * @param cofirmModule
 * @param systemSpiner
 */
export function saveUser(approveArray, formLenght, grid, square, dbconnect, actualValidationConfirmation, systemSpiner) {

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
        $(actualValidationConfirmation).hide();

        //
        $.ajax({
            url: '/phpScripts/regMod.php' + dbconnect,
            type: 'post',
            data: {
                firstName: approveArray[0],
                lastName: approveArray[1],
                userPosition: approveArray[3],
                userCompany: approveArray[4],
                userEmail: approveArray[5],
                userRep: approveArray[6],
                grid: grid,
                square: square,
                state: approveArray[2],
            },

            //
            success: function (url) {

                // track the data.
                console.log(url);

                // send data over to the Zapier
                $.ajax({
                    url: 'https://hooks.zapier.com/hooks/catch/10594582/bhj6sg2/',
                    type: 'post',
                    data: {
                        firstName: approveArray[0],
                        lastName: approveArray[1],
                        userPosition: approveArray[3],
                        userCompany: approveArray[4],
                        userEmail: approveArray[5],
                        userRep: approveArray[6],
                        state: approveArray[2],
                        gameID: 'Game_SuperSquares_2023',
                    }// end data{}
                })// end Ajax()
            },

            //
            beforeSend: function () {

                // show the spinner.
                systemSpiner.show();
            }// end complete()
        })// end ajax()
    }// end saveUser()
}// end saveUser()
