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
         * method popuplates question container dahsboard
         * @return void
         */
        public function buildQuestionDash() {
            // HTML
            echo '<div class="secondLevelParent">
                    <div class="quetionsGroupCategories">
                        <h2>GROUPS</h2>
                        test container 01
                    </div>
                 </div>' . PHP_EOL;
        }// end buildQuestionDash()
        // endregion
    }// end containerBuilderClass{}
