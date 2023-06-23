
    class emailClass {
        /**
         * parent class method
         */
        constructor() {
            // email input container
            this.popupInfoContainer = $('.infoContainer');
            // error container
            this.errorContainer = $('.errorCode');
            // region method warnings
            // error code not valid
            this.notValidEmailFormat = 'incorrect email format: <b>younrame@emailprovider.zone</b>';
            // error code double entry
            this.doubleEntryValue = 'The email is in the system, please use another';
            // error code personal email
            this.personalEmailUsage = 'You\'ve used a personal email. You\'ll lose game points';
            // endregion
            // region scrip paths
            this.doubleEntry = '/trivia/phpScripts/emailEntrieCheck.php';
            // endregion
        }// end constructor()
        /**
         * main email validation method
         */
        getEmailInputData() {
            // test print
            let emailInput = $('#uemail');
            //
            emailInput.on({
                keyup: function() {
                    // validate email format
                    emailValid.validateEmailFormat(this.value);
                    emailValid.popupInfoContainer.html('console: ' + this.value).show('drop', {direction: 'right'}, 'fast');
                }// end On()
            })// end on()
        }// end getEmailInputData()
        /**
         * method validates email format
         */
        validateEmailFormat(value) {
            // email format formula
            let mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            // validate email value
            value.match(mailFormat)
                ? this.emailDoubleEntries(value)
                : this.errorCall(this.notValidEmailFormat);
        }// end validateEmailFormat()
        /**
         * method validates email value on doubentries
         * @param value
         */
        emailDoubleEntries(value) {
            // hide email format error
            this.errorCall('valid, calling the double entry method' + value);
            console.log(this.ajaxCall(value, this.doubleEntry));
        }// end emailDoubleEntries()
        /**
         * methods validates email provider
         */
        validateEmailProvider(provider) {

        }// end validateEmailProvider()
        /**
         * method calls for error
         */
        errorCall(error) {
            //
            this.errorContainer.html(error).show();
        }// end error
        /**
         * method calls backend for data by eid
         */
        ajaxCall(value, path) {
            return $.ajax({url: path, type: 'post', async: false, data: {value: value}}).responseText;
        }// end ajaxCall()
    }// end emailClass{}
    // set the class instance
    let emailValid= new emailClass();
    // endregion
    emailValid.getEmailInputData();
