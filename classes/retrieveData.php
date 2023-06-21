
<?php

// set the classes.
include_once $_SERVER['DOCUMENT_ROOT'] . 'classes/sendEmail.php';

/**
 * Class retrieveData
 */
class retrieveData extends sendEmail
{
    // region private properties
    /**
     * @var the marinaDB connect.
     */
    private $mDb;
    // endregion

    // region const
    const SYSTEM_RESET = 1;
    const DISABLED_CLASS = 'disabledSave';
    // end region

    // region functions
    /**
     * retrieveData constructor.
     * @param $mDb
     */
    public function __construct($mDb) {

        // set the marinaDB connect.
        $this->mDb = $mDb;
    }// end __construct()

    /**
     * @return string
     */
    public function setGames() {

        // set game option
        $option = '';

        // set game variations
        if (isset($_GET['public']) === true) {

            $option = '?public';
        } else if (isset($_GET['internal']) === true) {

            $option = '?internal';
        }// end if

        // return option
        return $option;
    }// end setGames()

    /**
     * Method sets the quarters abbreviations.
     */
    public function returnQuaterAbvr() {
        return [
            '1' => '1st Qtr',
            '2' => '2nd Qtr',
            '3' => '3rd Qtr',
            '4' => '4th Qtr',
        ];
    }// end returnQuaterAbvr()

    /**
     * Method returns clear Id.
     *
     * @return string[][]
     */
    public function returnGridValues() {
        return [
            '01' => [
                ' ',
                '1',
            ],

            '02' => [
                ' ',
                '2',
            ],

            '03' => [
                ' ',
                '3',
            ],

            '04' => [
                ' ',
                '4',
            ],

            '05' => [
                ' ',
                '5',
            ],

            '06' => [
                ' ',
                '6',
            ],

            '07' => [
                ' ',
                '7',
            ],

            '08' => [
                ' ',
                '8',
            ],

            '09' => [
                ' ',
                '9'
            ],

            '010' => [
                '1',
                '0',
            ],

            '110' => [
                '2',
                '0',
            ],

            '210' => [
                '3',
                '0',
            ],

            '310' => [
                '4',
                '0',
            ],

            '410' => [
                '5',
                '0',
            ],

            '510' => [
                '6',
                '0',
            ],

            '610' => [
                '7',
                '0',
            ],

            '710' => [
                '8',
                '0',
            ],

            '810' => [
                '9',
                '0',
            ],

            '910' => [
                '10',
                '0',
            ],
        ];
    }// end

    /**
     * Method return a promo block data by id.
     *
     * @param int $block the block id.
     */
    public function setPromoBlock($block) {

        // set the query.
        $query = 'select * 
                    from gamePromotion 
                   where `id` = :id';

        // prepare and run the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute([':id' => $block]);

        // fetch the data.
        $promoData = $stmt->fetch(PDO::FETCH_ASSOC);

        // set the html for the UI.
        echo '<div class="promoBlocksContiner">';

            // set the prmo blocks.
            $promoBlock = empty($promoData['promotionBody']) === false
                ? $promoData['promotionBody']
                : '';

            // set the block id.
            $blockId = empty($promoData['id']) === false
                ? $promoData['id']
                : '';

            // set the block uri.
            $blockUri = isset($promoData['uri']) === true
                ? $promoData['uri']
                : '';

            // set the html.
            echo '<textarea name="promoBlock" class="promoBlock" data-block-id="' . $blockId . '" dbconnect="' . self::setGames() . '">' . $promoBlock . '</textarea>
                  <input type="text" name="promoLink" class="linkInput" placeholder="please, set a global link ..." value="' . $blockUri . '" />
                  <button class="submitData" onclick="saveBlock()">SAVE</button> 
              </div>
              <script>
        
                // call the CK editor.
                CKEDITOR.replace("promoBlock");
                
                // set the CKE height.
                CKEDITOR.config.height = 310;
      
              </script>';
    }// end setPromoBlock()

