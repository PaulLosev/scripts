    /**
     * class functionality
     * any type of visual & additional logic methods
     */
    class functionality {
        // region class const
        // endregion
        // region class methods
        /**
         * parent class method constructor
         */
        constructor() {
            // main form container
            this.parentContainer = $('.gameFormContainer').children('.inputContainer');
            // set all inputs on the form
            this.submitButton = this.parentContainer.find('input[type=submit]');
            // set data array
            this.data = [];
            // system data
            this.systemPersonalEmailUsage = '';
            // region system wording
            this.requiredInput = '*required field';
            // region script paths
            this.saveUserData = '/trivia/phpScripts/saveUserData.php';
            // endregion
        }// end constructor()

        test(string) {
            console.log(string);
        }
        // endregion
    }// end functionality{}
