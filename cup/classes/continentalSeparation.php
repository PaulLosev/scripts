<?php

class continentalSeparation {

    // region private properties
    // endregion

    // region class const
    // endregion

    // region class methods

    /**
     * @param string $continent
     * @param string $currency
     * @return string[]
     */
    public function setDataToThreeContinents(string $continent, string $currency): array {

        // return data
        if ($continent === 'US') {

            // return array
            return [$currency . 25, $currency . 75];
        } else if ($continent === 'EU') {

            // return array
            return [$currency . 30, $currency . 80];
        } else if ($continent === 'UK') {

            // return array
            return [$currency . 35, $currency . 85];
        } else {

            // return array
            return [$currency . 25, $currency . 75];
        }// end if
    }// end setDataToThreeContinents()

    /**
     * @return mixed|string
     */
    public function getBrand() {

        // get brand
        return empty($_GET['brand']) === false
            ? $_GET['brand']
            : 'TransPerfect';
    }// end getBrand()

    /**
     * return data with continent' currency and money
     */
    public function setRulesWithContinental() {

        // connect translation class
        require_once $_SERVER['DOCUMENT_ROOT'] . 'cup/classes/gameTranslate.php';
        // set the class instance
        $translate = new gameTranslate();


        // set lang code
        $langCode = empty($_GET['lang']) === false
            ? $_GET['lang']
            : 'en';

        // return rules container
        // translate page
        $translate->translate([
            'type' =>'rules',
            'lang' => $langCode,
        ]);
    }// end setRulesWithContinental()

    /**
     * @return string
     */
    public function setDefaulLangCode():string {

        // return lang code
        return empty($_GET['lang']) === false
            ? $_GET['lang']
            : 'en';
    }// end setDefaulLangCode()

    /**
     * @return array data set
     */
    public function getUserContinentCurrency() {

        // connect ipStack class
        require_once $_SERVER['DOCUMENT_ROOT'] . 'cup/classes/ipStack.php';
        // set class instance
        $getContinent = new ipStack();

        // get user continet
        $continent = $getContinent->getUserLocationPlusCurrency()['country_code'];

        // get user currency sign
        $currency = $getContinent->getUserLocationPlusCurrency()['currency']['symbol'];

        // get amounts
        print_r(
            json_encode(
                $this->setDataToThreeContinents($continent, $currency)
            )
        );
    }// end getUserContinentCurrecnty()
    // endregion
}// end continentalSeparation{}