    /**
     * Method saves updated block.
     *
     * @param array $post The data.
     */
    public function saveUpdatedBlock($post) {

        // set the block id.
        $blockId = isset($post['block']) === true
            ? $post['block']
            : '';

        // set the block data.
        $blockUpdatedData = isset($post['data']) === true
            ? $post['data']
            : '';

        // set the block uri.
        $blockUri = isset($post['blockUri']) === true
            ? $post['blockUri']
            : '';

        // set the query.
        $query = 'update `gamePromotion`
             set `promotionBody` = :updatedData,
                 `uri` = :uri
           where `id` = :block';

        // prepare the query.
        $stmt = $this->mDb->prepare($query);

        // set the query params
        $queryParams = [
            ':updatedData' => $blockUpdatedData,
            ':uri' => $blockUri,
            ':block' => $blockId,
        ];

        // run the query.
        if ($stmt->execute($queryParams) === true) {

            // return true.
            echo 'updated';
        } else {

            // return false.
            echo 'error';
        }// end if
    }// end saveUpdatedBlock()

    /**
     * Method sets the html for the random square function.
     *
     * @param string $category the cat id.
     */
    public function setRandomSquares($category) {

        // set the table.
        $table = $category . 'GridLine';

        // set the query.
        $query = 'select *
            from ' . $table;

        $stmt = $this->mDb->prepare($query);
        $stmt->execute();

        // set the html.
        while ($topLine = $stmt->fetch(PDO::FETCH_ASSOC)) {

            // set the value.
            $value = isset($topLine[$category . 'Grid']) === true
                ? $topLine[$category . 'Grid']
                : '';

            // retunr to the UI.
            echo '<input type="number" class="randomValueInput' . $category . ' ' . $topLine['class'] . '" onKeyPress="if (this.value.length == 1) return false" value="' . $value . '" />' . PHP_EOL;
        }// end while()
    }// end setRandomSquares()

    /**
     * Method saves the winners and updates all users with the winner Id.
     *
     * @param array $post the data for the method.
     */
    public function saveQuaterWinners($post) {

        // set the quarter id.
        $quarter = empty($post['container']) === false
            ? $post['container']
            : false;

        // set the left id.
        $leftId = isset($post['leftValue']) === true
            ? $post['leftValue']
            : false;

        // set the quarter id.
        $rightId = isset($post['rightValue']) === true
            ? $post['rightValue']
            : false;

        // set the update query.
        $query = 'update `quarterWinners`
                     set `qtrId` = :quarter,
                         `leftValueId` = :leftValue,
                         `rightValueId` = :rightValue,
                         `status` = :status
                   where `id` = :containerValue';

        // set the id.
        $winner = $leftId . $rightId;

        // set ids for the db.
        // set the left id.
        $outterLeft = isset(self::returnGridValues()[$winner][0]) === true
            ? self::returnGridValues()[$winner][0]
            : $leftId;

        // set the right id.
        $outterRight = isset(self::returnGridValues()[$winner][1]) === true
            ? self::returnGridValues()[$winner][1]
            : $rightId;

        // set the end id.
        $endId = $outterLeft . $outterRight;

        // set the query params.
        $queryParams = [
            ':quarter' => $quarter,
            ':leftValue' => $outterLeft,
            ':rightValue' => $outterRight,
            ':status' => 'set',
            ':containerValue' => $quarter,
        ];

        // run the query and set the quarter winners.
        $stmt = $this->mDb->prepare($query);

        // if the PDO returned true.
        if ($stmt->execute($queryParams) === true) {

            // update users.
            self::updateUserStatus($endId);
        }// end if
    }// end saveQuaterWinners()

