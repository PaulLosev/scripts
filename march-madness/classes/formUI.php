
<?php

/**
 * class FORM UI
 * of March Madness
 */
class formUI {

    // region private properties
    private $mDb;
    // endregion

    // region class const
    // region associated tables
    //
    // user table:          marchMadness         - save save user data
    // endregion

    // region const
    const APP_USERS = 'marchMadness';

    // consts
    const GENDER = 'gender';
    const PRIZE_OPTION = 'prizeOption';
    const ALUMNIS = 'alumnus';
    // end egion

    /**
     * @param $mDb mixed mysql connect
     */
    public function __construct($mDb) {

        // set the mysql connect
        $this->mDb = $mDb;
    }// end __construct()

    //region class methods
    /**
     * @return string[]
     */
    public function returnFormValues(): array {

        // set input data
        return [
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'position' => 'Position / Title',
            'company' => 'Company / Organization',
            'email' => 'Email Address',
            'gender' => 'Which tournament would you like to register in?',
            'representative' => 'Who invited you to play?',
            'prizeOption' => 'Preferred Prize Option:',
            'alumnus' => 'I am an alumnus of'
        ];
    }// end returnFormValues()

    /**
     * @return string[]
     */
    public function editPrizeOptions(): array {
        // retunrn array
        return [
            'amazon' => 'Amazon Gift Card',
            'apple' => 'Apple Gift Card',
            'visa' => 'Visa Gift Card',
        ];
    }// end editPrizeOptions{}

    /**
     * method sets form UI
     */
    public function setFormUI() {
        // set form inputs
        foreach (self::returnFormValues() as $input => $name) {
            // set required inputs
            $required = $input === self::ALUMNIS
                ? 'display: none'
                : '';
            // set no required inputs
            $notRequired = $input !== self::ALUMNIS
                ? 'required'
                : '';
            // hide representative
            $inputState = isset($_GET['email']) === true
                ? $input === 'representative' ? 'hidden' : 'text'
                : 'text';
            // hide input
            $hider = $inputState === 'hidden'
                ? 'display: none'
                : '';
            // set value of a hidden input
            $value = isset($_GET['email']) === true && $inputState === 'hidden'
                ? 'value="' .  $_GET['email'] . '"'
                : '';
            // set email validation
            $emailValid = $input === 'email'
                ? 'onkeyup="logic.validateDouble($(this).val(), this);"'
                : '';
            // set gender dropdown
            if ($input === self::GENDER) {
                // set gender dropdown html
                echo '<div class="formItem">
                        <label>' . $name . '
                            <span class="requiredFiled" style="' . $required . '">*</span>
                        </label>
                        <span class="valError"></span>
                        <select name="' . $input . '" id="gameInput" ' . $notRequired . '>
                            <option value="men">Men\'s</option>
                            <option value="women">Women\'s</option>
                        </select> 
                    </div>' . PHP_EOL;
            } else if ($input === self::PRIZE_OPTION) {
                // set prize option dropdown html [static]
                echo '<div class="formItem">
                        <label>' . $name . '
                            <span class="requiredFiled" style="' . $required . '">*</span>
                        </label>
                        <span class="valError"></span>
                        <select name="' . $input . '" id="gameInput" ' . $notRequired . '>
                            <option value="">- none -</option>
                            <option value="amazon">Amazon Gift Card</option>
                            <option value="apple">Apple Gift Card</option>
                            <option value="visa">Visa Gift Card</option>
                        </select> 
                    </div>' . PHP_EOL;
            } else {
                // set form inputs html
                echo '<div class="formItem" style="' . $hider . '">
                        <label>' . $name . '
                            <span class="requiredFiled" style="' . $required . '">*</span>
                        </label>
                        <span class="valError"></span>
                        <input type="' . $inputState . '" id="gameInput" name="' . $input . '" ' . $value . ' ' . $notRequired . ' ' . $emailValid . ' /> 
                    </div>' . PHP_EOL;
            }// end if
        }// end foreach()
    }// and setFormUI()

