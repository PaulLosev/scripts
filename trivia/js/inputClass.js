
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
            this.sumitButton = this.parentContainer.find('#uprefSubmit');
        }// end constructor()
        validateForm() {
            // set actions
            this.sumitButton.on({
                click: function() {
                    console.log(formValidate.parentContainer);
                }
            })// end On()
        }// end validateForm()
        // endregion
    }// end validateInput{}
    // set the class instance
    let formValidate= new validateInput();
    // endregion
    formValidate.validateForm();
