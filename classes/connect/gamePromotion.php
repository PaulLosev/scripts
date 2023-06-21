<?php


class gamePromotion
{
    // region private properties
    /**
     * @var the MArinaDB Connect.
     */
    private $mDb;
    // endregion

    // region const
    // endregion

    // region private / public methods.
    public function __construct($mDb)
    {
        $this->mDb = $mDb;
    }// end construct()

    // end region.

}