    /**
     * @param $uid
     */
    function getItemDataByUIS($uid) {

        // set query
        $query = 'select *
                    from `' . self::APP_USERS . '`
                   where `id` = :uid';
        // prepare and return entity data
        $stmt = $this->mDb->prepare($query);
        $stmt->execute([':uid' => $uid]);
        // return data
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }// end getItemDataByUIS()

    /**
     * @param $post
     */
    function populateEditedItem($post) {

        // set entity data
        $entity = self::getItemDataByUIS($post['uid']);

        // set form header
        echo '<h2>Edit: <b>' . $entity['firstName'] . ' ' . $entity['lastName'] . '</b></h2>';

        // set form inputs
        foreach (self::returnFormValues() as $input => $name) {

            // set required inputs
            $required = $input === self::ALUMNIS
                ? 'display: none'
                : '';

            // hide representative
            $inputState = isset($_GET['email']) === true
                ? $input === 'representative' ? 'hidden' : 'text'
                : 'text';

            // hide input
            $hider = $inputState === 'hidden'
                ? 'display: none'
                : '';

            // set value of a hidden input
            $value = isset($_GET['email']) === true && $inputState === 'hidden'
                ? 'value="' .  $_GET['email'] . '"'
                : 'value="' . $entity[$input] . '"';

            // set no required inputs
            $notRequired = $input !== 'alumnus'
                ? 'required'
                : '';

            // set email validation
            $emailValid = $input === 'email'
                ? 'onkeyup="logic.validateDouble($(this).val(), this);"'
                : '';

            // set gender dropdown
            if ($input === self::GENDER) {
                // set gender dropdown html
                echo '<div class="formItem">
                        <label>' . $name . '
                            <span class="requiredFiled">*</span>
                        </label>
                        <span class="valError"></span>
                        <select name="' . $input . '" id="gameInput" ' . $notRequired . '>
                            <option value="men">Men\'s</option>
                            <option value="women">Women\'s</option>
                        </select> 
                    </div>' . PHP_EOL;
            } else if ($input === self::PRIZE_OPTION) {
                // set prize option dropdown html
                echo '<div class="formItem">
                        <label>' . $name . '
                            <span class="requiredFiled">*</span>
                        </label>
                        <span class="valError"></span>
                        <select name="' . $input . '" id="gameInput" ' . $notRequired . '>
                            <option value="">- none -</option>';
                //
                foreach (self::editPrizeOptions() as $key => $option) {
                    // set selected item
                    $selected = $key === $entity[$input] ? 'selected' : '';
                    // set options
                    echo '<option value="' . $key . '" ' . $selected . '>' . $option . '</option>';
                }// end foreach{}
                echo '</select> 
                    </div>' . PHP_EOL;
            } else {
                // set form inputs html
                echo '<div class="formItem" style="' . $hider . '">
                        <label>' . $name . '
                            <span class="requiredFiled" style="' . $required . '">*</span>
                        </label>
                        <span class="valError"></span>
                        <input type="' . $inputState . '" id="gameInput" name="' . $input . '" ' . $value . ' ' . $notRequired . ' ' . $emailValid . ' /> 
                    </div>' . PHP_EOL;
            }// end if
        }// end foreach()

        // set form inputs html
        echo '<div class="formItem" style="display: none">
                        <input type="hidden" id="gameInput" name="id" value="' . $entity['id'] . '" /> 
                    </div>' . PHP_EOL;

        // set html
        echo '<!-- ./ submit button container -->
                <div class="formItem">
                    <button class="submitForm" onclick="logic.validate($(this).parent().parent(), \'admin\')">Submit Your Info</button>
                </div>' . PHP_EOL;
    }// end populateEditedItem()

    /**
     *
     */
    public function gameClosed() {

        return '<div class="gameClosedContainer">
                    <div class="gameClosedBody">
                        <h2>The registration is closed!</h2>
                    </div>
                </div>' . PHP_EOL;
    }// end gameClosed()
    // endregion
}// end formUI
