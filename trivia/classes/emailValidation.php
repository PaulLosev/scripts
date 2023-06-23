<?php

    // namespase
    namespace classes;
    // connect classes
    use PDO;
    // connect classes
    require $_SERVER['DOCUMENT_ROOT'] . '/trivia/classes/dbconnect.php';
    /**
     * class emailValidation
     */
    class emailValidation extends dbconnect {
        // region class properties
        /**
         * @var PDO PDO class connect
         */
        private PDO $dbc;
        // endregion
        // region class const
        const DOUBLE_ENTRY = 'doubleEntry';
        const EMAIL_PROVIDER = 'emailProvider';
        // region db table name const
        const USER_TABLE = 'triviaGameUsers';
        // endregion
        // region class method
        /**
         * parent method construct
         */
        public function __construct() {
            // set connect
            $this->dbc = $this->connect();
        }// end construct()
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
                case self::EMAIL_PROVIDER:
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
            // test
            /** @var TYPE_NAME $query */
            $query = 'select * from `cupTeams`';
            $stmt = $this->dbc->prepare($query);
            echo $stmt->execute() === true ? 'connected' : 'failed to connect';
        }// end emailDoubleEntry()
        // endregion
    }// end emailValidation{}
