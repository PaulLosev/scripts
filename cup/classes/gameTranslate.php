<?php

class gameTranslate {

    // region private properties
    // endregion

    // region class const
    const INPUT_TABLE = 'cupInputArray';
    const EMAIL_TRANSLATE = 'cupEmailTranslate';
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
     * @param $post
     * @return array|false|void
     */
    public function translate($post) {

        // set type
        $type = $post['type'];
        // set lang code
        $langCode = $post['lang'];

        // set mod translations
        switch ($type) {
            case 'input':
                $this->setInputs($langCode);
                break;
            case 'langCodes':
                $this->setLangCodes();
                break;
            case 'emailValidation':
                $this->getEmailWording($langCode);
                break;
            case 'hint':
                $this->translateHints($langCode);
                break;
            case 'promo':
                $this->promoWording($langCode);
                break;
            case 'final':
                $this->finalPage($langCode);
                break;
            case 'rules':
                $this->setRules($langCode);
                break;
            case 'registration':
                $this->registration($langCode);
                break;
            case 'emailTranslate':
                return $this->emailTranslate($langCode);
        }// end switch{}
    }// end translate()

    /**
     * @param $langCode
     */
    public function setInputs($langCode) {

        // set data arrau
        $returnData = [];

        // query
        $query = 'select `firstName`,
                         `lastName`,
                         `email`,
                         `company`, 
                         `country`,
                         `favTeam`,
                         `invite`
                    from `' . self::INPUT_TABLE . '`
                   where `lang` = :lang';

        // prepare and run the query
        $stmt = $this->getConnected()->prepare($query);
        $stmt->execute([':lang' => $langCode]);

        // set input values
        foreach($stmt->fetch(PDO::FETCH_ASSOC) as $key => $value) {
            // set keys and values
            $returnData[] = [
                'name' => $value,
                'field' => $key,
            ];
        }// end foreach{}

        // return input's data
        print_r(json_encode($returnData));
    }// end setInputs()

    public function getEmailWording($langCode) {

        // set data arrau
        $returnData = [];

        // query
        $query = 'select `emailValOne`,
                         `emailValTwo`
                    from `' . self::INPUT_TABLE . '`
                   where `lang` = :lang';

        // prepare and run the query
        $stmt = $this->getConnected()->prepare($query);
        $stmt->execute([':lang' => $langCode]);

        // set input values
        foreach($stmt->fetch(PDO::FETCH_ASSOC) as $value) {
            // set keys and values
            $returnData[] = [
                'wording' => $value
            ];
        }// end foreach{}

        // return input's data
        print_r(json_encode($returnData));
    }// end getEmailWording()

    /**
     * Method sets all langs that in the translational table
     */
    public function setLangCodes() {

        // query
        $query = 'select `lang`
                    from  `' . self::INPUT_TABLE . '`';

        // prepare and run the query
        $stmt = $this->getConnected()->prepare($query);
        $stmt->execute();

        // return HTML
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $value) {

            // lang code
            $langCode = $value['lang'] !== 'en'
                ? $value['lang']
                : '';

            // set html menu
            echo '<p>
                    <a href="./' . $langCode . '">' . strtoupper($value['lang']). '</a>
                  </p>' . PHP_EOL;
        }// edn foreach{}
    }// end setLangCodes()

    /**
     * @param $langCode
     */
    public function translateHints($langCode) {

        // set data arrau
        $returnData = [];

        // query
        $query = 'select `hintOne`,
                         `hintTwo`
                    from `' . self::INPUT_TABLE . '`
                   where `lang` = :lang';

        // prepare and run the query
        $stmt = $this->getConnected()->prepare($query);
        $stmt->execute([':lang' => $langCode]);

        // set input values
        foreach($stmt->fetch(PDO::FETCH_ASSOC) as $value) {
            // set keys and values
            $returnData[] = [
                'wording' => $value
            ];
        }// end foreach{}

        // return input's data
        print_r(json_encode($returnData));
    }// end translateHints()

    /**
     * @param $langCode
     */
    public function promoWording($langCode) {

        // set data arrau
        $returnData = [];

        // query
        $query = 'select `promotion`
                    from `' . self::INPUT_TABLE . '`
                   where `lang` = :lang';

        // prepare and run the query
        $stmt = $this->getConnected()->prepare($query);
        $stmt->execute([':lang' => $langCode]);

        // set input values
        foreach($stmt->fetch(PDO::FETCH_ASSOC) as $value) {
            // set keys and values
            $returnData[] = [
                'wording' => $value
            ];
        }// end foreach{}

        // return input's data
        print_r(json_encode($returnData));
    }// end promoWording()

    /**
     * @param $langCode
     */
    public function finalPage($langCode) {

        // query
        $query = 'select `finalPage`
                    from `' . self::INPUT_TABLE . '`
                   where `lang` = :lang';

        // prepare and run the query
        $stmt = $this->getConnected()->prepare($query);
        $stmt->execute([':lang' => $langCode]);

        // return input's data
        echo $stmt->fetch(PDO::FETCH_ASSOC)['finalPage'];
    }// end finalPage()

    /**
     * @param $langCode
     */
    public function setRules($langCode) {

        // query
        $query = 'select `rules`
                    from `' . self::INPUT_TABLE . '`
                   where `lang` = :lang';

        // prepare and run the query
        $stmt = $this->getConnected()->prepare($query);
        $stmt->execute([':lang' => $langCode]);

        // return input's data
        echo $stmt->fetch(PDO::FETCH_ASSOC)['rules'];
    }// end finalPage()

    /**
     * @param $langCode
     */
    public function registration($langCode) {

        // query
        $query = 'select `regMode`
                    from `' . self::INPUT_TABLE . '`
                   where `lang` = :lang';

        // prepare and run the query
        $stmt = $this->getConnected()->prepare($query);
        $stmt->execute([':lang' => $langCode]);

        // return input's data
        echo $stmt->fetch(PDO::FETCH_ASSOC)['regMode'];
    }// end promoWording()

    /**
     * @param $langCode
     * @return array|false
     */
    public function emailTranslate($langCode) {

        // set en lang as a default
        $langCode = empty($langCode) === false
            ? $langCode
            : 'en';

        // query
        $query = 'select * 
                    from `' . self::EMAIL_TRANSLATE . '`
                   where `lang` = :lang';

        // prepare and run the query
        $stmt = $this->getConnected()->prepare($query);
        $stmt->execute([':lang' => $langCode]);

        // return input's data
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }// end emailTranslate()
    // endregion
}// end gameTranslate{}