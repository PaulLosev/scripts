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
        // endregion
    }// end validateData{}