    /**
     * Method updates all users with win id by a square.
     *
     * @param int $userSquare the user Id.
     */
    public function updateUserStatus($userSquare) {

        // set the query.
        $query = 'update `userReg`
                     set `status` = :won
                   where `squareId` = :userSquare';

        // set the query params.
        $queryParams = [
            ':won' => 'winner',
            ':userSquare' => $userSquare
        ];

        // prepare the query.
        $stmt = $this->mDb->prepare($query);

        // run.
        if ($stmt->execute($queryParams) === true) {

            // set the html.
            echo 'winners set, users have been updated';
        }// end if
    }// end updateUserStatus()

    /**
     * method updates grid status
     * @param $status
     */
    public function setGridUpdated($status) {

        // set the query
        $query = 'update `gridStatus`
                     set `status` = :status
                   where `id` = ' . self::SYSTEM_RESET;

        // prepare and run the query
        $stmt = $this->mDb->prepare($query);
        $stmt->execute([':status' => $status]);
    }// end setGridUpdated()

    /**
     * method toggles active save button class
     * @return string
     */
    public function setSaveRandomGridButton(): string {

        // set the query
        $query = 'select `status`
                    from `gridStatus`
                   where `id` = ' . self::SYSTEM_RESET;

        // prepare and run the query
        $stmt = $this->mDb->prepare($query);
        $stmt->execute();

        // set the button
        return $stmt->fetch(PDO::FETCH_ASSOC)['status'] !== 'true'
            ? 'submitData'
            : 'disabledSave';
    }// end setSaveRandomGridButton()

    /**
     * Method saves the squares.
     *
     * @param array $post the array of data.
     */
    public function saveRandomSquare(array $post) {

        // set the topGridLine table
        $topGrid = count($post['topGrid']);
        $leftGrid = count($post['topGrid']);

        // set the loop.
        for ($t = 0; $t < $topGrid; $t++) {

            // set the query.
            $query = 'update `topGridLine` 
                         set `topGrid` = :value, 
                              `class` = :class 
                        where `id` = :id';

            // set the value with only last entry.
            $cleanValue = str_split($post['topGrid'][$t]);

            // set the params.
            $queryParams = [
                ':value' => end($cleanValue),
                ':class' => 'locked',
                ':id' => $t,
            ];

            // prepare and run the query.
            $stmt = $this->mDb->prepare($query);
            $stmt->execute($queryParams);
        }// end for

        // set the loop.
        for ($l = 0; $l < $leftGrid; $l++) {

            // set the query.
            $query = 'update `leftGridLine` 
                         set `leftGrid` = :value, 
                              `class` = :class 
                        where `id` = :id';

            // set the value with only last entry.
            $cleanValueLeft = str_split($post['leftGrid'][$l]);

            // set the params.
            $queryParams = [
                ':value' => end($cleanValueLeft),
                ':class' => 'locked',
                ':id' => $l,
            ];

            // prepare and run the query.
            $stmt = $this->mDb->prepare($query);
            $stmt->execute($queryParams);
        }// end for

        // notify all users about the number been set.
        self::sendEmailNotification($this->mDb, $post['db']);

        // update grid status
        self::setGridUpdated($post['status']);

        // set html.
        echo 'saved';
    }// end saveRandomSquare()

    /**
     * Method returns niumber by category.
     *
     * @param string $category the category id.
     */
    public function setGridRandom($category) {

        // set the table name.
        $table = $category . 'Line';

        // set the query.
        $query = 'select `' . $category . '` from ' . $table;

        // perpare and run the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute();

        // set the grid lines.
        while ($number = $stmt->fetch(PDO::FETCH_ASSOC)) {

            // set the value.
            $theValue = $number[$category] !== ''
                ? $number[$category]
                : '#';

            // return the html.
            echo '<div class="squareContainerTop topAdjuster">' . $theValue . '</div>' . PHP_EOL;
        }// end while
    }// end setGridRandom()

