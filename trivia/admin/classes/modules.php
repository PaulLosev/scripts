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
        const TRIVIA_QUESTIONS_GROUPS = 'trivQuestionsGroups';
        // endregion
        // region const for localization
        const ANSWER = 'Answer';
        const QUESTION = 'Question';
        const RIGHT_ANSWER = 'Right Answer';
        const ADD_GROUP = 'Add Group';
        const INPUT_PLACEHOLDER = 'start typing..';
        const GROUP_HEADLINE = 'Group';
        const SAVE_BUTTON = 'save';
        // endregion
        // region class methods
        /**
         * method populates question array with the data
         * @param $qid
         * @return array|bool
         */
        public function getTriviaQuestionsData($qid):?array {
            // get questions
            $query = 'select *
                        from ' . self::TRIVIA_QUESTIONS_TABLE . '
                       where `id` = :qid';
            // prepare & run
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([':qid' => $qid]);
            // return data
            return $stmt->fetch(PDO::FETCH_ASSOC) ?? '';
        }// end getTriviaQuestionsData()
        /**
         * method returns trivia question groups
         * @return array|false|string
         */
        public function getQuestionGroups() {
            // query
            $query = 'select `group`
                        from `' . self::TRIVIA_QUESTIONS_GROUPS . '`';
            // prepare & run
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            // return array
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? '';
        }// end getQuestionGroups()
        /**
         * method returns empty array to build add question form
         * @return string[]
         */
        public function addQuestion():array {
            // return array
            return [
                'id' => '',
                'question' => '',
                'answerOne' => '',
                'answerTwo' => '',
                'answerThree' => '',
                'winnerAnswer' => '',
                'group' => '',
            ];
        }// end addQuestion()
        /**
         * method builds question module
         */
        public function triviaQuestions($post) {
            // cast the data according to the qid
            $data = empty($post['qid']) === false
                ? $this->getTriviaQuestionsData($post['qid'])
                : $this->addQuestion();
            // set module html
            echo '<div class="triviaQuestionContainer">
                      <div class="triviaQuestionBody">';
                            // cast qid for adding a new question method
                            $qid = empty($data['id']) === false ? ' qid="' . $data['id'] . '"' : '';
                            // cast winner answer
                            $winnerAnswer = empty($data['winnerAnswer']) === false ? 'winner="' .$data['winnerAnswer'] . '"' : '';
                            // start container
                echo '<div class="questionContainer" ' . $qid . $winnerAnswer . '>
                           <div class="errorPopup"></div>';
                           // set top answer
                           $topAnswer = empty($data['winnerAnswer']) === false ? $data['winnerAnswer'] : '';
                           // build select
                           echo '<div class="questionBody">
                                     <label>' . self::GROUP_HEADLINE . '</label>
                                     <span class="errorCode"></span>
                                     <select name="' . $data['group'] . '">
                                         <option value="">-none-</option>';
                                         // build drop down with groups
                                         foreach ($this->getQuestionGroups() as $group) {
                                             // selected
                                             $selected = $group['group'] === $data['group'] ? 'selected' : 'none';
                                             echo '<option value="' . strtolower($group['group']) . '" ' . $selected . '>' . ucfirst($group['group']) . '</option>';
                                         }// end foreach()
                           echo '<option value=""></option>
                                 <option value="" point="true">' . self::ADD_GROUP . '</option>
                                      </select>
                                 </div>';
                                // remove keys
                                // unset data sets to build questions
                                unset($data['id']);
                                unset($data['winnerAnswer']);
                                unset($data['group']);
                                // set questions
                                foreach ($data as $key => $value) {
                                    // assign top answer class to inputs
                                    $answer = ($value === $topAnswer) ? (empty($value) === false ? 'topWinner' : '') : '';
                                    // set winner answer container
                                    $winner = '<div class="winner ' . $answer . '">' . self::RIGHT_ANSWER . '</div>';
                                    // set apply right answer to answers only
                                    $rightQuestion = ($key !== 'winnerAnswer')
                                        ? ($key !== 'question' ? $winner : '')
                                        : '';
                                    // set headers
                                    $moduleHead = ($key !== 'question') ? self::ANSWER : self::QUESTION;
                                    // build form items (input vs select)
                                    // build inputs
                                    echo '<div class="questionBody">
                                               <label>' . $moduleHead . '</label>
                                               <span class="errorCode"></span>
                                               <input type="text" name="' . $key . '" value="' . $value . '" placeholder="' . self::INPUT_PLACEHOLDER . '" />';
                                    echo $rightQuestion . '
                                          </div>';
                                }// end foreach()
                                // save method
                                echo '<div class="saveMethod">
                                        <button>' . self::SAVE_BUTTON . '</button>
                                      </div>
                                </div>';
                echo '</div>
                  </div>
                  <script src="/trivia/admin/js/addTriviaQuestions.js?' . time(). '"></script>' . PHP_EOL;
        }// end triviaQuestion()
        // endregion
    }// end modules()
