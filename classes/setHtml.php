
<?php

/**
 * Class setHtml
 */
class setHtml
{
    // region private / public methods
    /**
     * Method sets the cms header.
     */
    public function setHeader($option = null) {

        // cast option
        $option = str_replace('?', '', $option);

        // set clients category
        $option = empty($option) === true
            ? 'clients'
            : $option;

        // set the header html.
        echo '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <title>losev CMS</title>
                    <meta name="author" content="Paul2Paul">
                    <meta charset="UTF-8">
                    <meta name="robots" content="noindex" />
                    <meta name="googlebot" content="noindex" />
                    <meta name="googlebot-news" content="nosnippet">
                    <meta name="viewport" content="width=device-width, initial-scale=.6, maximum-scale=.6, user-scalable=0" />
                    <link rel="icon" type="image/png" href="/img/favicon.ico" />
                    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;600;700&display=swap" rel="stylesheet">
                    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
                    <link href="/admin/css/admin.css?' . time() . '" rel="stylesheet">
                    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
                    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
                    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
                    <script src="/admin/js/jquery.shining.js"></script>
                    <script src="/admin/js/losevJSAdmin.js?' .time() . '"></script>
                </head>
                    <body>
                        <div class="wpapper">
                            <div class="dbTracker">' . ucfirst($option) .' game</div>
                            <div class="letterDecoration">

                                LOSEV CMS
                            </div>
                        <div class="headerContainer">
                            <div class="spinnerContainer">
                                <img src="/img/spinner.svg" class="actualSystemSpinner" />
                            </div>
                            <div class="functionComplete">
                                <div class="notificationBody greenConfirm">
                                    SAVED
                                </div>
                            </div>
                        </div>' . PHP_EOL;
    }// end setHeader()

    /**
     * Method sets the footer html.
     */
    public function setFooter() {

        // set the footer html.
        echo '<div class="footer">
               
            </div>
        </div>
    </body>
</html>' . PHP_EOL;
    }// sen setFooter()
    // endregion
}
