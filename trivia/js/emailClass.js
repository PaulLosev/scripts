
    class emailClass {
        /**
         * parent class method
         */
        constructor() {
            // email input container
            this.popupInfoContainer = $('.infoContainer');
            // error container
            this.errorContainer = $('.errorCode');
            // error code not valid
            this.notValidEmailFormat = 'incorrect email format: <b>youname@emailprovider.zone</b>';
            // error code double entry
            this.doubleEntryValue = 'The email is in the system, please use another';
            // error code personal email
            this.personalEmailUsage = 'You\'ve used a personal email. You\'ll lose game points';
        }// end constructor()
        /**
         * main email validation method
         * @param data
         */
        getEmailInputData() {
            // test print
            let emailInput = $('#uemail');
            //
            emailInput.on({
                keyup: function() {
                    // validate email format
                    emailValid.validateEmailFormat(this.value);
                    emailValid.popupInfoContainer.html('console: ' + this.value);
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
            this.errorContainer.html('').hide();
            this.errorCall('valid, calling the double entry method');
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
        ajaxCall() {

        }// end ajaxCall()
    }// end emailClass{}
    // set the class instance
    let emailValid= new emailClass();
    // endregion
    emailValid.getEmailInputData();
