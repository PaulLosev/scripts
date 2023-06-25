
    class emailClass {
        /**
         * parent class method
         */
        constructor() {
            // set mail input container
            this.parentContainer = $('.inputContainer');
            // email input container
            this.popupInfoContainer = this.parentContainer.find('.infoContainer');
            // error container
            this.errorContainer = this.parentContainer.find('.errorCode');
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
         * method splits email address and return the email provider
         */
        findEmailProviderName(value) {
            // split email
            return value.split('@')[1].split('.')[0];
        }// end findEmailProviderName()
        /**
         * main email validation method
         */
        getEmailInputData() {
            // test print
            let emailInput = $('#uemail');
            // start email validation logic
            emailInput.on({
                // validate email
                keyup: function() {
                    // clean up popups
                    this.value === ''
                        ? emailValid.popupInfoContainer.hide('drop', {direction: 'right'}, 'fast')
                        : false;
                    // validate
                    emailValid.validateEmailFormat(this.value);
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
         * method validates email value on double entries
         * @param value
         */
        emailDoubleEntries(value) {
            this.errorCall(' ')
            // set FormData class instance
            let methodData= new FormData();
            // set values to the data array
            methodData.append('method', 'doubleEntry');
            methodData.append('email', value);
            // set methods
            if (this.ajaxCall(methodData, this.emailCheck).trim() === 'true') {
                this.errorCall(this.doubleEntryValue);
                console.log('hide save button');
            } else {
                this.validateEmailProvider(value);
            }// end if
        }// end emailDoubleEntries()
        /**
         * methods validates email provider
         */
        validateEmailProvider(value) {
            //
            if (this.emailProvider(this.findEmailProviderName(value)) !== undefined) {
                // add minus 3 points
                $(this.parentContainer).attr('ptminus', 'true');
                // show warning
                emailValid.popupInfoContainer.html(this.personalEmailUsage).show('drop', {direction: 'right'}, 'fast');
            } else {
                $(this.parentContainer).removeAttr('ptminus');
                // show warning
                emailValid.popupInfoContainer.hide('drop', {direction: 'right'}, 'fast');
            }// end if()
            // get email provider
        }// end validateEmailProvider()
        /**
         * method calls for error
         */
        errorCall(error) {
            // show error
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