    /**
     * Method sets quarter blocks on the set
     * quarter page with the statuses.
     */
    public function setQuarterBlocks() {

        // set the query.
        $query = 'select * 
                    from `quarterWinners`';

        // perpare and run the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute();

        // set the quarter container html.
        while ($qtrs = $stmt->fetch(PDO::FETCH_ASSOC)) {

            // set the id.
            $qrtId = isset($qtrs['id']) === true
                ? $qtrs['id']
                : false;

            // set the disable contaner
            $disabled = $qtrs['status'] === 'set'
                ? 'disabled'
                : '';

            // set the winner ids.
            $winnerIds = $qtrs['leftValueId'] . $qtrs['rightValueId'];

            // set the winners header.
            $setWinnerHeader = $disabled === 'disabled'
                ? '<p>Winners Set: ' . $winnerIds . '</p>'
                : '';

            // java function trigger.
            $triggerClass = $qtrs['status'] === 'set'
                ? 'setTheWinnerFalse'
                : 'setTheWinner';

            // set the html.
            echo '<div class="' . $triggerClass . ' ' . $disabled . '" data-quarter="' . $qrtId . '" dbconnect="' . self::setGames() . '">
                    
                        ' . self::returnQuaterAbvr()[$qrtId] . '
                        ' . $setWinnerHeader . '
                  </div>';
        }// emd while()
    }// end setQuarterBlocks()

    /**
     * Method populates, saves the quarter cntainer with data.
     *
     * @param null $id the quarter id.
     */
    public function preSetEachQuarter($id = null, $db = null) {

        // set the query.
        $query = 'select * 
                    from `quarterWinners` 
                   where `id` = :id';

        // perpare and run the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute([':id' => $id]);

        // get the quarter data.
        $quarter = $stmt->fetch(PDO::FETCH_ASSOC);

        // set the quarter id.
        $containerId = empty($quarter['id']) === false
            ? $quarter['id']
            : '';

        // set the left value.
        $leftIdValue = isset($quarter['leftValueId']) === true
            ? $quarter['leftValueId']
            : '';

        // set the right value.
        $rightIdValue = isset($quarter['rightValueId']) === true
            ? $quarter['rightValueId']
            : '';

        // set html.
        echo '<div class="leftContainer">
                <div class="leftContainerHeader">
                    <h3>
                        Set the left line
                    </h3>
                    <p>
                        Only one number per side
                    </p>
                </div>
                <div class="leftContainerBody">
                    <div class="theLeftGridLineContaner">';

                        // set the left line
                        for ($k = 0; $k <= 9; $k++) {

                            //
                            echo '<div class="leftLineGrid" data-picked-id-left="' . $k . '">' . $k . '</div>';
                        }// end for

                    echo '</div>
                    <div class="theLeftSideInputsContaner">
                        <p>
                            <span class="warning">
                                To set a quarter winner
                            </span> for each grid please, find the winner\'s spots on the both sides and click on them.
                        </p>
                            
                        <p>
                            <span class="warning">
                                The numbers you
                            </span> clicked on will be shown on the winner section on the right.
                        </p>

                        <p>
                            <span class="warning">
                                After you set the
                            </span> numbers click the Save button.
                        </p>
        
                        <p>
                            <span class="warning">
                               NOTE! You only can set a quarter winner one time per quarter.
                            </span> 
                            <br />
                                    You can use the winner section to input numbers as well. 
                                    In case of more than one charater input only the last one will be accounted.
                        </p>
                    </div>
                </div>
            </div>
            <div class="leftContainer">
                <div class="leftContainerHeader">
                    <h3>
                        Set the top line
                    </h3>
                    <p>
                        Only one number per side
                    </p>
                </div>
                <div class="leftContainerBody">
                    <div class="theRightGridLineContaner">';

                        // set the top line.
                        for ($k = 1; $k <= 10; $k++) {

                            //
                            echo '<div class="rightLineGrid" data-picked-id-left="' . $k . '">' . $k . '</div>';
                        }// end for

                    // keep the html coming :D
                    echo '</div>
                    <div class="pickedResults">
                        <div class="valError">
                            <div class="actualErrorQuaers">Please set the numbers first</div>
                        </div>

                        <h3>
                            ' . self::returnQuaterAbvr()[$containerId] . ' Winners
                        </h3>
                        <input type="hidden" name="actualContainerId" value="' . $containerId . '" />
                        <input type="number" name="leftSideNumber" class="roundedResults" value="' . $leftIdValue . '" onKeyPress="if (this.value.length == 1) return false" />
                        <input type="number" name="rightSideNumber" class="roundedResults" value="' . $rightIdValue . '" onKeyPress="if (this.value.length == 1) return false" />
                    </div>
                </div>
            </div>
            <button class="submitQuarterWinnerData" dbconnect="' . $db . '">SAVE</button>
            
            <!-- ./ quarter update js -->
            <script src="/admin/js/quartersUpdate.js?' . time() . '"></script>' . PHP_EOL;
    }// end preSetEachQuarter()

