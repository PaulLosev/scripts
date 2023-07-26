<?php
    // namespace
    namespace admin\classes;
    use classes\dbconnect;
    use PDO;
    // connect classes
    require $_SERVER['DOCUMENT_ROOT'] . '/trivia/classes/dbconnect.php';
    /**
     * class saveData
     */
    class containerBuilderClass extends dbconnect {
        // region class properties
        // endregion
        // region class const
        const USER_TABLE = 'trivUsers';
        const QUESTIONS_TABLE = 'triviaQuestions';
        const TRIVIA_QUESTIONS_GROUPS = 'trivQuestionsGroups';
        const INPUT_PLACEHOLDER = 'start typing..';
        // endregion
        // region class methods
        public function setMethod($post) {
            // set variator
            switch ($post['category']) {
                case 'questions':
                $this->buildQuestionDash();
                break;
            }// end switch{}
        }// end setMethod()
        /**
         * method return array with group values
         * @return array
         */
        public function getAllGroups(): array {
            // query
            $query = 'select *
                        from `' . self::TRIVIA_QUESTIONS_GROUPS . '`';
            // prepare & run
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            // return data
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? '';
        }// end getAllGroups()
        /**
         * method popuplates question container dahsboard
         * @return void
         */
        public function buildQuestionDash() {
            // HTML
            echo '<div class="secondLevelParent">
                    <div class="quetionsGroupCategories">
                        <h2>GROUPS (in prog)</h2>
                        <div class="addNewGroupToDropdown">
                            <button>add group</button>
                        </div>';

                        // get array with all groups
                        foreach($this->getAllGroups() as $value) {
                            // build groups module
                            echo '<div class="questionBody" qid="' . $value['id'] . '">
                                    <span class="errorCode">*cannot be empty</span>
                                    <input type="text" name="group" value="' . $value['group'] . '" placeholder="' . self::INPUT_PLACEHOLDER . '" />
                                    <div class="deleteCategoryQuestions">
                                        <input type="image" src="/trivia/admin/img/delete.png" title="delete question"></input>
                                    </div>
                                  </div>' . PHP_EOL;
                        }// end foreach()
            // html
            echo '</div>
                 </div>
                 <!-- ./ group logic connect -->
                 <script src="/trivia/admin/js/groupLogicFunctionality.js?' . time(). '"></script>' . PHP_EOL;
        }// end buildQuestionDash()
        // endregion
    }// end containerBuilderClass{}
