
    class emailClass {
        /**
         * parent class method
         */
        constructor() {
            // email input container
            this.emailInput = $('.infoContainer');
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
                }// end On()
            })// end on()
        }// end getEmailInputData()
        /**
         * method validates email format
         */
        validateEmailFormat(value) {
            console.log(value);
            // show error
            emailValid.emailInput.html('console log: ' + value);
        }// end validateEmailFormat()
        /**
         * method validates email value on doubentries
         * @param value
         */
        emailDoubleEntries(value) {

        }
        /**
         * methods validates email provider
         */
        validateEmailProvider(provider) {

        }// end validateEmailProvider()
    }// end emailClass{}
    // set the class instance
    let emailValid= new emailClass();
    // endregion
    emailValid.getEmailInputData();