
<?php

/**
 * Class gamePromotion
 */
class gamePromotion
{
    // region private properties
    /**
     * @var $mDb MArinaDB Connect.
     */
    private $mDb;
    // endregion

    // region const
    const PROMO_BLOCKS_LIMIT = 1;
    // endregion

    // region private / public methods.
    /**
     * gamePromotion constructor.
     * @param $mDb the MArinaDB connect.
     */
    public function __construct($mDb)
    {
        $this->mDb = $mDb;
    }// end construct()

    /**
     * Method returns all promotional blocks.
     */
    public function populatePormo()
    {
        // set the query.
        $query = 'select *
                    from `gamePromotion` 
                    limit ' . self::PROMO_BLOCKS_LIMIT;

        // prepare and execute the query.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute();

        // return the data.
        while ($promoData = $stmt->fetch(PDO::FETCH_ASSOC)) {

            // set link
            $link = empty($promoData['uri']) === false
                ? '<a href="' . $promoData['uri'] . '" target="_blank">'
                : '';

            // set html.
            echo $link . '<div class="promotionalBlockContainerInnerBody">
                      
                            ' . $promoData['promotionBody'] . ' 
                          </div>
                  </a>' . PHP_EOL;
        }// end while()
    }// end populatePormo()

    /**
     * Method retuns array with countires.
     */
    public function setTPstates()
    {
        // set the TP states.
        $query = 'select `abvr`, 
                         `name`
                    from `countries`';

        // run and set the countries.
        $stmt = $this->mDb->prepare($query);
        $stmt->execute();

        // return the data.
        $countries = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // set the TP states.
        foreach ($countries as $state) {

            // set html.
            echo '<option value="' . $state['abvr'] . '">' . $state['name'] . '</option>' . PHP_EOL;
        }// end foreach()
    }// end setTPstates()

    /**
     * Method sets the footer html.
     */
    public function setFooterData()
    {
        // set the html.
        echo '<div class="firstFooterContiner">
                                    
                    <!-- footer last line container -->                
                    <P class="lastLineOnTheHeader">

                        TransPerfect Super Squares is in no way affiliated with or endorsed by the
                        National Football League.<br />TRANSPERFECT &#x00a9; ' . date("Y") . '
                    </P>';
    }// end setFooterData()
    // end region.
}
