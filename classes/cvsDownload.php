
<?php

/**
 * Class cvsDownload
 */
class cvsDownload
{
    // region private properties
    private $mDb;
    // end region
    
    // region const
    // end region
    
    // region private / public methods

    /**
     * cvsDownload constructor.
     * @param $mDb
     */
    public function __construct($mDb)
    {
        $this->mDb = $mDb;
    }// end __construct()

    /**
     * Method generates and sends .csv to the UI.
     *
     * @param null|int $winner         The used id.
     * @param null|string $salseReport The salse person email id.
     */
    public function csvDownload($winner = null, $salseReport = null) {

        // set the additional query var.
        $addOnsky = '';
        
        // see if we need to return the winner report.
        if ($winner === 'winnerReport') {

            //
            $addOnsky = 'where `status` = "winner"';
        }// end if

        // see if the salse report requested.
        if (empty($salseReport) === false) {

            //
            $addOnsky = 'where `userRep` = "' . $salseReport . '"';
        }// end if

        // set the cvs file data query.
        $query = 'select CONCAT(`firstName`, " ", `lastName`) as `name`,
                 `userCompany`,
                 `userPosition`,
                 `userEmail`,
                 `userRep`,
                 `regDate`,
                 `squareId`,
                 `state`
            from `userReg` 
            ' . $addOnsky . '
            order by `squareId` asc';

        // prepare and execute the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute();

        // set the data.
        $csvData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // set the header items on the csv file.
        $csvRawData[] = [
            'USER NAME',
            'COMPANY',
            'POSITION',
            'EMAIL',
            'REPRESENTATIVE',
            'REGISTRATION DATE',
            'STATE',
            'QUARTED/SQUARE'
        ];

        // set the data to the csv file.
        foreach ($csvData as $key => $custodians) {

            // set the data array.
            $csvRawData[] = [
                $csvData[$key]['name'],
                $csvData[$key]['userCompany'],
                $csvData[$key]['userPosition'],
                $csvData[$key]['userEmail'],
                $csvData[$key]['userRep'],
                $csvData[$key]['regDate'],
                $csvData[$key]['state'],
                isset($csvData[$key]['squareId']) === true ? $csvData[$key]['squareId'] : '',
            ];
        }// end foreach()

        /**
         * Open the php output.
         *
         * @param 'wb' - open and write a file as a binary file.
         */
        $fp = fopen('php://output', 'wb');

        /** @var $line - formatting the array to lines and columns for the .csv file. */
        foreach ($csvRawData as $line) {

            //
            fputcsv($fp, $line);
        }// end foreach()

        /** Closing the output. */
        fclose($fp);

        // close connection.
        exit();
    }// end csvDownload()
    // end region
}
