
<?php

class ipStack {

    // region private properties
    /**
     * @var string
     */
    private $userIP;
    // endregion

    // region class const
    const KEY = '';
    // endregion

    // region class methods
    /**
     * method construct
     */
    public function __construct() {

        // get user IP
        $this->userIP = $_SERVER['REMOTE_ADDR'];
    }// end __construct()

    /**
     * @return string
     */
    public function getUserLocation(): string {

        // initialize CURL
        $ipStackData = curl_init('https://api.ipstack.com/' . $this->userIP . '?access_key=' . self::KEY . '');

        // set curl options
        curl_setopt($ipStackData, CURLOPT_RETURNTRANSFER, true);

        // store the data
        $jsonReturn = curl_exec($ipStackData);

        // close CURL connect
        curl_close($ipStackData);

        // decode JSON response
        $userLocation = json_decode($jsonReturn, true);

        // set user location
        return $userLocation['city'] . ', ' . $userLocation['region_name'] . ', ' . $userLocation['continent_name'];
    }// end getUserLocation()

    /**
     * @return array
     */
    public function getUserLocationPlusCurrency(): array {

        // initialize CURL
        $ipStackData = curl_init('https://api.ipstack.com/' . $this->userIP . '?access_key=' . self::KEY . '');

        // set curl options
        curl_setopt($ipStackData, CURLOPT_RETURNTRANSFER, true);

        // store the data
        $jsonReturn = curl_exec($ipStackData);

        // close CURL connect
        curl_close($ipStackData);

        // set user location
        return json_decode($jsonReturn, true);
    }// end getUserLocationPlusCurrency()
    // endregion
}// end ipStack()
