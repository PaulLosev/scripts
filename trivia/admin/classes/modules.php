<?php
    // namespace
    namespace admin\classes;
    use classes\dbconnect;
    use PDO;
    // connect classes
    require $_SERVER['DOCUMENT_ROOT'] . '/trivia/classes/dbconnect.php';

    /**
     * class modules
     */
    class modules extends dbconnect {
        // region class properties
        // endregion
        // region class const
        const TRIVIA_QUESTIONS_TABLE = 'triviaQuestions';
        // endregion
        // region const for localization
        const ADD_QUESTION = 'Add question';
        const ANSWER = 'Answer';
        const QUESTION = 'Question';
        const RIGHT_ANSWER = 'Right Answer';
        const REQUIRED_FIELD = '*required';
        // endregion
        // region class methods
        public function getTriviaQuestionsData() {
            // get all trivial questions
            $query = 'select *
                        from ' . self::TRIVIA_QUESTIONS_TABLE;

            // prepare and run
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            // return data array
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? '';
        }//

        public function triviaQuestions() {
            // get all trivial questions
            $data = $this->getTriviaQuestionsData();
            // set module html
            echo '<div class="triviaQuestionContainer">
                      <div class="triviaQuestionBody">';
                            // set inputs html
                            foreach ($data as $question) {
                                echo '<div class="questionContainer" qid="' . $question['id'] . '"> 
                                          <h2>Add question</h2>';
                                              // set top answer
                                              $topAnswer = $question['winnerAnswer'];
                                              // remove keys
                                              unset($question['id']);
                                              unset($question['group']);
                                              unset($question['winnerAnswer']);
                                              // set questions
                                              foreach ($question as $key => $value) {
                                                  // assign top answer class to inputs
                                                  $answer = $value === $topAnswer ? 'topwinner' : '';
                                                  // set winner answer container
                                                  $winner = '<div class="winner ' . $answer . '">' . self::RIGHT_ANSWER . '</div>';
                                                  // set apply right answer to answers only
                                                  $rightQuestion = $key !== 'winnerAnswer'
                                                      ? ($key !== 'question' ? $winner : '')
                                                      : '';
                                                  // set headers
                                                  $moduleHead = $key !== 'question' ? self::ANSWER : self::QUESTION;
                                                  // remove key
                                                  echo '<div class="questionBody">
                                                            <label>' . $moduleHead . '</label>
                                                            <div class="validationError">' . self::REQUIRED_FIELD . '</div>
                                                            <input type="text" name="' . $key . '" value="' . $value . '" />';
                                                            echo $rightQuestion;
                                                  echo '</div>';
                                              }// end foreach()
                                echo '</div>';
                            }// end foreach()
                echo '</div>
                  </div>' . PHP_EOL;
        }// end triviaQuestion()
        // endregion
    }// end modules()
