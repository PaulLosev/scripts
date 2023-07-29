    /**
     * class editQuestionFunctions
     */
    class editQuestionFunctions extends projectNavigation {
        // region class methods
        questionFunctions() {
            // return to the category dash
            this.returnToDash();
            // set add question method
            this.addQuestion();
            // set edit question method
            this.editQuestion();
            // set defult menu functions
            this.navigationFunctionality();
            // back button functionality
            this.backButtonFunctionality();
        }// end questionFunctions()
        // return to category dash
        returnToDash() {
            // get dash button
            let returnDashButton = this.navigationReturn.find('.seeDashFunction button');
            // set button as active
            returnDashButton.addClass('activeAddButton');
            // set actions
            returnDashButton.on({
                click: function() {
                    console.log('call dash of editQuestionFunctions line 27');
                    // disable active class from all li
                    let lee = questionWork.navigationReturn.find('li').removeClass('navigationActive');
                    // set button as active
                    returnDashButton.addClass('activeAddButton');
                    // remove active class from add question button
                    // get add question trigger
                    let addQuestion = questionWork.navigationReturn.find('.addQuestionContainer button');
                    addQuestion.removeClass('activeAddButton');
                    // get category from the parent
                    let category = returnDashButton.parent().attr('category');
                    // get the question container data
                    let dataSet = new FormData();
                    dataSet.append('category', category);
                    // returned
                    let returnedData = questionWork.ajaxCall(dataSet, questionWork.containerBuilder);
                    // call defaul retunr conatiner
                    questionWork.buildContainer(category, returnedData);
                }// end click()
            })// end On()
        }// end returnToDash()
        // method calls for add new question method
        addQuestion() {
            // get add question trigger
            let addQuestion = this.navigationReturn.find('.addQuestionContainer button');
            // set actions
            addQuestion.on({
                click: function() {
                    console.log('addQuestion of editQuestionFunctions line 55');
                    // disable active class from all li
                    let lee = questionWork.navigationReturn.find('li').removeClass('navigationActive');
                    // set current button as active
                    $(this).addClass('activeAddButton');
                    // remove active class from dash button
                    // get dash button
                    let returnDashButton = questionWork.navigationReturn.find('.seeDashFunction button');
                    // set button as active
                    returnDashButton.removeClass('activeAddButton');
                    // set method namr
                    let category = new FormData();
                    // add method
                    category.append('qid', '');
                    // get add question module
                    let module = questionWork.ajaxCall(category, questionWork.addQuestionPath);
                    // return add question module
                    questionWork.buildContainer(addQuestion.text().trim(), module);
                }// end click()
            })// end On()
        }// end addQuestion()
        // methods calls for edit question method
        editQuestion() {
            console.log('editQuestion of editQuestionFunctions line 78');
            // get all questions
            let allQuestions = this.navigationReturn.find('.questionBodyContainer');
            // set actions
            allQuestions.each((num, object) => {
                // get qid
                let qid = $(object).attr('qid');
                // get edit method trigger
                let trigger = $(object).find('li');
                // find delete button
                let deleteButton = $(object).find('#deleteQuestion input');
                // call edit question method
                trigger.on({
                    click: function() {
                        console.log('edit call of editQuestionFunctions line 92');
                        // get dash button
                        let returnDashButton = questionWork.navigationReturn.find('.seeDashFunction button');
                        // set button as active
                        returnDashButton.removeClass('activeAddButton');
                        // set item highlights
                        questionWork.navigationReturn.find('.addQuestionContainer button').removeClass('activeAddButton');
                        allQuestions.find('li').removeClass('navigationActive')
                        trigger.addClass('navigationActive');
                        let category = new FormData();
                        // add method
                        category.append('qid', qid);
                        // get add question module
                        let module = questionWork.ajaxCall(category, questionWork.addQuestionPath);
                        // return add question module
                        questionWork.buildContainer(questionWork.editQuestionWording, module);
                    }// end click()
                })// end On()
                // call delete method
                deleteButton.on({
                    click: function() {
                        // set confirm
                        if (confirm(questionWork.deleteItemWording) === true) {
                            // set data (qid)
                            let category = new FormData();
                            // add method
                            category.append('qid', qid);
                            let confirmValue = questionWork.ajaxCall(category, questionWork.deleteTriviaQuestion);

                            // track data from the backend
                            // console.log(confirmValue);

                            // set acions
                            if (confirmValue.trim() === 'true') {
                                // call default navigation to update the questions tree in the navigation
                                questionWork.buildDefaultNavigation('questions');
                                // call default dash container to refresh the page + header wording
                                // get the question container data
                                let dataSet = new FormData();
                                dataSet.append('category', 'questions');
                                // returned
                                let returnedData = questionWork.ajaxCall(dataSet, questionWork.containerBuilder);
                                // call defaul retunr conatiner
                                questionWork.buildContainer('questions', returnedData);
                                // show confirmation
                                questionWork.actionConfirm('deleted');
                            }// end if
                        }// end confirm()
                    }// end click()
                })// end On()
            })// end each()
        }// end editQuestion()
        // back button on the questions tab functionality
        backButtonFunctionality() {
            // get the back button
            let back = $(questionWork.navigationReturn).find('#backButton');
            // call default navigation
            back.on({
                click: function() {
                    // call default navigation
                    questionWork.buildNavModule();
                }// end click()
            })// end on
        }// end backButtonFunctionality()
        // endregion
    }// end editQuestionFunctions{}
    // set the class instance
    let questionWork = new editQuestionFunctions();
    // call question work
    questionWork.questionFunctions()
