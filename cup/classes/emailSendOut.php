
<?php

/**
 * Class sendEmail
 */
class emailSendOut {

    // region private properties
    // endregion

    // region const
    const USER_TABLE = 'cupGameUsers';
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
     * @param $UID
     * @return mixed
     */
    public function getUserData($UID) {

        // set query
        $query = 'select `firstName`,
                         `brand`,
                         `team1`,
                         `team2`,
                         `team3`,
                         `team4`
                    from `' . self::USER_TABLE . '`
                   where `email` = :email';

        // prepare and run the query
        $stmt = $this->getConnected()->prepare($query);
        $stmt->execute([':email' => $UID]);

        // return user's data
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }// end getUserData()

    /**
     * methods send email with user's data
     */
    public function sendEmailNotification($email, $lang) {

        // connect ipStack class
        require_once $_SERVER['DOCUMENT_ROOT'] . 'cup/classes/ipStack.php';
        // connect continental class
        require_once $_SERVER['DOCUMENT_ROOT'] . 'cup/classes/continentalSeparation.php';
        // connect translte class
        require_once $_SERVER['DOCUMENT_ROOT'] . 'cup/classes/gameTranslate.php';
        // set class instance
        $getContinent = new ipStack();
        // set continetal class instance
        $contental = new continentalSeparation();
        // connect game translte class
        $emailTranslate = new gameTranslate();

        // get user continet
        $continent = $getContinent->getUserLocationPlusCurrency()['country_code'];

        // get user currency sign
        $currency = $getContinent->getUserLocationPlusCurrency()['currency']['symbol'];

        // get user's data
        $user = $this->getUserData($email);

        // get translated text
        $translated = $emailTranslate->translate([
            'type' => 'emailTranslate',
            'lang' => $lang,
            ]);

        // subject.
        $subject = 'Your ' . $user['brand'] . ' Cup Challenge Teams Are Set!' . PHP_EOL;

        // message body.
        $message = '<html>
                        <head>
                          <title>' . $subject . '</title>
                        </head>
                        <body>
                        <table style="padding: 10px; border: 1px solid rgba(0,0,0,.1); width: 50%">
                          <tr>
                            <td style="text-align: center">
                            
                                ' . $translated['greetingOne'] . ' ' . $user['firstName'] . ',
                                
                                <span>' . $translated['greetingTwo'] . '</span>
                                <br />
                                    <br />
                                <table style="position: relative; width: 60%; margin: 0 auto">
                                    <tr>
                                        <th colspan="3" style="font-weight: normal">' . $translated['headFirstOne'] . '</th>
                                        <br />
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">
                                            <img src="https://' . $_SERVER['HTTP_HOST'] . '/cup/images/teams/' . $user['team1'] . '.png" style="width: 5vw" />
                                        </td>
                                        <td style="text-align: center">
                                            <img src="https://' . $_SERVER['HTTP_HOST'] . '/cup/images/teams/' . $user['team2'] . '.png" style="width: 5vw" />
                                        </td>
                                        <td style="text-align: center">
                                            <img src="https://' . $_SERVER['HTTP_HOST'] . '/cup/images/teams/' . $user['team3'] . '.png" style="width: 5vw" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center; font-weight: bold">' . strtoupper($user['team1']) . '</td>
                                        <td style="text-align: center; font-weight: bold">' . strtoupper($user['team2']) . '</td>
                                        <td style="text-align: center; font-weight: bold">' . strtoupper($user['team3']) . '</td>
                                    </tr>
                                </table>
                                <br />
                                    <br />   
                                
                                    ' . $translated['headFirstTwo'] . ' ' . $contental->setDataToThreeContinents($continent, $currency)[0] . ' ' . $translated['headSecond'] . '
                                <br />
                                    <br />     
                                <table style="position: relative; width: 60%; margin: 0 auto">
                                    <tr>
                                        <th style="font-weight: normal">' . $translated['headThirdOne'] . '</th>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">
                                            <img src="https://' . $_SERVER['HTTP_HOST'] . '/cup/images/teams/' . $user['team4'] . '.png" style="width: 6vw" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center; font-weight: bold">' . strtoupper(str_replace('_', ' ', $user['team4'])) . '</td>
                                    </tr>
                                </table>		
                                <br />
                                    <br />       
                                 ' . $translated['headThirdTwo'] . ' ' . $contental->setDataToThreeContinents($continent, $currency)[1] . ' ' . $translated['bodyOne'] . '
                            </td>
                          </tr>
                          <tr>
                            <td style="text-align: center">
                                <br />
                                        <br />	
                                ' . $translated['bodyTwo'] . ' ' . $user['brand'] . ' ' . $translated['footer'] . '
                            </td>
                          </tr>
                          <tr>
                              <td  style="text-align: center">' . $translated['footerOne'] . '</td>
                          </tr>
                          <tr>
                              <td style="text-align: center">' . $translated['byeOne'] . ' ' . $user['brand'] . ' ' . $translated['byeTwo'] . '</td>
                          </tr>
                        </table>
                        </body>
                    </html>' . PHP_EOL;

            // To send HTML mail, the Content-type header must be set.
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            // Additional headers
            $headers .= 'From: webpromotions@transperfect.com' . "\r\n";
            $headers .= 'Reply-To: Promotions <webpromotions@transperfect.com>' . "\r\n";

            // Mail it.
            mail($email, $subject, $message, $headers);
        }// end while()
    // end region
}// end sendEmail()
