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
    class saveData extends dbconnect {
        // region class properties
        private array $dataSet = [];
        // endregion
        // region class const
        const USER_TABLE = 'trivUsers';
        const QUESTIONS_TABLE = 'triviaQuestions';
        // endregion
        public function saveMethod($post) {
            // format data
            $data = $this->formatData($post);
            // get methods
            empty($data[0]) === true
                ? $this->insertMethod($data)
                : $this->updateMethod($data);
        }// end saveMethod()
        /**
         * method saves new question
         * @param $data
         * @return void
         */
        public function insertMethod($data) {
            // query
            $query = 'insert into `' . self::QUESTIONS_TABLE . '`
                                    (`question`,
                                     `answerOne`, 
                                     `answerTwo`,
                                     `answerThree`,
                                     `winnerAnswer`,
                                     `group`)
                             values (:question, 
                                     :answerOne, 
                                     :answerTwo, 
                                     :answerThree, 
                                     :winnerAnswer, 
                                     :group)';
            // params
            $params = [
                ':question' => $data[2],
                ':answerOne' => $data[3],
                ':answerTwo' => $data[4],
                ':answerThree' => $data[5],
                ':winnerAnswer' => $data[6],
                ':group' => $data[1],
            ];
            // prepare & run
            $stmt = $this->connect()->prepare($query);
            // return some confirm
            echo $stmt->execute($params) === true
                ? 'true'
                : 'false';
        }// end insertMethod()
        /**
         * method update question data by qid
         * @param $data
         * @return void
         */
        public function updateMethod($data) {
            // query
            $query = 'update `' . self::QUESTIONS_TABLE . '`
                         set `question` = :question,
                             `answerOne` = :answerOne,
                             `answerTwo` = :answerTwo,
                             `answerThree` = :answerThree,
                             `winnerAnswer` = :winnerAnswer,
                             `group` = :group 
                        where `id` = :qid';
            // params
            $params = [
                ':question' => $data[2],
                ':answerOne' => $data[3],
                ':answerTwo' => $data[4],
                ':answerThree' => $data[5],
                ':winnerAnswer' => $data[6],
                ':group' => $data[1],
                ':qid' => $data[0],
            ];
            // prepare & run
            $stmt = $this->connect()->prepare($query);
            // return some confirm
            echo $stmt->execute($params) === true
                ? 'true'
                : 'false';
        }// end updateMethod()
        /**
         * method formats data set from stdClass to saveMethod set
         * @param $post
         * @return array
         */
        public function formatData($post):array {
            // decode json
            $json = json_decode($post['data']);
            // set qid if isset
            $this->dataSet[] = empty($json[0]->qid) === false
                ? $json[0]->qid
                : '';
            // build data set
            foreach ($json as $value) {
                // push values with keys
                $this->dataSet[] = $value->value;
            }// end foreach()
            // push the winner answer
            $this->dataSet[] = $json[0]->winner;
            // return formatted data set
            return $this->dataSet;
        }// end formatData()
        // endregion
    }// end saveData()