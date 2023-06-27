
    class emailClass {
        /**
         * parent class method
         */
        constructor() {
            // set mail input container
            this.parentContainer = $('#emailValidation');
            // set all inputs on the form
            this.submitButton = this.parentContainer.parent().find('#uprefSubmit');
            // email form validation formula
            this.RegExpression = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            // region method warnings
            // error code not valid
            this.notValidEmailFormat = 'incorrect email format: <b>younrame@emailprovider.zone</b>';
            // error code double entry
            this.doubleEntryValue = 'The email is in the system, please use another';
            // error code personal email
            this.personalEmailUsage = 'You\'ve used a personal email. You\'ll lose 3 game points';
            // endregion
            // region scrip paths
            this.emailCheck = '/trivia/phpScripts/emailEntrieCheck.php';
            // endregion
        }// end constructor()
        /**
         * method sets email providers
         */
        emailProvider(value) {
            // set array with providers
            let providersArr = [
                {id: 'gmail', ret: 'false'},
                {id: 'mail',  ret: 'false'},
                {id: 'yahoo', ret: 'false'},
            ];
            // find values
            let result = providersArr.find((name) => {
                return name.id === value;
            })// end find()
            // return value
            return result;
        }// end emailProvider()
        /**
         * method splits email address and returns the email provider (raw)
         */
        findEmailProviderName(value) {
            // split email
            return value.split('@')[1].split('.')[0];
        }// end findEmailProviderName()
        /**
         * main email validation method
         */
        getEmailInputData() {
            // start loop
            $(this.parentContainer).each(function() {
                // set prefix
                const prefix = 'upref';
                // set error and info popup
                let popupInfoContainer = $(this).find('.infoContainer');
                let errorPopup = $(this).find('.errorCode');
                // set trigger
                let emailInput = $(this).find('input#' + prefix + 'Email');
                // start email validation logic
                emailInput.on({
                    // validate email
                    keyup: function() {
                        // clean up popups
                        this.value === ''
                            ? popupInfoContainer.hide('drop', {direction: 'right'}, 'fast')
                            : false;
                        // validate
                        emailValid.validateEmailFormat(this.value, errorPopup, popupInfoContainer, this);
                    }// end On()
                })// end on()
            })// end each()
        }// end getEmailInputData()
        /**
         * method validates email format
         */
        validateEmailFormat(value, errorPopup, popupInfoContainer, that) {
            // email format formula
            // validate email value
            value.match(this.RegExpression)
                ? this.emailDoubleEntries(value, errorPopup, popupInfoContainer, that)
                : this.errorCall(this.notValidEmailFormat, errorPopup);
        }// end validateEmailFormat()
        /**
         * method validates email value on double entries
         * @param value
         */
        emailDoubleEntries(value, errorPopup, popupInfoContainer, that) {
            // clear errors
            this.errorCall(' ', errorPopup);
            // set FormData class instance
            let methodData= new FormData();
            // set values to the data array
            methodData.append('method', 'doubleEntry');
            methodData.append('email', value);
            // set methods for returning user
            if (this.ajaxCall(methodData, this.emailCheck).trim() === 'true') {
                // show warning
                this.errorCall(this.doubleEntryValue, errorPopup);
                // hide submit button
                // TODO:Write logic to hide the submit button in the form class
                // hide warning
                popupInfoContainer.hide('drop', {direction: 'right'}, 'fast');
            } else {
                // new user
                this.validateEmailProvider(value, popupInfoContainer, that);
                // show submit
                this.submitButton.show();
            }// end if
        }// end emailDoubleEntries()
        /**
         * methods validates email provider
         */
        validateEmailProvider(value, popupInfoContainer, that) {
            // valider email provider
            if (this.emailProvider(this.findEmailProviderName(value)) !== undefined) {
                // add minus 3 points
                $(that).parent().attr('ptminus', 'true');
                // show warning
                popupInfoContainer.html(this.personalEmailUsage).show('drop', {direction: 'right'}, 'fast');
            } else {
                $(that).parent().removeAttr('ptminus');
                // hide warning
                popupInfoContainer.hide('drop', {direction: 'right'}, 'fast');
            }// end if()
            // get email provider
        }// end validateEmailProvider()
        /**
         * method calls for error
         */
        errorCall(error, errorPopup) {
            // show error
            $(errorPopup).html(error).show();
            // hide submit
            this.submitButton.hide();
        }// end error
        /**
         * method calls backend for data by eid
         */
        ajaxCall(data, path) {
            // get data by array values
            return $.ajax({
                url: path,
                type: 'post',
                async: false,
                contentType: false,
                processData: false,
                data: data}).responseText;
        }// end ajaxCall()
    }// end emailClass{}
    // set the class instance
    let emailValid= new emailClass();
    // endregion
    emailValid.getEmailInputData();
