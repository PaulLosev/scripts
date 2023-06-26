<?php

    // namespase
    namespace classes;
    /**
     * class formUI
     */
    class formUI {
        // region class properties
        // endregion
        // region class const
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
                    <input type="' . $type . '" name="u' . $inputName . '" id="upref' . $inputName . '" placeholder="start typing.." />
                    <!-- container info print -->       
                    <div class="infoContainer"></div>
                  </div>
                  <!-- form element container -->' . PHP_EOL;
        }// end buildForm()
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
                    <input type="' . $type . '"  id="upref' . $value . '" value="' . $value . '" />
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
                // set email input
                $this->buildFormInput('Name', 'input');
                // set email input
                $this->buildFormInput('Last Name', 'input');
                // set email input
                $this->buildFormInput('Email', 'email');
                // set submit button
                $this->buildSubmit('Submit', 'submit');
            echo '</div>' . PHP_EOL;
        }// end buildForm()
        // endregion
    }// end formUI()
