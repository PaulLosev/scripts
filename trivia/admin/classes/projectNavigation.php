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
        // end region
        // region class const
        const TRIVIA_QUESTIONS_TABLE = 'triviaQuestions';
        const BACK_BUTTON_WORDING = '&larr;';
        // endregion
        // region class methods
        /**
         * @param $post
         * @return void
         */
        public function buildNagivation($post) {
            // set construction
            switch ($post['method']) {
                case 'questions':
                    $this->buildQuestionsCategory($post['method']);
                    break;
                default:
                    $this->defaultNavigation();
            }// end switch()
        }// end buildNagivation()
        /**
         * method retunr questions array
         * @return array|false|string
         */
        public function getAllQuetions() {
            // query
            $select = 'select `id`,
                              `question`
                         from `' . self::TRIVIA_QUESTIONS_TABLE . '`';
            // prepare & run
            $stmt = $this->connect()->prepare($select);
            $stmt->execute();
            // return data
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? '';
        }// end getAllQuetions()
        /**
         * method sets navigation items
         * @return string[]
         */
        public function navigationData(): array {
            // return navigation array
            return [
                'Dashboard' => 'dahsboard',
                'Reg Form Settings' => 'questions',
                'Users' => 'users',
                'Settings' => 'settings',
            ];
        }// end navigationData()
        /**
         * method build default navigation set
         * @return void
         */
        public function defaultNavigation() {
            // set headline
            echo '<div class="navigationControlsContainer">
                    <div>
                        <span>navigation</span>
                    </div>
                  </div>
            <!-- set dafult navigation html -->
            <ul>';
            // build dafult items
            foreach($this->navigationData() as $item => $key) {
                echo '<li catalog="' . $key . '">' . $item . '</li>';
            }// end foreach()
            echo '</ul>';
        }// end defaultNavigation()
        /**
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
                  </div>
            <!-- set dafult navigation html -->
            <ul>';
            // build dafult items
            foreach($this->getAllQuetions() as $item) {
                echo '<div class="questionBodyContainer">
                        <li catalog="' . $item['id'] . '">' . $item['question'] . '</li>
                        <div id="deleteQuestion">
                            <input type="image" src="/trivia/admin/img/delete.png" title="delete question"></input>
                        </div>
                      </div>';
            }// end foreach()
            echo '</ul>';
        }// end buildQuestionsCategory()
        // endregion
    }// end projectNavigation{}
