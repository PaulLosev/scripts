<?php

    // namespace
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
        const USER_TABLE = 'trivUsers';
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
         * method check if email value in the db
         * returns boolean values
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
         * @param string $email
         * @return void
         */
        public function emailDoubleEntry(string $email) {
            // query
            $query = 'select `id` 
                        from `' . self::USER_TABLE . '` 
                       where `email` = :email';
            // prepare & run
            $stmt = $this->dbc->prepare($query);
            $stmt->execute([':email' => $email]);
            // return true if email is in db
            echo empty($stmt->fetch(PDO::FETCH_ASSOC)) === false
                ? 'true'
                : 'false';
        }// end emailDoubleEntry()
        // endregion
    }// end emailValidation{}
