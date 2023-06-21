<?php

class gameSettings {
    // region class propeties
    // endregion

    // region class const
    const SETTINGS_TABLE = 'cupGameSettings';
    const USER_TABLE = 'cupGameUsers';
    const REG_OPTION = 1;
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
     * Get registration option
     * 0: registration closed
     * 1: registration open
     */
    public function getRegMode() {

        // set query
        $query = 'select `option` 
                    from `' . self::SETTINGS_TABLE . '`
                   where `id` = :id';

        // prepare and run the query
        $stmt = $this->getConnected()->prepare($query);
        $stmt->execute([':id' => self::REG_OPTION]);

        // return value
        echo (int) $stmt->fetch(PDO::FETCH_ASSOC)['option'];
    }// end getRegMode()

    /**
     * @param $get
     */
    public function callRegSettings($get) {

        // close/open reg
        if (empty($get['option']) === false) {
            // set game options
            switch ($get['option']) {
                case 'close':
                case 'open':
                    $this->closeOpen($get['option']);
                    break;
                case 'reset':
                    $this->resetGame();
                    break;
            }// end switch{}
        }// end if
    }// end callRegSettings{}

    /**
     * @param $option
     */
    public function closeOpen($option) {

        // query
        $query = 'update `' . self::SETTINGS_TABLE . '`
                     set `option` = :option
                   where `id` = :id';

        // set params
        $status = $option === 'close' ? 0 : 1;

        // query params
        $params = [
            ':option' => $status,
            ':id' => self::REG_OPTION,
        ];

        // preare and run the query
        $stmt = $this->getConnected()->prepare($query);
        $stmt->execute($params);
    }// end closeOpen{}

    /**
     * Truncate user table
     */
    public function resetGame() {

        // set class csv report instance
        $csv = new csvReport();
        // retunr fill report
        $csv->getBeforeReset();

        // query
        $query = 'TRUNCATE TABLE `' . self::USER_TABLE . '`';
        // prepare and run the query
        $stmt = $this->getConnected()->prepare($query);
        $stmt->execute();

        // exit the script
        exit();
    }// end resetGame()
    // endregion
}// end gameSettings{}
