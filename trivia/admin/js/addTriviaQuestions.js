    /**
     * class addTriviaQuestions
     */
    class addTriviaQuestions extends projectNavigation {
        // region class methods
        constructor() {
            super();
            // get parent trivia container
            this.triviaParent = $('.triviaQuestionContainer').find('.questionContainer');
            // form data
            this.data = [];
            // drop down return value
            this.dropReturn = '';
            // region system wording
            this.requiredInput = '*required field';
            // right answer popup wording
            this.popupError = 'Please set the right answer!';
            this.popupErrorEmpty = 'The answer cannot be empty!';
            // add group wording
            this.addGroupWording = 'Add Group';
            // plceholder wording
            this.containerPlaceholder = 'start typing..';
            // save button wording
            this.saveButtonWording = 'add group';
            // save path
            this.saveQuestionsData = '/trivia/admin/ajaxCall/saveQuestionsData.php';
            // add group path
            this.addGroupPath = '/trivia/admin/ajaxCall/addGroup.php';
            // save group path
            this.saveThisGroup = '/trivia/admin/ajaxCall/saveThisGroup.php';
        }// end constructor()
        //
        questionMode() {
            // set module functionality
            this.setModuleData();
            // endregion
            // set validation
            // region set data for validation
            this.validate();
            // endregion
        }// end questionMode()
        // method sets data + methods to populate the module
        // action method goes upper level before any buttons clicked
        setModuleData() {
            // set module data
            this.triviaParent.each((num, object) => {
                // get question body data
                let questionContainer= $(object);
                // get questio id
                let qid = questionContainer.attr('qid');
                // get question body container
                let questionBody = questionContainer.find('.questionBody');
                // get all Right answer containers
                let AllRightAnswers = questionContainer.find('.winner');
                // get submit button
                let submit = questionContainer.find('.saveMethod button');
                // set actions
                questionBody.each((qnum, qInpupt) => {
                    // get question container data
                    let that = $(qInpupt);
                    // get error code
                    let errorCode = that.find('.validationError');
                    // get Right Answer trigger
                    let rightAnswer = that.find('.winner');
                    // get select container
                    let groupSelector = that.find('select');
                    // get error popup
                    let errorPopup = $(object).find('.errorPopup');
                    // set actions
                    rightAnswer.on({
                        click: function() {
                            // get answer value
                            let value = that.find('input[type=text]').val();
                            // remove atcive class
                            AllRightAnswers.removeClass('topWinner');
                            // transmit value to the parent
                            questionContainer.attr('winner', value);
                            // set a set of actions
                            $(this).addClass('topWinner');
                            submit.show('drop', 'fast', () => {
                                errorPopup.hide('drop', {direction: 'right'}, 'fast');
                            })// end show()
                            // end region set a set of actions
                        }// end click()
                    })// end on()
                })// end each()
            })// end each()
        }// setModuleData()
        // validate inputs
        validate() {
            // validate module
            this.triviaParent.each((num, object) => {
                // get save button
                let saveButton = $(object).find('.saveMethod button');
                // get total of al inputs
                let totalOfall = $(object).children('.questionBody').length;
                // set actions
                saveButton.on({
                    click: function () {
                        moduleBuild.validateInput(object);
                        // if all asnwers are validated + the right answer is picked up
                        let savedItem = moduleBuild.validateRightAnswers(object) !== false
                            ? moduleBuild.presaveMethod(moduleBuild.data, totalOfall, moduleBuild.saveQuestionsData)
                            : ''

                        // track console statuses
                        // console.log(savedItem);

                        // set acions
                        if (savedItem !== undefined && savedItem.trim() === 'true') {
                            // call default navigation to update the questions tree in the navigation
                            moduleBuild.buildDefaultNavigation('questions');
                            // call default dash container to refresh the page + header wording
                            // get the question container data
                            let dataSet = new FormData();
                            dataSet.append('category', 'questions');
                            // returned
                            let returnedData = buildNavigation.ajaxCall(dataSet, buildNavigation.containerBuilder);
                            // call defaul retunr conatiner
                            buildNavigation.buildContainer('questions', returnedData);
                            // show confirmation
                            moduleBuild.actionConfirm('saved');
                        }// end if
                    }// end click()
                })// end On()
            })// end each()
        }// end validate()
        /**
         * method validates input on emptyness
         * @param input
         */
        validateInput(dataSet) {
            // flush arrays data after eahc submit
            this.data = [];
            // get all inputs + select
            let input = $(dataSet).find('input, select');
            // get group category id
            let gid = input.find(':selected').attr('gid');
            // set logic + actions
            $(input).each((num, object) => {
                // get error container
                let error = $(object).parent().find('.errorCode');
                // get id
                let qid = $(object).parent().parent().attr('qid');
                // get right answer
                let rightAnswer = $(object).parent().parent().attr('winner');
                // get value
                let value = $(object).val();
                // return validation
                value.trim() === ''
                    ? error.html(moduleBuild.requiredInput).show()
                    : moduleBuild.pushValue(value, qid, rightAnswer, error, gid);
            });
        }// end validateInput()
        // method validates right answer buttons
        validateRightAnswers(object) {
            // get right answer value from the parent container
            let value = $(object).attr('winner');
            // get right answer container
            let container = $(object).find('.winner');
            // get error popup
            let errorPopup = $(object).find('.errorPopup');
            // get submit button
            let submit = $(object).find('.saveMethod button');
            // set notifications
            if (value === undefined) {
                // remove active class + attribute
                container.removeClass('topWinner');
                $(object).removeAttr('winner');
                // return false by all means
                errorPopup.text(this.popupError).show('drop', {direction: 'right'}, 'fast');
                submit.hide('fold', 'fast');
                // return error code
                return false;
            } else if (value === '') {
                // remove active class + attribute
                $(object).removeAttr('winner');
                container.removeClass('topWinner');
                // return false by all means
                errorPopup.text(this.popupErrorEmpty).show('drop', {direction: 'right'}, 'fast');
                submit.hide('fold', 'fast');
                // return error code
                return false;
            }// end if()
        }// end validateRightAnswers()
        /**
         * method pushes values to the parent array
         * @param value
         * @param error
         */
        pushValue(value, qid, rightAnswer, error, gid) {
            // hide error
            $(error).html('').hide();
            // push value
            this.data.push({value: value, qid: qid, winner: rightAnswer, gid: gid});
        }// end pushValue()
        /**
         * presave method validates all inputs returned validated
         * @param data
         */
        presaveMethod(data, total, path) {
            // count total of all inputs on the form
            // set action
            return total === data.length
               ? this.saveMethod(data, path)
               : console.log('%c *required fields', 'color: pink');
        }// end presaveMethod()
        /**
         * method builds dat array + saves user data
         * @param data
         * @param type
         */
        saveMethod(data, path) {
            // set form data class
            let dataSet = new FormData();
            // set data
            dataSet.append('data', JSON.stringify(data));
            // call PHP save method
            return this.ajaxCall(dataSet, path);
        }// end saveMethod()
        // method calls backend for data by eid
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
    }// end modules
    // set the class instance
    let moduleBuild = new addTriviaQuestions();
    // build module
    moduleBuild.questionMode();
