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
        public function buildFormInput() {
            // return email input
            echo '<!-- form element container -->
                  <div class="inputContainer">
                    <!-- container label -->
                    <label>Email</label>
                    <!-- container error code -->
                    <span class="errorCode"></span>
                    <!-- container input -->
                    <input type="email" name="uemail" id="uemail" placeholder="start typing.." />
                    <!-- container info print -->       
                    <div class="infoContainer"></div>
                  </div>
                  <!-- form element container -->' . PHP_EOL;
        }// end buildForm()
        // endregion
    }// end formUI()
