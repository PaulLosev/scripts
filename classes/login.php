
<?php

/**
 * Class login
 */
class login
{
    // region private properties
    /**
     * @var $mDb the MySql Connect.
     */
    private $mDb;
    // endrefion

    // region const
    const ACCESS_CODE = 1;
    // endregion

    //region private, public methods
    public function __construct($mDb) {

        // set the mysql connect.
        $this->mDb = $mDb;
    }// end __construct()

    /**
     * Method validates password.
     *
     * @param string $pass The pasword Id.
     */
    public function validateInput($pass) {

        // encode user input password.
        $pass = md5($pass);

        // set the login query.
        $query = 'select `pass`
                    from `systemSettings`
                    where `id` = ' . self::ACCESS_CODE;

        // prepare and run the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute();

        // get the password.
        $systemPass = $stmt->fetch(PDO::FETCH_ASSOC)['pass'];

        // if values match
        if ($pass === $systemPass) {

            // login user.
            echo 'true';

        // if values differ.
        } else {

            // show the validation error.
            echo 'Sorry, incorrect password';
        }// end if
    }// end login()

    /**
     * Method sets the cookie and logs in to the CMS.
     */
    public function login()
    {
        // set the cookie params.
        $cookieParams = [
            // set the cookies for 30 days.
            'expires' => time() + 2592000,
            'path' => '/',
            'domain' => '',
        ];

        // set the cookie.
        setcookie('permission', 'granted', $cookieParams);
    }// end setCookie()

    /**
     * Method closes up the rest of pages if not logged in.
     */
    public function checkCookies() {

        // set the permission cookie.
        isset($_COOKIE['permission']) === false
            ? header('location: /admin/')
            : '';
    }// checkCookies()
    // end region
}// end login class
