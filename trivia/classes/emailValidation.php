<?php

    namespace classes;

    class emailValidation {
        // region class properties
        // endregion
        // region class const
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
         * @param $eid
         * @return boolean
         */
        public function checkForDoubleEntries($eid) {

            // return true only
            return true;
        }// end checkForDoubleEntries()
        // endregion
    }// end emailValidation{}
