<?php
    // namespace
    namespace admin\classes;
    use classes\dbconnect;
    use PDO;
    // connect classes
    require $_SERVER['DOCUMENT_ROOT'] . '/trivia/classes/dbconnect.php';
    /**
     * class deleteData
     */
    class deleteData extends dbconnect {
        // region class properties
        // endregion
        // region class const
        const USER_TABLE = 'trivUsers';
        const QUESTIONS_TABLE = 'triviaQuestions';
        // endregion
        // region class methods
        /**
         * method delete triva question by qid
         * @param $post
         * @return void
         */
        public function deleteTrivaQuestion($post) {
            // queery
            $query = 'delete from `' . self::QUESTIONS_TABLE . '`
                            where `id` = :qid';
            // pepare & run
            $stmt = $this->connect()->prepare($query);
            // return some confirm
            echo $stmt->execute([':qid' => strtolower($post['qid'])]) === true
                ? 'true'
                : 'false';
        }// end deleteTrivaQuestion()
        // endregion
    }// end deleteData()
