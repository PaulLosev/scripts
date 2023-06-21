
    class emailClass {
        /**
         * parent class method
         */
        constructor() {
        }// end constructor()
        /**
         * main email validation method
         * @param data
         */
        getEmailInputData(value) {
            // test print
            jQuery('.infoContainer').html('console log: ' + value);
        }// end getEmailInputData()
        /**
         * method validates email format
         */
        validateEmailFormat(value) {

        }// end validateEmailFormat()
        /**
         * methods validates email provider
         */
        validateEmailProvider(provider) {

        }// end validateEmailProvider()
        /**
         * method validates email value on doubentries
         * @param value
         */
        emailDoubleEntries(value) {

        }
    }// end emailClass{}
    // set the class instance
    let emailValid= new emailClass();
    // endregion
