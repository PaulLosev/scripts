<?php

    // namespace
    namespace admin\classes;
    use classes\dbconnect;
    use PDO;
    // connect classes
    require $_SERVER['DOCUMENT_ROOT'] . '/trivia/classes/dbconnect.php';
    /**
     * class projectNavigation
     */
    class projectNavigation extends dbconnect {
        // region class properties
        // endregion
        // region class const
        const TRIVIA_QUESTIONS_TABLE = 'triviaQuestions';
        const BACK_BUTTON_WORDING = '&larr;';
        // endregion
        // region class methods
        /**
         * system option setter
         * @param $post
         * @return void
         */
        public function buildNavigation($post) {
            // set construction
            switch ($post['method']) {
                case 'questions':
                    $this->buildQuestionsCategory($post['method']);
                    break;
                default:
                    $this->defaultNavigation();
            }// end switch()
        }// end buildNavigation()
        /**
         * method returns question array for edit question method
         * @return array
         */
        public function getAllQuestions():array {
            // query
            $select = 'select `id`,
                              `question`
                         from `' . self::TRIVIA_QUESTIONS_TABLE . '`';
            // prepare & run
            $stmt = $this->connect()->prepare($select);
            $stmt->execute();
            // return data
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? '';
        }// end getAllQuestions()
        /**
         * method sets navigation items for add question method
         * @return string[]
         */
        public function navigationData(): array {
            // return navigation array
            return [
                'Dashboard' => 'dashboard',
                'Registration Form Settings' => 'questions',
                'Users' => 'users',
                'Settings' => 'settings',
            ];
        }// end navigationData()
        /**
         * method builds default navigation set
         * @return void
         */
        public function defaultNavigation() {
            // headline
            echo '<div class="navigationControlsContainer">
                    <div>
                        <span>navigation</span>
                    </div>
                  </div>
            <!-- dafult navigation html -->
            <ul>';
            // build default items
            foreach($this->navigationData() as $item => $key) {
                echo '<li catalog="' . $key . '">' . $item . '</li>';
            }// end foreach()
            echo '</ul>';
        }// end defaultNavigation()
        /**
         * method build custom navigation for questions on the registration form
         * @param $headline
         * @return void
         */
        public function buildQuestionsCategory($headline) {
            // set headline
            echo '<div class="navigationControlsContainer">
                    <div>
                        <span>' . $headline . '</span>
                        <button id="backButton">' . self::BACK_BUTTON_WORDING . '</button>
                    </div>
                    <div class="addQuestionContainer">
                        <button method="addQuestion">add question</button>
                    </div>
                    <div class="seeDashFunction" category="questions">
                        <button method="seeDash">dash</button>
                    </div>
                  </div>
            <!-- set dafult navigation html -->
            <ul>';
            // build default items
            foreach($this->getAllQuestions() as $item) {
                echo '<div class="questionBodyContainer" qid="' . $item['id'] . '">
                        <li>' . $item['question'] . '</li>
                        <div id="deleteQuestion">
                            <input type="image" src="/trivia/admin/img/delete.png" title="delete question"></input>
                        </div>
                      </div>';
            }// end foreach()
            echo '</ul>
                  <!-- ./ class connect -->
                  <script src="/trivia/admin/js/editQuestionFunctions.js?' . time(). '"></script>' . PHP_EOL;
        }// end buildQuestionsCategory()
        // endregion
    }// end projectNavigation{}
