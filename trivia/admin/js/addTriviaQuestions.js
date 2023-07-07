    /**
     * class addTriviaQuestions
     */
    class addTriviaQuestions {
        // region class methods
        constructor() {
            // get parent trivia container
            this.triviaParent = $('.triviaQuestionContainer').find('.questionContainer');
            // form data
            this.data = [];
            // drop down return value
            this.dropReturn = '';
            // region system wording
            this.requiredInput = '*required field';
            // right answer popup wording
            this.popupError = 'Please set the right answer';
            // add group wording
            this.addGroupWording = 'Add Group';
            // plceholder wording
            this.containerPlaceholder = 'start typing..';
            // save button wording
            this.saveButtonWording = 'add group';
            // save path
            this.saveQuestionsData = '/trivia/admin/ajaxCall/saveQuestionsData.php';
            // add group path
            this.addGroupPath = '/trivia/admin/ajaxCall/addGroup.php'
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
                    // set action for select container
                    groupSelector.on({
                        change: function() {
                            // get Add Group value
                            // get add group attr
                            let addGroup = $(this).find(':selected').attr('point');
                            // set add new group  method
                            addGroup === 'true'
                                ? moduleBuild.addGroup(object)
                                : ''
                        }// end change()
                    })// end On()
                })// end each()
            })// end each()
        }// setModuleData()
        // set add group functionality
        addGroup(object) {
            // build add group container
            this.addGroupBuilder(object);
            // get popup container
            let popup = $(object).find('.questionBodyaddGroup');
            // get close button
            let close = popup.find('.closePopupContainer span');
            // save new group
            this.saveGroup(popup);
            // set action to close the popup
            close.on({
                click: function() {
                    // close popup
                    popup.hide('fade', {direction: 'top'}, 'fast');
                }// end click()s
            })// end On()
        }// end addGroup()
        // save group
        saveGroup(object) {
            // get submit button
            let submit = $(object).find('.save');
            // get error container
            let error = $(object).find('.errorCode');
            // validate
            submit.on({
                click: function() {
                    // get input
                    let input = $(object).find('input[type=text]');
                    // return validation
                    moduleBuild.validateInput(object);
                    moduleBuild.presaveMethod(moduleBuild.data, 1, moduleBuild.addGroupPath);
                }// end click()
            })// end On()
        }// end saveGroup()
        // build add group container
        addGroupBuilder(object) {
            // build add group container
            // get parent container
            let parent = $(object);
            // parent ct
            let parentGroupContainer = document.createElement('div');
            parentGroupContainer.className = 'questionBodyaddGroup';
            // close button container
            let close = document.createElement('div');
            close.className = 'closePopupContainer';
            // popup close button
            let closeButton = document.createElement('span');
            let closeButtonWording = document.createTextNode('X');
            closeButton.append(closeButtonWording);
            // build close button
            close.append(closeButton);
            // cover up container
            let coverUp = document.createElement('div');
            coverUp.className = 'coverUp';
            // label + wording
            let lable = document.createElement('label');
            let lableWording = document.createTextNode(this.addGroupWording);
            lable.append(lableWording);
            // error container
            let error = document.createElement('span');
            error.className = 'errorCode';
            // input
            let inputCT = document.createElement('input');
            inputCT.type = 'text';
            inputCT.name = 'newGroup';
            inputCT.placeholder = this.containerPlaceholder;
            // button container
            let button = document.createElement('div');
            button.className = 'winner';
            // button
            let saveButton = document.createElement('button');
            saveButton.className = 'save';
            // button wording
            let buttonBody = document.createTextNode(this.saveButtonWording);
            saveButton.append(buttonBody);
            // build button
            button.append(saveButton);
            // cover up
            coverUp.append(lable, error, inputCT, button);
            // add to the container
            parentGroupContainer.append(close, coverUp);
            // add to the parent container
            return parent.append(parentGroupContainer);
        }// end addGroupBuilder()
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
                        moduleBuild.presaveMethod(moduleBuild.data, totalOfall, moduleBuild.saveQuestionsData);
                        moduleBuild.validateRightAnswers(object);
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
                    : moduleBuild.pushValue(value, qid, rightAnswer, error);
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
                errorPopup.text(this.popupError).show('drop', {direction: 'right'}, 'fast');
                submit.hide('fold', 'fast');
            }// end if()
        }// end validateRightAnswers()
        /**
         * method pushes values to the parent array
         * @param value
         * @param error
         */
        pushValue(value, qid, rightAnswer, error) {
            // hide error
            $(error).html('').hide();
            // push value
            this.data.push({value: value, qid: qid, winner: rightAnswer});
        }// end pushValue()
        /**
         * presave method validates all inputs returned validated
         * @param data
         */
        presaveMethod(data, total, path) {
            // count total of all inputs on the form
            // set action
            total === data.length
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
            // TODO: kill the log after all set and tested
            console.log(this.ajaxCall(dataSet, path));
        }// end saveMethod()
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
        // end region
    }// end modules
    // set the class instance
    let moduleBuild = new addTriviaQuestions();
    // build module
    moduleBuild.questionMode();
