<?php

    // namespace
    namespace classes;
    use PDO;
    /**
     * class formUI
     */
    class formUI extends dbconnect {
        // region class properties
        // endregion
        // region class const
        const TRIVIA_QUESTIONS_TABLE = 'triviaQuestions';
        // region form headers
        const ADDON_QUESTIONS_HEADLINE = 'To get more prizes please answer the questions';
        const INPUT_PLACE_HOLDER = 'start typing..';
        // endregion
        // region class methods
        /**
         * method brings special chars to the array
         */
        public function specialChar():array {
            // return array
            return [' ', '_', ', ', '.', '. ', ','];
        }// end specialChar()

        /**
         * method gets the data for trivia questions
         * has options
         * @return array|false|string
         */
        public function getTriviaQuestionsData() {
            // set query quesion variator
            $variator = isset($_GET['option']) === true
                ? ' where `group` = ' . $_GET['option']
                : '';
            // query
            $query = 'select `id`,
                             `question`,
                             `answerOne`,
                             `answerTwo`,
                             `answerThree`
                        from `' . self::TRIVIA_QUESTIONS_TABLE . '`
                        '  . $variator;
            // prepare and run
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            // return data
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? '';
        }// end getTriviaQuestionsData()
        /**
         * @param $data
         * @return mixed
         */
        public function sortQuestions($data) {
            // return filtered questions
            unset($data['id']);
            unset($data['question']);
            return $data;
        }// end sortQuestions()
        /**
         * method bulds input by type name
         * Label
         * Type
         * Input Name
         * @param $value
         * @param $type
         * @return void
         */
        public function buildFormInput($value, $type) {
            // method takes optiond
            // 1. email
            // 2. input
            // cast value not to have any special chars
            $inputName = str_replace(self::specialChar(), '', $value);
            // return email input
            echo '<!-- form element container -->
                  <div class="inputContainer" id="' . $type . 'Validation">
                    <!-- container label -->
                    <label>' . $value . '</label>
                    <!-- container error code -->
                    <span class="errorCode"></span>
                    <!-- container input -->
                    <input type="' . $type . '" name="u' . $inputName . '" id="upref' . $inputName . '" placeholder="' . self::INPUT_PLACE_HOLDER . '" category="user" />
                    <!-- container info print -->       
                    <div class="infoContainer"></div>
                  </div>
                  <!-- form element container -->' . PHP_EOL;
        }// end buildForm()
        /**
         * method builds the tirvia questions
         * @return void
         */
        public function buildTriviaQustions() {
            // set question header
            echo '<h2>' . self::ADDON_QUESTIONS_HEADLINE . '</h2>' . PHP_EOL;
            // build question dropdowns
            // get array of trivia questions
            foreach($this->getTriviaQuestionsData() as $dataSet) {
                // set HTMLs
                echo '<!-- form element container -->
                  <div class="inputContainer" id="triviaQuestionValidation">
                    <!-- container label -->
                    <label>' . $dataSet['question'] . '</label>
                    <!-- container error code -->
                    <span class="errorCode"></span>
                    <!-- container input -->
                    <select name="triviaQuestion" id="' . $dataSet['id'] . '" category="question">
                        <option value="">- none -</option>';
                        // build answers
                        foreach($this->sortQuestions($dataSet) as $question) {
                            // return html
                            echo '<option value="' . $question . '">' . $question . '</option>' . PHP_EOL;
                        }// end foreach()
                echo '</select>
                    <!-- container info print -->       
                    <div class="infoContainer"></div>
                  </div>' . PHP_EOL;
            }// end foreach()
        }// end buildTriviaQustions()
        /**
         * @return void
         */
        public function buildSubmit($value, $type) {
            // set button html
            echo '<!-- form element container -->
                  <div class="inputContainer">
                    <!-- container error code -->
                    <span class="errorCode"></span>
                    <!-- container input -->
                    <input type="' . $type . '"  id="upref' . $value . '" value="' . $value . '" category="submit" />
                    <!-- container info print -->       
                    <div class="infoContainer"></div>
                  </div>' . PHP_EOL;
        }// end buildSubmit()
        /**
         * form constructor
         * @return void
         */
        public function buildForm() {
            // set from container
            echo '<div class="gameFormContainer">' . PHP_EOL;
                // set name input
                $this->buildFormInput('Name', 'input');
                // set last name input
                $this->buildFormInput('Last Name', 'input');
                // set email input
                $this->buildFormInput('Email', 'email');
                // build form questions
                $this->buildTriviaQustions();
                // set submit button
                $this->buildSubmit('Submit', 'submit');
            echo '</div>' . PHP_EOL;
        }// end buildForm()
        // endregion
    }// end formUI()
