
<?php

/**
 * Class cvsDownload
 */
class csvReport {

    // region private properties
    // endregion

    // region const
    const USER_TABLE = 'cupGameUsers';

    // report options
    const GLOBAL_REPORT = 'global';
    // endregion

    // region class methods
    /**
     * @return PDO
     */
    public function getConnected(): PDO {

        // clients game
        return new PDO('mysql:host=tpt-web4-db;dbname=promo', 'promo', 'c,wiejF83V.3');
    }// end getConnected()

    /**
     * @param null $option
     * @return array|false
     */
    public function getReportData($option = null) {
        echo $option;
        // set vars
        $individual = '';

        // see if the salse report requested
        empty($option) === false
            // set report for representative
            ? $individual = 'where `inviter` = "' . $option . '"'
            : '';

        // set the cvs file data query.
        $query = 'select CONCAT(`firstName`, " ", `lastName`) as `name`,
                 `company`,
                 `country`,
                 `email`,
                 `favTeam`,
                 `inviter`,
                 `location`,
                 `date`,
                 `team1`,
                 `team2`,
                 `team3`,
                 `team4`, 
                 `brand`
            from `' . self::USER_TABLE . '` 
                  ' . $individual . '
            order by `id` asc';

        // prepare and execute the query.
        $stmt = $this->getConnected()->prepare($query);
        $stmt->execute();

        // set the data.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }// end getReportData()

    /**
     * generate csv by get request
     */
    public function csvDownload($get) {

        // get data
        $this->generateCSV(
            $get['report'] === self::GLOBAL_REPORT
                ? $this->getReportData('')
                : $this->getReportData($get['report']),
            $get
        );

        // exit script
        exit();
    }// end csvDownload()

    /**
     * generate csv by reset method
     */
    public function getBeforeReset() {

        // get data
        $this->generateCSV(
            $this->getReportData(''),
            ''
        );
    }// end getBeforeReset{}

    /**
     * @param $csvData
     * @param $get
     */
    public function generateCSV($csvData, $get) {

        // cast report name
        $report = empty($get['report']) === false
            ? $get['report']
            : 'reset_method_global_';

        // set the header items on the csv file.
        $csvRawData[] = [
            'USER NAME',
            'COMPANY',
            'COUNTRY',
            'EMAIL',
            'FAVORITE TEAM',
            'INVITER',
            'LOCATION',
            'DATE SUBMITTED',
            'TEAM 1',
            'TEAM 2',
            'TEAN 3',
            'CUP TEAM',
            'BRAND',
        ];

        // set the data to the csv file.
        foreach ($csvData as $key => $data) {

            // set the data array.
            $csvRawData[] = [
                $csvData[$key]['name'],
                $csvData[$key]['company'],
                $csvData[$key]['country'],
                $csvData[$key]['email'],
                $csvData[$key]['favTeam'],
                $csvData[$key]['inviter'],
                $csvData[$key]['location'],
                $csvData[$key]['date'],
                ucfirst($csvData[$key]['team1']),
                ucfirst($csvData[$key]['team2']),
                ucfirst($csvData[$key]['team3']),
                ucfirst($csvData[$key]['team4']),
                $csvData[$key]['brand'],
            ];
        }// end foreach()

        // set the headers.
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="cup_game_sales_report_requested_on_' . date('m_d_Y') . '_for_' . $report . '_game_option.csv"');

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
    }// end generateCSV()
    // endregion
}// end csvReport()
