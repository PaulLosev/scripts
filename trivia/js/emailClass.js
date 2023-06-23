
    class emailClass {
        /**
         * parent class method
         */
        constructor() {
            // email input container
            this.popupInfoContainer = $('.infoContainer');
            // error container
            this.errorContainer = $('.errorCode');
            // email form validation formula
            this.RegExpression = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            // region method warnings
            // error code not valid
            this.notValidEmailFormat = 'incorrect email format: <b>younrame@emailprovider.zone</b>';
            // error code double entry
            this.doubleEntryValue = 'The email is in the system, please use another';
            // error code personal email
            this.personalEmailUsage = 'You\'ve used a personal email. You\'ll lose game points';
            // endregion
            // region scrip paths
            this.emailCheck = '/trivia/phpScripts/emailEntrieCheck.php';
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
            // validate email value
            value.match(this.RegExpression)
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
            // set FormData class instance
            let mathodData= new FormData();
            // set values to the data array
            mathodData.append('method', 'doubleEntry');
            mathodData.append('email', value);
            // set methods
            //this.ajaxCall(mathodData, this.emailCheck).trim() === 'true'
            //    ? console.log('email provider method')
            //    : this.errorCall(this.doubleEntryValue);
            console.log(this.ajaxCall(mathodData, this.emailCheck));
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
