
/**
 * class submit form data
 *
 * to validate a form next values should be send to the class
 * 1. main form container
 * 2. input class to set values
 */
class submitFormData {

    // region class methods
    constructor() {

        // region class const
        // set save data file path
        this.path = '/march-madness/ajaxCall/saveData.php';

        // set save edited data
        this.saveEditedData = '/march-madness/ajaxCall/saveEditedData.php';

        // set populate emails file path
        this.emailPath = '/march-madness/ajaxCall/populateEmails.php';

        // set form container
        this.formContainer = $('#safeContainer');

        // set animation container
        this.animationContainer = $('.gameAnimation');

        // set html container with body
        this.htmlBodyContainer = $('html, body');
        // endregion
    }// end constructor()

    // validate form items
    validate(data, cat) {

        // set form container
        var formContainer = $(data);

        // set children
        var inputs = formContainer.children().find('#gameInput');

        // set input lenght
        var inputLenght = 0;

        // set array for values
        let validated = [];

        // validate
        inputs.each(function() {

            // set error container
            var errorContainer = $(this).parent().find('.valError');

            // set required inputs
            var required = $(this).attr('required');

            // set input name
            var inputName = $(this).attr('name');

            // set value
            var value = $(this).val();

            // set validation on required fields
            if (required !== undefined) {
                // validate each item
                if (value === '') {
                    // show error
                    errorContainer.text('required field').show();
                    //
                    inputLenght++;
                } else {
                    // push true if item valid
                    validated.push({inputName, value});
                    // show error
                    errorContainer.hide();
                }// end if
            } else {
                // push true if item valid
                validated.push({inputName, value});
            }// end if
        })// end each()
        // return true if form valid
        if (inputLenght === 0) {

            // separate save edited
            if (cat === 'admin') {

                this.saveData(validated, 'admin');
                // from new entity
            } else {
                // set animation save data set team names
                this.setAnimation(this.saveData(validated));
            }// end if()
        }// end if
    }// end validate()
    // call animation method
    callOdoo(teamOne, teamTwo) {

        // return animation
        var animationCND = odoo.default({el: ".js-odoo", from: "", to: teamOne.toUpperCase(), animationDelay: 300});
        var animationBCH = odoo.default({el: ".js-odoo2", from: "", to: teamTwo.toUpperCase(), animationDelay: 1000});

        // return team names
        return {
            animationCND, animationBCH
        }// end send out
    }// end callOdoo()
    // set animation
    setAnimation(data) {
        // parse json
        data = JSON.parse(data);
        // hide form section of the game
        this.formContainer.hide();
        // set body to fixed sizes
        this.htmlBodyContainer.addClass('sudoBody');
        // call animation with returned team names
        this.animationContainer.append(this.callOdoo(data['teamOne'], data['teamTwo']));
        // set all letter
        var letters = $('.gameAnimation').find('text');
        // find Y
        letters.each(function() {

            // set attribute
            $(this).text() === 'y' ? $(this).hide() : '';
        })// end each()
        // show animation
        this.animationContainer.show();
    }// end setAnimation()
    // save user data
    saveData(data, cat) {
        // separate save new from save edited
        var pathToSave = cat === 'admin' ? this.saveEditedData : this.path;
        // set ajax
        return $.ajax({
            url: pathToSave,
            type: 'post',
            async: false,
            data: {data},
            success: function(ret) {
                // if admin returns 'updated'
                if (ret.trim() === 'updated') {
                    // show confirm after user update
                    $('#confirmSaved').dialog({
                        buttons: {
                            // set delete item confirm
                            'Ok': function () {
                                // relaod location
                                location.reload();
                            }// end Ok option
                        }// end buttons{}
                    })// end dialog()
                }// end if
            }}).responseText;
    }// end saveUserData()
    // validate email on double entrie
    validateDouble(string, data) {
        // email format formula
        let mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        // set error container
        var errorContainer = $(data).parent().find('.valError');
        // set submit buttom
        var submitButton = $(data).parent().parent().parent().find('.submitForm');
        // set email formta validation
        if (string.match(mailFormat)) {
            // show error
            errorContainer.hide();
            // get email value
            let email = $.ajax({url: this.emailPath, type: 'post', async: false, data: {value: string}}).responseText;
            // validate double entries
            if (email.trim() === 'false') {
                // show error
                errorContainer.hide();
                // stop script
                submitButton.css({visibility: 'visible'});
            } else {
                // show error
                errorContainer.show().html('This email is registered');
                // stop script
                submitButton.css({visibility: 'hidden'});
            }// end if
        } else {
            // show error
            errorContainer.html('incorrect email format').show();
            // stop script
            submitButton.css({visibility: 'hidden'});
        }// ned if{}
    }// end validateDouble()
    // endregion
}// end submitFormData{}
