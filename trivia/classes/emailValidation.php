<?php

    namespace classes;

    class emailValidation {
        // region class properties
        // endregion
        // region class const
        const DOUBLE_ENTRY = 'doubleEntry';
        const EMAIL_PROVIDER = 'emailProvider';
        // endregion
        // region class methods
        /**
         * @return string[]
         */
        public function emailProviders(): array {
            // return array
            return [
             'gmail',
             'mail',
            ];
        }// end emailProviders()
        /**
         * method check if email value in the db
         * returns boolian values
         * @param $post array
         */
        public function takeEmailValue(array $post) {
            // set methods
            switch ($post['method']) {
                case self::DOUBLE_ENTRY:
                    $this->emailDoubleEntry($post['email']);
                    break;
                case '':
                    echo 'test';
                    break;
            }// end switch construction
        }// end checkForDoubleEntries()
        /**
         * method runs a check for double entries in the db table
         * @param string $value
         */
        public function emailDoubleEntry(string $value) {

            echo $value;
        }// end emailDoubleEntry()
        // endregion
    }// end emailValidation{}
