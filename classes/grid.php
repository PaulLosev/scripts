
<?php

/**
 * Class grid
 */
class grid extends regModule
{
    // region pivate properties.
    // endregion

    // region consts.
    // endregion

    // region private / public / static methods.
    // endregion

    /**
     * Method sets, counts and updates the grid ID.
     *
     * @return int the grid id.
     */
    public function continuousGrid()
    {
        // get the grid id.
        $grid = $this->getGrid();

        // get all users by grid.
        $total = $this->selectRegisteredUsers($grid['grid']);

        // count and update the grid id > 100.
        $gridUpdate = count($total);

        // update the grid.
        if ($gridUpdate === 100) {

            // update grid.
            $this->updateGrid($grid['grid']);
        }// end if

        // return clean id.
        return $grid['grid'];
    }// end continuousGrid()

    /**
     * Method return regGrid only.
     *
     * @param int $grid the grid Id.
     */
    public function setRegGrid($grid)
    {
        // set the reg grid.
        for ($k = 1; $k <= 100; $k++) {

            // set the first winner.
            $firstPrize = isset(self::setWinner()[0]['id']) === true
                ? self::setWinner()[0]['id']
                : '';

            // set the second winner.
            $seoncdPrize = isset(self::setWinner()[1]['id']) === true
                ? self::setWinner()[1]['id']
                : '';

            // set the third winner.
            $thirdPrize = isset(self::setWinner()[2]['id']) === true
                ? self::setWinner()[2]['id']
                : '';

            // set the fourth winner.
            $fourthPrize = isset(self::setWinner()[3]['id']) === true
                ? self::setWinner()[3]['id']
                : '';

            // set the user square.
            $userSquare = $this->convertData($k, $grid);

            // region sub class.
            // set active classes.
            $generator = '';
            $winner = '';
            $userPosition = '';
            // endregion

            // set the style class on values only.
            if (empty($userSquare) === false) {

                // set the class.
                $generator = 'cookieGrid';
            }// end if

            // set the winners
            if ($k === (int) $firstPrize || $k === (int) $seoncdPrize) {

                // set the class.
                $winner = 'won';
            }// end if

            // set the winners
            if ($k === (int) $thirdPrize || $k === (int) $fourthPrize) {

                // set the class.
                $winner = 'won';
            }// end if
            // endregion set winner.

            // region current position.
            // set the user id.
            $userRawId = isset($_COOKIE['id']) === true
                ? $_COOKIE['id']
                : 'none';

            // check if cookies isset().
            if (isset($_COOKIE['id']) === true) {

                // check to find a current user.
                if ($k == $userRawId) {

                        // set the current position class.
                        $userPosition = 'userCurrentPosition';

                    // don't match? No active class then, let him go :D
                    } else {

                        // set to empty.
                        $userPosition = '';
                    }// end if
                }// end if
            // endregion current position.

            // set the user square id.
            $userId = isset($userSquare['id']) === true
                ? $userSquare['id']
                : '';

            // set the fist name.
            $firstName = isset($userSquare['firstName']) === true
                ? ucfirst($userSquare['firstName'])
                : '';

            // set the last name.
            $lastName = isset($userSquare['lastName']) === true
                ? ucfirst($userSquare['lastName'])
                : '';

            // set the user company name.
            $userCompany = isset($userSquare['userCompany']) === true
                ? substr(ucfirst(strtolower($userSquare['userCompany'])), 0, 30)
                : '';

            // set the user color.
            $userNameColor = empty($userSquare['color']) === false
                ? $userSquare['color']
                : '#4C5B86';

            // set the user info.
            $userInfo = $firstName . ' ' . substr($lastName, 0, 1);

            // set html.
            echo '<div class="squareContainer adjustedHover ' . $generator . ' ' . $winner . ' ' . $userPosition . '" style="color: ' . $userNameColor . '"
                       id="squareWithId" 
                       data-value="' . $k . '" 
                       data-user="' . $userId . '">
                    <p>
                        <strong>' . $userInfo . '</strong>
                            <br />' . $userCompany . '
                    </p>
                  </div>'. PHP_EOL;
            }// end for
    }// end setRegGrid()

    /**
     * Method sets the greetings on index page.
     *
     * @param string $userName  the user name.
     * @param string $colorTop  the color id.
     * @param string $colorLeft the color id.
     */
    public function setGreetings($userName, $colorTop, $colorLeft) {

        // set greetings.
         echo empty($userName) === true
            ? '<div class="leftSideContainer" style="background: ' . $colorLeft . '">
                        <h2>
                            Play!
                        </h2>
                        <p>
                            Click to claim a grid square for a chance to win!
                        </p>
                    </div>

                    <div class="afterLogin" style="background: ' . $colorTop . ' ">
                        <h2>
                            Already registered?
                        </h2>
                        <p>
                            Click here to enter your email and check your square.

                        </p>
                    </div>'
            : '<div class="greetingsAfterLogin" style="background: ' . $colorTop . ' ">
                        <h2>
                            Welcome ' . $userName . '
                        </h2>
                        <p>
                            Scroll down to see your grid and square selection.
                        </p>

                    </div>' . PHP_EOL;
    }// end setGreetings()
    // end region
}// end setRegGrid()
