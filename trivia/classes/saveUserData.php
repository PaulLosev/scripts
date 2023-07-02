<?php
    // namespace
    namespace classes;
    // connect classes
    use PDO;
    // connect classes
    require $_SERVER['DOCUMENT_ROOT'] . '/trivia/classes/dbconnect.php';
    /**
     * class saveUserData
     */
    class saveUserData extends dbconnect {
        // region class properties
        // endregion
        // region class const
        const DATA_PREFIX = 'upref';
        const USER_TABLE = 'trivUsers';
        const TRIVIA_QUESTIONS_TABLE = 'triviaQuestions';
        const USER = 'user';
        const ANSWERS = 'answers';
        const PERSONAL_EMAIL_USAGE = 3;
        // endregion
        // region class functions
        /**
         * method converts data from the forom for the table's columns
         * @return array
         */
        public function returnTableNames(): array {
            // return array
            return [
                'name' => 'firstName',
                'lastName' => 'lastName',
                'email' => 'email',
            ];
        }// end returnTableNames()
        /**
         * @param $post
         * @return void
         */
        public function save($post) {
            // user data
            $user = $this->getData($post, self::USER);
            // build user array with right table name
            $sortedUserArray = $this->convertData($user);
            // get answers
            $answers = $this->countPoints($this->getData($post, self::ANSWERS));
            // questions vs answers + total of all points
            $pointsForAnswers = count($answers);
            // get personal
            $personal = empty($post['emailType']) === false
                ? $pointsForAnswers - self::PERSONAL_EMAIL_USAGE
                : $pointsForAnswers;
            // conver point not to have negative values
            $convertedpoints = $this->convertPoints($personal);
            // add point column to the array
            $sortedUserArray['points'] = $convertedpoints;
            // save user data
            $this->saveUserData($sortedUserArray);
        }// end save()
        /**
         * method retunr 0 if value has negavite sign
         * @param $points
         * @return int
         */
        public function convertPoints($points):int {
            // return 0 in points have negative count
            return max($points, 0);
        }// end convertPoints()
        /**
         * method return a right answer by qid
         * @param int $qid
         * @return string
         */
        public function getTherightones(int $qid):string {
            // query
            $query = 'select `winnerAnswer` 
                        from `' . self::TRIVIA_QUESTIONS_TABLE . '`
                        where `id` = :qid';
            // prepare & run
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([':qid' => $qid]);
            // return answer
            return $stmt->fetch(PDO::FETCH_ASSOC)['winnerAnswer'];
        }// end getTherightones()
        /**
         * method counts user's answered question's points
         * @param $data
         * @return array
         */
        public function countPoints($data):array {
            // points array
            $points = [];
            // compare answers with real ones
            foreach ($data as $id => $answer) {
                // get & set points
                $points[] = $this->getTherightones((int) $id) === $answer
                    ? 'true'
                    : '';
            }// end foreach()
            // return all points
            return array_filter($points);
        }// end countPoints()
        /**
         * method converts value to db table names
         * @param array $data
         * @return array
         */
        public function convertData(array $data): array {
            // set user array
            $userArray = [];
            // build user array
            foreach ($data as $key => $value) {
                // cast value
                $keyvalue = lcfirst(str_replace(self::DATA_PREFIX, '', $key));
                // return data
                $userArray[$this->returnTableNames()[$keyvalue]] = $value;
            }// end foreach()
            // return array
            return $userArray;
        }// end convertData()
        /**
         * @param array $data set of data
         * @param string $level the needle
         * @return array
         */
        public function getData(array $data, string $level):array {
          //  print_r($data);
            // decode json
            $array = json_decode($data[$level]);
            // return data
            $retunrndata = [];
            // build array
            foreach ($array as $set) {
                $retunrndata[$set->id] = $set->itemName;
            }// end foreach()
            // return filtered data
            return $retunrndata;
        }// end getData()
        /**
         * method updates user table
         * @param array $array
         * @return void
         */
        public function saveUserData(array $array) {
            print_r($array);
        }// end saveUserData()
        // endregion
    }// end saveUserData{}
