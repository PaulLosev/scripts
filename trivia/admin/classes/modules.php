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
        }// end getTriviaQuestionsData()
        /**
         * method build trivia qustion module
         * @return void
         */
        public function triviaQuestions() {
            // get all trivial questions
            $data = $this->getTriviaQuestionsData();
            // set module html
            echo '<div class="triviaQuestionContainer">
                      <div class="triviaQuestionBody">';
                            // set inputs html
                            foreach ($data as $question) {
                                // cast qid for adding a new question
                                $qid = empty($question['id']) === false ? ' qid="' . $question['id'] . '"' : '';
                                // start container
                           echo '<div class="questionContainer" ' . $qid . '>';
                                // set top answer
                                $topAnswer = empty($question['winnerAnswer']) === false ? $question['winnerAnswer'] : '';
                                // remove keys
                                unset($question['id']);
                                unset($question['winnerAnswer']);
                                // set questions
                                foreach ($question as $key => $value) {
                                    // assign top answer class to inputs
                                    $answer = ($value === $topAnswer) ? 'topWinner' : '';
                                    // set winner answer container
                                    $winner = '<div class="winner ' . $answer . '">' . self::RIGHT_ANSWER . '</div>';
                                    // set apply right answer to answers only
                                    $rightQuestion = ($key !== 'winnerAnswer')
                                        ? ($key !== 'question' ? $winner : '')
                                        : '';
                                    // set headers
                                    $moduleHead = ($key !== 'question') ? self::ANSWER : self::QUESTION;
                                    // build form items (input vs select)
                                    if ($key !== 'group') {
                                        // build inputs
                                        echo '<div class="questionBody">
                                               <label>' . $moduleHead . '</label>
                                               <span class="validationError">' . self::REQUIRED_FIELD . '</span>
                                               <input type="text" name="' . $key . '" value="' . $value . '" />';
                                        echo $rightQuestion . '
                                          </div>';
                                    } else {
                                        // build select
                                        echo '<div class="questionBody">
                                               <label>' .$key . '</label>
                                               <span class="validationError">' . self::REQUIRED_FIELD . '</span>
                                               <select name="' . $key . '">
                                                    <option value="">-</option>
                                                    <option value="0">Movies</option>
                                                    <option value="1">Action</option>
                                               </select>
                                             </div>';
                                    }// end if
                                }// end foreach()
                                // save method
                                echo '<div class="saveMethod">
                                        <button>SAVE</button>
                                      </div>
                                </div>';
                            }// end foreach()
                echo '</div>
                  </div>' . PHP_EOL;
        }// end triviaQuestion()
        // endregion
    }// end modules()
