
    class validateInput {
        // region class const
        // enregion
        // region class methods
        /**
         * parent class method constructor
         */
        constructor() {
            // main form container
            this.parentContainer = $('.gameFormContainer').children('.inputContainer');
            // set all inputs on the form
            this.submitButton = this.parentContainer.find('#uprefSubmit');
            // set data array
            this.data = [];
            // system data
            this.systemPersonalEmailUsage = '';
            // region system wording
            this.requiredInput = '*required field';
        }// end constructor()
        validateForm() {
            // set actions
            this.submitButton.on({
                click: function() {
                    formValidate.validateInput(formValidate.parentContainer);
                    formValidate.presaveMethod(formValidate.data);
                }// end click()
            })// end On()
        }// end validateForm()
        /**
         * method validates input on emptyness
         * @param input
         */
        validateInput(input) {
            // flush arrays data after eahc submit
            this.data = [];
            this.systemPersonalEmailUsage = '';
            // set logic + actions
            $(input).each(function() {
                // get error container
                let error = $(this).find('.errorCode');
                // set data
                let value = $(this).find('input').val();
                // get prsonal email usage token
                let personal = $(this).attr('ptminus');
                // get personal email usage flag
                personal === 'true'
                    ? formValidate.systemPersonalEmailUsage = 'personal'
                    : false;
                // return validation
                value === ''
                    ? error.html(formValidate.requiredInput).show()
                    : formValidate.pushValue(value, error);

            })// end each()
        }// end validateInput()
        /**
         * method pushes values to the parent array
         * @param value
         * @param error
         */
        pushValue(value, error) {
            // hide error
            $(error).html('').hide();
            // push value
            this.data.push(value);
        }// end pushValue()
        /**
         * presave method validates all inputs returned validated
         * @param data
         */
        presaveMethod(data) {
            // count total of all inputs on the form
            let totalInputs = this.parentContainer.length;
            // count current values in the array
            let arrayCount = data.length;
            // set action
            totalInputs === arrayCount
                ? console.log('call save method: ' + data + ', email type: ' + formValidate.systemPersonalEmailUsage)
                : console.log('*required fileds');
        }// end presaveMethod()
        // endregion
    }// end validateInput{}
    // set the class instance
    let formValidate= new validateInput();
    // endregion
    formValidate.validateForm();
