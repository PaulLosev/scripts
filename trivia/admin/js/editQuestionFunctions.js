    /**
     * class editQuestionFunctions
     */
    class editQuestionFunctions extends projectNavigation {
        // region class methods
        questionFunctions() {
            // set add question method
            this.addQuestion();
            // set edit question method
            this.editQuestion();
            // set defult menu functions
            this.navigationFunctionality();
        }// end questionFunctions()
        // method calls for add new question method
        addQuestion() {
            // get add question trigger
            let addQuestion = this.navigationReturn.find('.addQuestionContainer');
            // set actions
            addQuestion.on({
                click: function() {
                    console.log('add call');
                    $(this).find('button').addClass('activeAddButton');
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
                        console.log('edit call');
                        // set item highlights
                        questionWork.navigationReturn.find('.addQuestionContainer button').removeClass('activeAddButton');
                        allQuestions.find('li').removeClass('navigationActive')
                        trigger.addClass('navigationActive');
                        // set method namr
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
                        console.log(qid);
                    }// end click()
                })// end On()
            })// end each()
        }// end editQuestion()
        // endregion
    }// end editQuestionFunctions{}
    // set the class instance
    let questionWork = new editQuestionFunctions();
    // call question work
    questionWork.questionFunctions()