    /**
     * Method sets all winners for each grid.
     *
     * @return array
     */
    public function setAllWinners() {

        // set the winner's query.
        $query = 'select CONCAT(`leftValueId`, `rightValueId`) as winner
                    from `quarterWinners`';

        // prepare and run the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute();

        // return all winners.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }// end setAllWinners()

    /**
     * Method sets winner names for each grid.
     *
     * @param int $id   the winner id.
     * @param int $grid the grid id.
     * @return array
     */
    public function setWinnerName($id, $grid) {

        // set the query.
        $query = 'select CONCAT(`firstName`, " ", `lastName`) as winnerName
                    from `userReg`
                    where `gridId` = :grid and `squareId` = :userSquare';

        // set the query params.
        $queryParams = [
            ':grid' => $grid,
            ':userSquare' => $id,
        ];

        // prepare and run the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute($queryParams);

        // return name.
        $winnerName = $stmt->fetch(PDO::FETCH_ASSOC);

        // if has name in the array.
        if (empty($winnerName) === false) {

            // set the name and return it.
            return $winnerName['winnerName'];
        }// end if
    }// end setWinnerName()

    /**
     * Method populates the winner section on the index page.
     *
     * @param int $grid the grid id.
     */
    public function setWiners($grid) {

        // get all the winners.
        $gridWinner = self::setAllWinners();

        // set the first quarter winner.
        $firstQuarterWinner = empty($gridWinner[0]['winner']) === false
            ? self::setWinnerName($gridWinner[0]['winner'], $grid)
            : 'TBA';

        // set the first quarter winner.
        $secondQuarterWinner = empty($gridWinner[1]['winner']) === false
            ? self::setWinnerName($gridWinner[1]['winner'], $grid)
            : 'TBA';

        // set the first quarter winner.
        $thirdQuarterWinner = empty($gridWinner[2]['winner']) === false
            ? self::setWinnerName($gridWinner[2]['winner'], $grid)
            : 'TBA';

        // set the first quarter winner.
        $fourthQuarterWinner = empty($gridWinner[3]['winner']) === false
            ? self::setWinnerName($gridWinner[3]['winner'], $grid)
            : 'TBA';

        // set html.
        echo '<div class="promotionalBlockContainerBodyPrizes">
                        <div class="queterContainer">
                            <p>
                                <b>Qtr. 1</b>
                                <br />
                                <b>Winner</b>
                                    <br />
                                ' . $firstQuarterWinner . '                 
                            </p>
                        </div>
                        <div class="queterContainer dopDonsky">
                            <p>
                                <b>Qtr. 2</b>
                                    <br />
                                <b>Winner</b>
                                    <br />
                                ' . $secondQuarterWinner . '
                        </div>
                        <div class="queterContainer dopDonskyPart2">
                            <p>
                                <b>Qtr. 3</b>
                                    <br />
                                <b>Winner</b>
                                    <br />
                                ' . $thirdQuarterWinner . '
                            </p>
                        </div>
                        <div class="queterContainer">
                            <p>
                                <b>Final</b>
                                    <br />
                                <b>Winner</b>
                                    <br />
                                ' . $fourthQuarterWinner . '
                            </p>
                        </div>
                        <div class="helpLinkContainer">
                        
                        </div>
                    </div>' . PHP_EOL;
    }// end setWiners()

    /**
     * Mathod sets the team's name / color by team id.
     *
     * @param array $post the team data.
     */
    public function setTeams($post) {

        // set the team id.
        $teamId = empty($post['teamId']) === false
            ? $_POST['teamId']
            : '';

        // set the team name.
        $teamName = empty($post['teamName']) === false
            ? $_POST['teamName']
            : '';

        // set the team color.
        $teamColor = empty($post['teamColor']) === false
            ? $_POST['teamColor']
            : '';

        // set the query.
        $query = 'update `teams`
                     set `name` = :teamName,
                         `color` = :teamColor
                   where `id` = :teamId';

        // set the query params
        $queryParams = [
            ':teamName' => $teamName,
            ':teamColor' => $teamColor,
            ':teamId' => $teamId,
        ];

        // prepare and run the query.
        $stmt = $this->mDb->prepare($query);

        // set the team new data.
        if ($stmt->execute($queryParams) === true) {

            echo 'The team is set';
        }// end if
    }// end setTeams()

    /**
     * @return mixed
     */
    public function getTeams() {

        // set the query.
        $query = 'select `name`,
                         `color`
                    from `teams`';

        // prepare and run the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute();

        // return teamsters arrayy.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }// end getTeams()
    /**
     * Method reset the application to its default.
     */
    public function systemReset() {

        // set the reset quesries.
        // reset quarter winners table.
        $resetWinners = 'update `quarterWinners` 
                            set `qtrId` = "", 
                                `leftValueId` = "", 
                                `rightValueId` = "", 
                                `status` = ""';

        // reset top grid line table.
        $resetTopGrid = 'update `topGridLine` 
                            set `topGrid` = "", 
                                `class` = ""';

        // reset left grid table.
        $resetLeftGrid = 'update `leftGridLine` 
                             set `leftGrid` = "", 
                                 `class` = ""';

        // reset user reg mod table.
        $resetUserReg = 'delete from `userReg`';

        // reset close reg table.
        $resetRegModuleStatus = 'update `closeReg` 
                                    set `regStatus` = "open" 
                                  where `id` = ' . self::SYSTEM_RESET;

        // reset grid uniq table.
        $gridReset = 'update `gridUniq` 
                         set `grid` = ' . self::SYSTEM_RESET;

        // reset random numbers set table
        $randomNuerReset = 'update `gridStatus`
                               set `status` = ""
                             where `id` = ' . self::SYSTEM_RESET;

        // prepare and run the reset queries.
        $stmtOne = $this->mDb->prepare($resetWinners);
        $stmtTwo = $this->mDb->prepare($resetTopGrid);
        $stmtThree = $this->mDb->prepare($resetLeftGrid);
        $stmtFour = $this->mDb->prepare($resetUserReg);
        $stmtFifth = $this->mDb->prepare($resetRegModuleStatus);
        $stmtSixth = $this->mDb->prepare($gridReset);
        $stmtSeven = $this->mDb->prepare($randomNuerReset);

        // reset the app.
        $stmtOne->execute();
        $stmtTwo->execute();
        $stmtThree->execute();
        $stmtFour->execute();
        $stmtFifth->execute();
        $stmtSixth->execute();
        $stmtSeven->execute();

        // unset cookies
        if (isset($_SERVER['HTTP_COOKIE'])) {

            //
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);

            //
            foreach($cookies as $cookie) {
                //
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time() - 1000);
                setcookie($name, '', time() - 1000, '/');
            }// end foreach()
        }// end if
    }// end systemReset()
    // endregion
}// end retrieveData()
