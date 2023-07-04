<?php

// namespace
namespace admin\classes;
/**
 * class html
 */
class html {
    // region class properties
    const TITLE_HEADLINE = 'Admin';
    // endregion
    // region class const
    // endregion
    /**
     * method sets the html for the project
     * head
     * @return void
     *
     */
    public function projectHead() {
        // return project head
        echo '<!DOCTYPE html>
                    <html lang="en">
                        <head>
                            <title>' . self::TITLE_HEADLINE . '</title>
                            <meta charset="UTF-8">
                            <meta name="description" content="" />
                            <meta name="author" content="TP, MarComm, Paul Losev">
                            <meta name="robots" content="noindex" />
                            <meta name="googlebot" content="noindex" />
                            <meta name="googlebot-news" content="nosnippet">
                            <meta name="viewport" content="width=device-width, initial-scale=.6, maximum-scale=.6, user-scalable=1" />
                            <link rel="icon" type="image/png" href="/img/favicon.ico" />
                            <meta property="og:image" content="" />
                            <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;600;700&display=swap" rel="stylesheet">
                            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
                            <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,500;0,600;0,700;1,500;1,600;1,700&display=swap" rel="stylesheet">
                            <link href="/trivia/admin/css/triviaGameAdmin.css?' . time(). '" rel="stylesheet">
                            <!-- <link href="/trivia/css/mobileVersion.css?' . time(). '" rel="stylesheet"> -->
                            <script type="text/javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>
                            <script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
                            <script src="/trivia/js/functionality.js?' . time(). '"></script>
                        </head>
                        <body>
                        <div id="projectReturnContainer">';
        // endregion
    }// end projectHead()
    /**
     * method sets the html for the project
     * footer
     * @return void
     */
    public function projectFooter() {
        // return project footer
        echo '</div>
                </body>                            
                <script src="/trivia/js/modules.js?' . time(). '"></script>
              </html>' . PHP_EOL;
        // endregion
    }// end projectFooter()
    // region class methods
}// end html()
