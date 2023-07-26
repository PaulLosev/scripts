<?php

    // namespace
    namespace admin\classes;
    use classes\dbconnect;
    use PDO;
    // connect classes
    require $_SERVER['DOCUMENT_ROOT'] . '/trivia/classes/dbconnect.php';
    /**
     * class validateData
     */
    class validateData extends dbconnect {
        // region class properties
        // endregion
        // region class const
        const QUESTION_GROUP_TABLE = 'trivQuestionsGroups';
        const GROUP_QUESTION_ERROR_WORDING = 'the group name is in the system';
        // endregion
        // region class methods
        public function validateGroupName($post) {
            // query
            $query = 'select `group`
                        from `' . self::QUESTION_GROUP_TABLE . '`
                        where `group` = :groupName';
            // prepare & run
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([':groupName' => $post['value']]);
            // return true if set or error message if not set
            echo empty($stmt->fetch(PDO::FETCH_ASSOC)) === true
                ? 'true'
                : self::GROUP_QUESTION_ERROR_WORDING;
        }// end validateGroupName()
        // endregion
    }// end validateData{}
