
    class modules {
        // region class methods
        constructor() {
            // get parent trivia container
            this.triviaParent = $('.triviaQuestionContainer').find('.questionContainer');
        }

        questionMode() {
            // set actions
            this.triviaParent.each((num, object) => {
                // get question body data
                let questionContainer= $(object);
                // get questio id
                let qid = questionContainer.attr('qid');
                // get question body container
                let questionBody = questionContainer.find('.questionBody');
                // get all Right answer containers
                let AllRightAnswers = questionContainer.find('.winner');
                // set actions
                questionBody.each((qnum, qInpupt) => {
                    // get question container data
                    let that = $(qInpupt);
                    // get error code
                    let errorCode = that.find('.validationError');
                    // get Right Answer trigger
                    let rightAnswer = that.find('.winner');
                    // set actions
                    rightAnswer.on({
                        click: function() {
                            // get answer value
                            let value = that.find('input[type=text]').val();
                            // remove atcive class
                            AllRightAnswers.removeClass('topWinner');
                            // transmit value to the parent
                            questionContainer.attr('winner', value);
                            $(this).addClass('topWinner');
                        }// end click()
                    })// end on()
                })// end each()
            })// end each()
        }// end questionMode()
        // end region
    }// end modules

    let modulesBuild = new modules()
    modulesBuild.questionMode();