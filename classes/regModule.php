
<?php

/**
 * Class regModule
 */
class regModule
{
    // region private properties.
    /**
     * @var the Marina DB.
     */
    private $mDb;
    // endregion

    // region const.
    const REG_MODULE_STATUS = 1;

    // system const.
    const GRID = 1;
    const PASS_CHANGE = 1;
    // endregion

    // region public methods.
    /**
     * regModule constructor.
     *
     * @param $mDb
     */
    public function __construct($mDb)
    {
        $this->mDb = $mDb;
    }// end __construct()

    /**
     * Method sets the uniq grid id.
     *
     * @return mixed
     */
    public function getGrid()
    {
        // set the query.
        $query = 'select `grid` 
                    from `gridUniq`';

        // prepare and execute the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute();

        // return the grid id.
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }// end getGrid()

    /**
     * Method updates the uniq grid id.
     *
     * @param int $grid the grid id.
     */
    public function updateGrid($grid)
    {
        // set the query.
        $query = 'update `gridUniq` 
                     set `grid` = :grid';

        // set the query params.
        $params = [
            ':grid' => $grid + self::GRID,
        ];

        // prepare and execute the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute($params);
    }// end updateGrid()

    /**
     * Method select all users by the grid id.
     *
     * @param int $grid the grid id.
     * @return array
     */
    public function selectRegisteredUsers($grid)
    {
        // set the query.
        $query = 'select * 
                       from `userReg`
                      where `gridId` = :grid';

        // set the query params.
        $queryParams = [
            ':grid' => $grid,
        ];

        // prepare and execute the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute($queryParams);

        // return the users.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }// end selectRegisteredUsers()

    /**
     * Method select all users for the cvs class.
     *
     * @return array
     */
    public function selectAllRegisteredUsers()
    {
        // set the query.
        $query = 'select * 
                    from `userReg`';

        // prepare and execute the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute();

        // return the users.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }// end selectAllRegisteredUsers()

    /**
     * Method checks if user exists.
     *
     * @param string $email the end user email id.
     */
    public function userCheck(string $email) {

        // set the query.
        $query = 'select `userEmail`
                    from `userReg` 
                   where `userEmail` = :endUser';

        // prepare ad run the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute([':endUser' => $email]);

        // return true.
        if ($stmt->fetch(PDO::FETCH_ASSOC) == true) {

            // return.
            echo 'true';
        }// end if
    }// end userCheck()

    /**
     * @param array $post
     */
    public function validateSquare(array $post) {

        // set query
        $query = 'select `gridId`,
                         `squareId`
                    from `userReg`
                   where `gridId` = :gridId
                     and `squareId` = :squareId';

        // set params
        $params = [
            ':gridId' => $post['grid'],
            ':squareId' => $post['square'],
        ];

        // prepare and run query
        $stmt = $this->mDb->prepare($query);
        $stmt->execute($params);

        // return bool
        if (empty($stmt->fetchAll(PDO::FETCH_ASSOC)) === false) {

            echo 'true';
        }// end if()
    }// end validateSquare()

    public function userDelete($email) {

        // set the query.
        $query = 'update `userReg`
                     set `firstName` = :deleted,
                         `lastName` = :noLast,
                         `userCompany` = :noCompany,
                         `color` = :color
                   where `userEmail` = :userEmail';

        // set the query params.
        $queryParams = [
            ':deleted' => 'Deleted',
            ':noLast' => '',
            ':noCompany' => '',
            ':userEmail' => $email,
            ':color' => '',
        ];

        // prepare and delete user.
        $stmt = $this->mDb->prepare($query);

        // return value.
        if ($stmt->execute($queryParams)) {

            // return true.
            echo 'User has been deleted';
        } else {

            // return false.
            echo 'something went wrong';
        }// end if
    }// end userDelete()

    /**
     * Method returns winner ids.
     *
     * @return array
     */
    public function setWinner() {

        // set the query.
        $query = 'select CONCAT(`leftValueId`, "", `rightValueId`) as `id`
                    from `quarterWinners`';

        // prepare and run the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute();

        // return winners.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }// end setWinner()

    /**
     * Method return user data by square id.
     *
     * @param int $square the square id.
     * @param int $grid   the grid id.
     * @return array
     */
    public function convertData($square, $grid)
    {
        // set the query.
        $query = 'select `id`,
                         `firstName`,
                         `userCompany`,
                         `lastName`,
                         `userEmail`,
                         `squareId`,
                         `color`
                    from `userReg`
                   where `squareId` = :square and `gridId` = :grid';

        // set the query params.
        $queryParams = [
            ':square' => $square,
            ':grid' => $grid,
        ];

        // prepare and execute the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute($queryParams);

        // return user data.
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // if it has a value
        if (empty($user) === false) {

            // return user data array.
            return $user;
        }// end if
    }// end convertData()

    /**
     * Method sets cookie.
     * @param int $grid the grid id.
     * @param int $id the user square id.
     * @return bool
     */
    public function setCookie($grid, $id)
    {
        // set the cookie params.
        $cookieParams = [
            // set the cookies for 30 days.
            'expires' => time() +2592000,
            'path' => '/',
            'domain' => '',
        ];

        // set the cookie.
        if (setcookie('userGrid', $grid, $cookieParams)) {

            // set user email.
            setcookie('id', $id, $cookieParams);

            // return true
            return true;
        }// end if
    }// end setCookie()

    /**
     * Method sets username by grid and user ids.
     *
     * @param int $grid   the grid id.
     * @param int $userId the user id.
     * @return string.
     */
    public function getUserName($grid, $userId)
    {
        // only if id is not empty.
        if (empty($userId) === false) {

            // set the query.
            $query = 'select `firstName` 
                        from `userReg`
                       where `squareId` = :squareId and `gridId` = :grid';

            // prepare and execute the query.
            $stmt = $this->mDb->prepare($query);

            // set the query params.
            $queryParams = [
                ':squareId' => $userId,
                ':grid' => $grid,
            ];

            // run and set the data.
            $stmt->execute($queryParams);
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            // return user data.
            return empty($userData['firstName']) === false
                ? $userData['firstName']
                : '';
        }// end if
    }// end getUserName()
    
    /**
     * Method logs user in and sets cookies.
     *
     * @param int $id The user id.
     * @return void
     */
    public function userLogin($id)
    {
        // set the query
        $query = 'select `firstName`,
                         `lastName`,
                         `gridId`,
                         `squareId`
                    from `userReg`
                   where `userEmail` = :email';

        // prepare and execute the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute([':email' => $id]);

        // set user data.
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        // if user found.
        if (empty($userData) === false) {

            // set the cookie params.
            self::setCookie($userData['gridId'], $userData['squareId']);

            // confirm the cookie been set.
            echo 'cookies set';
        // if user is not found.
        } else {

            // return false.
            echo 'false';
        }// end if
    }// end userLogin()

    /**
     * Method logs user in and sets cookies.
     *
     * @param int $id The user id.
     * @return void
     */
    public function autologin($id)
    {
        // set the query
        $query = 'select `firstName`,
                         `lastName`,
                         `gridId`,
                         `squareId`
                    from `userReg`
                   where `userEmail` = :email';

        // prepare and execute the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute([':email' => $id]);

        // set user data.
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        echo '<!- ./ autologin css inject -->
              <link href="/css/autologin.css" rel="stylesheet" />
              <!- ./ autologin css inject -->' . PHP_EOL;

        // if user found.
        if (empty($userData) === false) {

            // set the cookie params.
            self::setCookie($userData['gridId'], $userData['squareId']);

            // confirm the cookie been set.
            echo '<div class="userAutoLoggedInContainer">
                    <div class="userAutoLoggedInBody">
                        
                        <h2>Hello ' . $userData['firstName'] . ' ' . $userData['lastName'] . '</h2>
                        <p>Welcome back!</p>
                        <p>Please click \'Continue\' to get back to the game</p>
                        <button>Continue</button>
                    </div>
                  </div>' . PHP_EOL;
            // if user is not found.
        } else {

            // return false.
            echo '<div class="userAutoLoggedInContainer">
                    <div class="userAutoLoggedInBody ErrorUser">
                        
                        <h2>Hello,</h2>
                        <p>No user has been found, sorry...</p>
                        <p>Please click \'Ok\' try again</p>
                        <button>Ok</button>
                    </div>
                  </div>' . PHP_EOL;
        }// end if
    }// end userLogin()

    /**
     * Method gets the reg module status.
     *
     * @return array
     */
    public function getRegModuleStatus() {

        // set the query.
        $query = 'select `regStatus`
                    from `closeReg`
                   where `id` = ' . self::REG_MODULE_STATUS;

        // prepare and run the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute();

        // return reg module status.
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }// end getRegModuleStatus();

    /**
     * Method closes the reg module.
     *
     * @param string $status The reg module status.
     */
    public function closeRegModule($status) {

        // set the query.
        $query = 'update `closeReg`
             set `regStatus` = :status
          where `id` = 1';

        // prepare and run the query.
        $stmt = $this->mDb->prepare($query);

        // close reg module.
        if ($stmt->execute([':status' => $status]) === true) {

            // return confirmation.
            echo 'registration has been closed';
        }// end if
    }// end closeRegModule()

    /**
     * Method sets user ID by email.
     *
     * @param string $emailId the email id.
     * @return int
     */
    public function setUserId($emailId) {

        // set the query.
        $query = 'select `squareId`
                    from `userReg`
                   where `userEmail` = :emailId';

        // prepare and execute the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute([':emailId' => $emailId]);

        // set user data.
        $userid = $stmt->fetch(PDO::FETCH_ASSOC);

        // return square.
        return $userid['squareId'];
    }// end setUserId()

    /**
     * method returns last grid id
     * @return mixed
     */
    public function setMaxGrid() {

        // set the query
        $query = 'select MAX(distinct `gridId`) as `gridID`
                    from `userReg`';

        // prepare and execute the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute();

        // return the last grid DI
        return $stmt->fetch(PDO::FETCH_ASSOC)['gridID'];
    }// end setMaxGrid()

    /**
     * Method checks if the square has been taken.
     *
     * @param string $grid   the grid id.
     * @param string $square the square id.
     * @return string
     */
    public function checkGridSquare($grid, $square) {

        // set the query.
        $query = 'select `gridId`,
                         `squareId`
                    from `userReg`
                   where `gridId` = :grid 
                     and `squareId` = :square';

        // set the query params.
        $queryParams = [
            ':grid' => $grid,
            ':square' => $square
        ];

        // prepare and run the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute($queryParams);

        // get the grid id and the square id
        $userCheck = $stmt->fetch(PDO::FETCH_ASSOC);

        // cast values
        $userCheck['gridId'] = empty($userCheck['gridId']) === false
            ? $userCheck['gridId']
            : false;

        $userCheck['squareId'] = empty($userCheck['squareId']) === false
            ? $userCheck['squareId']
            : false;

        // if the values exist in the db.
        if ($userCheck['gridId'] == $grid && $userCheck['squareId'] == $square) {

            // return recent grid ID.
            return self::setMaxGrid() + 1;
        }// end if
    }// end checkGridSquare()

    /**
     * Method adds up a new user to the db.
     *
     * @param array $post the reg data.
     */
    public function regNewUser($post) {

        // check if the square been taken.
        $squareCheck = self::checkGridSquare($post['grid'], $post['square']);

        // set the actual grid
        $actGrid = empty($squareCheck) === true
            ? $post['grid']
            : $squareCheck;

        // set the query.
        $query = 'insert into `userReg` (`firstName`, 
                                 `lastName`, 
                                 `userPosition`, 
                                 `userCompany`,
                                 `userEmail`,
                                 `userRep`,
                                 `gridId`, 
                                 `squareId`,
                                 `regDate`,
                                 `state`,
                                 `status`,
                                 `color`
                       ) values (:firstName,
                                 :lastName,
                                 :userPosition,
                                 :userCompany,
                                 :userEmail,
                                 :userRep,
                                 :grid, 
                                 :square,
                                 :date,
                                 :state,
                                 :status,
                                 :color)';

        // set the params.
        $queryParams = [
            ':firstName' => empty($post['firstName']) === false ? $post['firstName'] : 'No Data',
            ':lastName' => empty($post['lastName']) === false ? $post['lastName'] : 'No Data',
            ':userPosition' => empty($post['userPosition']) === false ? $post['userPosition'] : 'No Data',
            ':userCompany' => empty($post['userCompany']) === false ? $post['userCompany'] : 'No Data',
            ':userEmail' => empty($post['userEmail']) === false ? $post['userEmail'] : 'No Data',
            ':userRep' => empty($post['userRep']) === false ? $post['userRep'] : 'No Data',
            ':grid' => $actGrid,
            ':square' => $post['square'],
            ':date' => date('M d Y'),
            ':state' => $post['state'],
            ':status' => '',
            'color' => '',
        ];

        // prepare and execute the query.
        $stmt = $this->mDb->prepare($query);

            // return some signs of adding.
            if ($stmt->execute($queryParams)) {

                // get user id
                $userRawId = self::setUserId($post['userEmail']);

                // set cookie.
                self::setCookie($actGrid, $userRawId);

                // return true.
                echo 'user registered, cookie set';

            // something went wrong.
            } else {

                // return false.
                echo 'something went wrong';
            }// end if
    }// end regNewUser()

    /**
     * Method changes the password.
     *
     * @param string $pass the pass id
     */
    public function passChange($pass) {

        // set the query.
        $query = 'update `systemSettings`
                     set `pass` = :pass,
                         `date` = :sysDate
                   where `id` = :id';

        // set the query params.
        $queryParams = [
            ':pass' => md5($pass),
            ':sysDate' => date('m-d-y h:m'),
            ':id' => self::PASS_CHANGE,
        ];

        // prepare and update the pass.
        $stmt = $this->mDb->prepare($query);

        // return confirm.
        if ($stmt->execute($queryParams)) {

            // return true.
            echo 'Password has been updated';
        } else {

            // return false.
            echo 'Something went wrong';
        }// end if
    }// end passChange()

    /**
     * Method sets a color for individual user.
     *
     * @param string $user  the user email id.
     * @param string $color the color id.
     */
    public function userSetColor($user, $color) {

        // set the query.
       $query = 'update `userReg`
                     set `color` = :color
                  where `userEmail` = :endUser';

        // set the query params.
        $queryPrams = [
            ':color' => $color,
            ':endUser' => $user,
        ];

        // prepare and run the query.
        $stmt = $this->mDb->prepare($query);

        //
        if ($stmt->execute($queryPrams)) {

            //
            echo 'User has been updated';
        } else {

            //
            echo 'Something went wrong';
        }// ens if
        // return bool.
    }// end userSetColor()
    // endregion
}// end regModule()
