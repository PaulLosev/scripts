
<?php

// Setting errors
ini_set('display_errors', '1');
error_reporting(E_ALL);

class saveData {

    // region private properties
    // endregion

    // region class const
    const USER_TABLE = 'cupGameUsers';
    const TEAM_TABLE = 'cupTeams';
    // endregion

    // region class methods
    /**
     * @return PDO
     */
    public function getConnected(): PDO {

        // clients game
        return new PDO('mysql:host=;dbname=', '', '');
    }// end getConnected()

    /**
     * @return array|false
     */
    public function getUserTableColumns() {

        // set query
        $query = 'select `Column_name` 
                    from `Information_schema`.`columns` 
                   where `Table_name` like "cupGameUsers"';

        // prepare and run the query
        $stmt = $this->getConnected()->prepare($query);
        $stmt->execute();

        // return table's column names
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // unset id columns
        unset($columns[0]);

        // return formatted array
        return $columns;
    }// end getUserTableColumns()

    /**
     * @param $num
     * @return mixed
     */
    public function getTeamName($num) {

        // set query
        $query = 'select `team`
                    from `' . self::TEAM_TABLE . '`
                  where `id` = :num';

        // prepare and run the query
        $stmt = $this->getConnected()->prepare($query);
        $stmt->execute([':num' => $num]);

        // return team name
        return $stmt->fetch(PDO::FETCH_ASSOC)['team'];
    }// end getTeamName()

    /**
     * @param $data
     * @param $option
     * @return string
     */
    public function setQueryElements($data, $option): string {

        // set query string var
        $queryString = '';

        // set ttl of columns
        $count = count($data);

        // set columns count
        $k = 1;

        // set column data
        foreach ($data as $column) {

            // set coma for query build
            $coma = $k == $count ? '' : ', ';

            // set value var
            $value = $option === 'column'
                ? $column['Column_name']
                : $column;

            // set data / name quotes
            $quotes = $option !== 'column'
                ? '"'
                : '`';

            // set query columns
            $queryString .= $quotes . $value . $quotes . $coma;

            // increase column count
            $k++;
        }// end foreach()

        // return query string
        return $queryString;
    }// end setQueryElements()

    /**
     * @param $post
     */
    public function saveUserData($post) {

        // set lang code
        $langCode = $post['data'][8];

        // unset lang code from post array
        unset($post['data'][8]);

        // connect ipStack class
        require_once $_SERVER['DOCUMENT_ROOT'] . 'cup/classes/ipStack.php';
        // send email
        // connect email class
        require_once $_SERVER['DOCUMENT_ROOT'] . 'cup/classes/emailSendOut.php';
        // set ipStack class instance
        $ipStack = new ipStack();
        // set email class instance
        $emailSendout = new emailSendOut();

        // add values to user's array
        // set user teams + date
        $post['data']['location'] = $ipStack->getUserLocation();
        $post['data']['team1'] = self::getTeamName(mt_rand(1, 11));
        $post['data']['team2'] = self::getTeamName(mt_rand(12, 22));
        $post['data']['team3'] = self::getTeamName(mt_rand(23, 32));
        $post['data']['team4'] = self::getTeamName(mt_rand(1, 32));
        $post['data']['date'] = gmdate('D/M/Y h:m');

        // set dynamic query
        $query = 'insert into `' . self::USER_TABLE. '`
                              (' . self::setQueryElements($this->getUserTableColumns(), 'column') . ')
                       values (' . self::setQueryElements($post['data'], '') . ')';

        // prepare and run the query
        $stmt = $this->getConnected()->prepare($query);
        // return status
        echo $stmt->execute() === true
            ? 'saved'
            : 'error';

        // send email
        $emailSendout->sendEmailNotification($post['data'][2], $langCode);
    }// end saveUserData()

    /**
     * @param $post
     */
    public function validateUserEmail($post) {

        // set query
        $query = 'select `email` 
                    from `' . self::USER_TABLE . '`
                   where `email` = :email';

        // prepare and run the query
        $stmt = $this->getConnected()->prepare($query);
        $stmt->execute([':email' => $post['data']]);

        // return bool
        echo empty($stmt->fetch(PDO::FETCH_ASSOC)) === true
            ? 'true'
            : 'false';
    }// end validateUserEmail()

    /**
     * @param $uid
     * @return mixed
     */
    public function getUserResults($uid) {

        // set query
        $query = 'select `team1`,
                         `team2`,
                         `team3`,
                         `team4`
                    from `' . self::USER_TABLE . '`
                   where `email` = :email';

        // prepare and run query
        $stmt = $this->getConnected()->prepare($query);
        $stmt->execute([':email' => $uid['ID']]);

        // return usr results
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }// end getUserResults()

    /**
     * @param $uid
     */
    public function buildResults($uid) {

        // connect translation class
        require_once $_SERVER['DOCUMENT_ROOT'] . 'cup/classes/gameTranslate.php';
        // set the class instance
        $translate = new gameTranslate();

        // set user result array
        $userResults = $this->getUserResults($uid);

        // set result for existing data set
        if (empty($userResults) === false) {

            // set HTML
            echo '<div class="titlePageContainer">
                  <div class="resultPageContainer">
                      
                      <!-- ./ group of three container -->
                      <div class="groupOfThreeContainer">
                        <div>
                            <img src="/cup/images/teams/' . $userResults['team1'] . '.png" alt="' . $userResults['team1'] . '" />
                        </div>
                        <div>
                            <img src="/cup/images/teams/' . $userResults['team2'] . '.png" alt="' . $userResults['team2'] . '" />
                        </div>
                        <div>
                            <img src="/cup/images/teams/' . $userResults['team3'] . '.png" alt="' . $userResults['team3'] . '" />
                        </div>
                      </div>
                      <!-- ./ group of three container -->
                      
                      <!-- ./ group of on container -->
                      <div class="groupOfOneContainer">
                        <div>
                            <img src="/cup/images/teams/' . $userResults['team4'] . '.png" alt="' . $userResults['team4'] . '" />
                        </div>
                      </div>
                      <!-- ./ group of on container -->
                  </div>
                  
                  <!-- ./ good luck container -->
                  <div class="goodLuckThumbContainer">
                      <div>';

                        // translate page
                        $translate->translate([
                            'type' =>'final',
                            'lang' => $uid['lang'],
                        ]);

                echo '</div>
                  </div>
                  <!-- ./ good luck container -->
             </div>' . PHP_EOL;
        } else {

            // call unset cookie javascript class
            echo '<!-- ./ game logic class connect -->
                  <script src="/cup/js/cookieUnset.js?' . time() . '" type="text/javascript"></script>
                  <!-- ./ game logic class connect -->' . PHP_EOL;
        }// end if
    }// end buildResults()
    // endregion
}// end saveData{}
