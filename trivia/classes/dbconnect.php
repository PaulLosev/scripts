<?php

    // namespace
    namespace classes;
    use PDO;
    /**
     * dbconnect by Paul Losev
     */
    class dbconnect {
        // region class properties
        // endregion
        // region class const
        const HOST = 'tpt-web4-db';
        const DB_USER_NAME = 'promo';
        const PASSWORD = 'c,wiejF83V.3';
        // endregion
        // region class methods
        /**
         * method returns db connect
         */
        public function connect(): PDO {
            // db connect
            return new PDO('mysql:host=' . self::HOST . ';dbname=' . self::DB_USER_NAME, self::DB_USER_NAME, self::PASSWORD);
        }// end connect()
        // endregion
    }// dbconnect{}
