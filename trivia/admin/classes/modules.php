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
        const TRIVIA_QUESTIONS_GROPUS = 'trivQuestionsGroups';
        // endregion
        // region const for localization
        const ANSWER = 'Answer';
        const QUESTION = 'Question';
        const RIGHT_ANSWER = 'Right Answer';
        const ADD_GROUP = 'Add Group';
        const SAVE_BUTTON = 'save';
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
         * method returns trvia question groups
         * @return array|false|string
         */
        public function getQuestionGroups() {
            // query
            $query = 'select `group`
                        from `' . self::TRIVIA_QUESTIONS_GROPUS . '`';
            // prepare & run
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            // return array
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? '';
        }// end getQuestionGroups()
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
                                // cast winner answer
                                $winnerAnswer = empty($question['winnerAnswer']) === false ? 'winner="' .$question['winnerAnswer'] . '"' : '';
                                // start container
                           echo '<div class="questionContainer" ' . $qid . $winnerAnswer . '>
                                    <div class="errorPopup">Warning</div>';
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
                                               <span class="errorCode"></span>
                                               <input type="text" name="' . $key . '" value="' . $value . '" />';
                                        echo $rightQuestion . '
                                          </div>';
                                    } else {
                                        // build select
                                        echo '<div class="questionBody">
                                               <label>' . $key . '</label>
                                               <span class="errorCode"></span>
                                               <select name="' . $key . '">
                                                    <option value="">-</option>';
                                        // build drop down with groups
                                        foreach ($this->getQuestionGroups() as $group) {
                                            // selected
                                            $selected = $value === $group['group'] ? 'selected' : 'none';
                                            echo '<option value="' . strtolower($group['group']) . '" ' . $selected . '>' . ucfirst($group['group']) . '</option>';
                                        }// end foreach()
                                        echo '<option value=""></option>
                                              <option value="addGroup">' . self::ADD_GROUP . '</option>
                                               </select>
                                             </div>';
                                    }// end if
                                }// end foreach()
                                // save method
                                echo '<div class="saveMethod">
                                        <button>' . self::SAVE_BUTTON . '</button>
                                      </div>
                                </div>';
                            }// end foreach()
                echo '</div>
                  </div>' . PHP_EOL;
        }// end triviaQuestion()
        // endregion
    }// end modules()
