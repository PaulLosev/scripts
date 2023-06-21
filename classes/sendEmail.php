
<?php

/**
 * Class sendEmail
 */
class sendEmail
{
    // region private properties
    // region const
    // end region

    // region private, public, static methods.
    /**
     * @param mixed $mDb the Marina DB connect.
     */
    public function sendEmailNotification($mDb, $db) {

        // cast db set
        $db = empty($db) === false
            ? $db . '&'
            : '?';

        // set the query.
        $query = 'select `userEmail`
                    from `userReg`';

        // prepare and run he query.
        $stmt= $mDb->prepare($query);
        $stmt->execute();

        // set all the users from the table.
        while ($usersData = $stmt->fetch(PDO::FETCH_ASSOC)) {

            // set the user email.
            $userEmail = empty($usersData['userEmail']) === false
                ? $usersData['userEmail']
                : '';

            // recipient.
            $to = $userEmail;

            // subject.
            $subject = 'Your TransPerfect Super Squares Grid is Set!';

            // measge body.
            $message = '
                        <html>
                        <head>
                          <title>TransPerfect Super Squares</title>
                        </head>
                        <body>
                        <table style="padding: 10px; border: 1px solid rgba(0,0,0,.1); width: 50%">
                          <tr>
                            <td style="padding: 10px">
                                <span style="font-weight: bold">Thanks for playing Super Squares ' . date( 'Y' ) . '</span>
                                    <br />
                                        <br />
                                        Row and column numbers have been randomly assigned and are now locked.  
                                        You can check your numbers by returning to the <a href="https://promo.transperfect.com/' . $db . 'autologin=' . $userEmail . '" target="_blank">game here</a>.
                                        
                                    <br />
                                        <br />
                                        Results will be posted on Monday, and we\'re very much looking forward to seeing who wins!
                                        If you have any questions, email your representative or reply to this message.   
                            </td>
                          </tr>
                          <tr>
                            <td style="padding: 10px">Enjoy the game, and good luck!</td>
                          </tr>
                            <tr>
                            <td style="padding: 10px">- The TransPerfect Team</td>
                          </tr>
                        </table>
                        </body>
                        </html>';

            // To send HTML mail, the Content-type header must be set.
            $headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            // Additional headers
            $headers .= 'From: webpromotions@transperfect.com' . "\r\n";
            $headers .= 'Reply-To: Rian Simpler <rsimper@transperfect.com>' . "\r\n";

            // Mail it.
            mail($to, $subject, $message, $headers);
        }// end while()
    }// end sendEmailNotification()
    // end region
}// end sendEmail()
