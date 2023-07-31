<?php

    // namespace
    namespace admin\classes;
    use classes\dbconnect;
    use PDO;
    // connect classes
    require $_SERVER['DOCUMENT_ROOT'] . '/trivia/classes/dbconnect.php';
    /**
     * class saveData
     */
    class updateData extends dbconnect {
        // region class properties
        // endregion
        // region class const
        const TRIVIA_QUESTIONS_TABLE = 'triviaQuestions';
        const TRIVIA_QUESTIONS_GROUPS = 'trivQuestionsGroups';
        // endregion
        // region class methods
        public function updateGroupName($post) {
            // update query
            $query = 'update `trivQuestionsGroups` `group`
                   left join `triviaQuestions` `questions`
                          on `group`.`id` = `questions`.`gid`
                         set `group`.`group` = :value, `questions`.`group` = :value
                        where `group`.`id` = :gid';
            // params
            $params = [
                ':value' => $post['value'],
                ':gid' => $post['qid'],
            ];
            // prepare & run
            $stmt = $this->connect()->prepare($query);
            $stmt->execute($params);
        }// end updateGroupName()
        // endregion
    }// end updateData{}
