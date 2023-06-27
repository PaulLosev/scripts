
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
            // region script paths
            this.saveUserData = '/trivia/phpScripts/saveUserData.php';
            this.tirviaQuestionCheck = '/trivia/phpScripts/questionCheck.php';
            // endregion
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
                let value = $(this).find('input, select');
                // get prsonal email usage token
                let personal = $(this).attr('ptminus');
                // get personal email usage flag
                personal === 'true'
                    ? formValidate.systemPersonalEmailUsage = 'personal'
                    : false;
                // return validation
                value.val() === ''
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
            this.data.push({itemName: value.val(), category: value.attr('category'), id: $(value).attr('id')});
        }// end pushValue()
        /**
         * presave method validates all inputs returned validated
         * @param data
         */
        presaveMethod(data) {
            // console.log(this.parentContainer.length);
            // count total of all inputs on the form
            // set action
            this.parentContainer.length === data.length
                ? this.saveMethod(data, formValidate.systemPersonalEmailUsage)
                : console.log('%c *required fields', 'color: pink');
        }// end presaveMethod()
        /**
         * method builds dat array + saves user data
         * @param data
         * @param type
         */
        saveMethod(data, type) {
            // set form data class
            let dataSet = new FormData();
            // set data
            dataSet.append('user', JSON.stringify(this.filterData(data, 'user')));
            dataSet.append('answers', JSON.stringify(this.filterData(data, 'question')));
            // cast email type
            type !== ''
                ? dataSet.append('emailType', type)
                : '';
            // method
            dataSet.append('method', 'save');
            // call PHP save method
            // TODO: kill the log after all set and tested
            console.log(this.ajaxCall(dataSet, this.saveUserData));
        }// end saveMethod()
        /**
         * method filters out not needed sata
         * @param data
         * @param needle
         * @returns {*}
         */
        filterData(data, needle) {
            // return needed data set
            return data.filter((index, num) => {
                return index.category === needle;
            })// end filter()
        }// end filterData()
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
        // endregion
    }// end validateInput{}
    // set the class instance
    let formValidate= new validateInput();
    // endregion
    formValidate.validateForm();
