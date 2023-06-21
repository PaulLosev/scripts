
// game logic class
// author: paullosev
class gameLogicClass {

    // region class methods
    // method construct
    constructor() {

        // set game play body container
        this.gamePlayBody = jQuery('.gamePlayContainer');

        // set parent container
        this.parentContainer = jQuery('.gameFormContainer');

        // set form items return container
        this.returnFormItem = this.parentContainer.find('div.gameFormBody');

        // set dots container
        this.dotsContainer = this.parentContainer.find('div.gameFormDotsContainer');

        // set submit button trigger
        this.nextButton = this.parentContainer.find('#formSubmit');

        // set return for edit button
        this.returnToEdit = this.parentContainer.find('#formEditButton');

        // set return html container
        this.returnPageContainer = jQuery('div.gamePlayPlayground');

        // set ruls container
        this.rules = jQuery('.gameRulesContainer');

        // save user php script location
        this.saveUserLocation = '/cup/misc/saveUser.php';

        // validate user email
        this.validateUserEmail = '/cup/misc/emailValidation.php';

        // result page ajax bridge
        this.resultsPageFile = '/cup/misc/resultPage.php';

        // get input data
        this.translateUI = '/cup/misc/inputArray.php';

        // get user currency + amount
        this.currencyAmount = '/cup/misc/currency.php';

        // get game options
        this.gameOptions = '/cup/misc/gameOptions.php';

        // get lang code
        this.lang = jQuery('html').attr('lang');

        // promo page wording
        this.promoPageWording = JSON.parse(this.translate('promo'))[0].wording;

        // set data set array
        this.dataSet = [];

        // set const
        this.regOpenValue = 1;

        // set form inputs array
        this.allInputs = JSON.parse(this.translate('input'));

        // get registration option
        this.regOption = this.options();

        // set reg wording
        this.regModeWording = this.translate('registration');
    }// end constructor()

    //
    setGameLogic() {

        // debug methods
        /***************
         * USAGE
         * in order to tweak / debug methods
         * 1. uncomment page method
         * 2. uncomment die method (return false)
         *
         * After debug is done, comment all lines
         */
        // gameLogicSet.returnPageContainer.html(this.formPage()).fadeIn('slow');
        // gameLogicSet.returnPageContainer.html(this.promoPage()).fadeIn('slow');
        // gameLogicSet.returnPageContainer.html(this.resultsPageLogic(jQuery.cookie('EID')));

        //
        // return false;

        // set language module
        this.langModule();

        // set rules brand + currency options
        this.rulesCurrencyandBrand();

        // set reg options
        if (parseInt(this.regOption) === this.regOpenValue) {

            // enforce focus on play button click
            jQuery('#formInput').focus();

            // set UID form cookie
            let userCookieID = jQuery.cookie('EID');

            // track cookie
            userCookieID !== undefined
                ? console.log('%c returning user', 'color: green')
                : console.log('%c new player', 'color: green');

            // set results page (last)
            // set default page (title)
            userCookieID !== undefined
                ? gameLogicSet.returnPageContainer.html(gameLogicSet.callResults(userCookieID, this.lang))
                : this.returnPageContainer.html(this.firstPage());

            // set play button
            let playButton = jQuery(this.returnPageContainer).find('.playButton');

            //
            playButton.on({

                // set event
                click: function () {

                    // set fade effect
                    gameLogicSet.returnPageContainer.delay(300).hide();

                    // return form container
                    gameLogicSet.returnPageContainer.html(gameLogicSet.formPage()).fadeIn('slow');
                }// end click()
            })// end on()
        } else {

            // call registration close method
            gameLogicSet.returnPageContainer.html(this.regClosed()).fadeIn('slow');
        }// end if
    }// end setGameLogic()

    // title page html + data
    firstPage() {

        // set parent container
        let parentContainer = document.createElement('div');

        // set first child container
        let firstChild = document. createElement('div');

        // set last child container
        let lastChild = document.createElement('div');

        // set image container
        let playButton = document.createElement('img');

        // set parent class
        parentContainer.className = 'titlePageContainer';

        // set first child class
        firstChild.className = 'gameFormSubmitButtonContainer';

        // set image params
        playButton.src = '/cup/images/Desktop/Screen%201/btn_play.png';
        playButton.alt = 'Play';

        // set image into last child container
        lastChild.appendChild(playButton);

        // append last child into child container
        firstChild.append(lastChild);

        // set last child class
        lastChild.className = 'playButton';

        // build page
        parentContainer.append(firstChild);

        // set title page html
        return parentContainer;
    }// end firstPage()

    // form page
    formPage() {

        // set parent container
        let parentContainer = document.createElement('div');
        // set parent container class
        parentContainer.className = 'gameFormContainer';

        // set first child
        let firstChild = document.createElement('div');
        firstChild.className = 'gameFormBody';

        // set second child
        let secondChild = document.createElement('div');
        secondChild.className = 'gameFormControlsContainer';

        // set inner children
        let innerFirst = document.createElement('div');
        innerFirst.className = 'gameFormControlReturnContainer';
        let innerFirstChild = document.createElement('div');
        innerFirstChild.id = 'formEditButton';
        innerFirst.append(innerFirstChild);
        let innerSecond = document.createElement('div');
        innerSecond.className = 'gameFormDotsContainer';
        let innerLast = document.createElement('div');
        innerLast.id = 'formSubmit';

        // connect javaScript class
        let classConnect = document.createElement('script');
        classConnect.src = '/cup/js/formLogic.js';
        classConnect.type = 'text/javascript';

        // set second child's children
        secondChild.append(innerFirst, innerSecond, innerLast);

        // set blocks
        // connect javaScript Class
        parentContainer.append(firstChild, secondChild, classConnect);

        // build page
        return parentContainer;
    }// end formPage()

    // promo page
    promoPage() {

        // set parent container
        let parentContainer = document.createElement('div');
        // set parent container class
        parentContainer.className = 'titlePageContainer';

        // set first child container
        let firstChild = document.createElement('div');
        let firstDataSet = document.createElement('p');
        let textContent = document.createTextNode(this.promoPageWording);
        // set second child container class + data
        firstChild.className = 'promoBoxContainer';
        firstDataSet.append(textContent);
        firstChild.append(firstDataSet);

        // set second child
        let secondChild = document.createElement('div');
        let secondDataSet = document.createElement('div');
        let imageData = document.createElement('img');
        // set second child container class + data
        secondChild.className = 'gameFormSubmitButtonContainer';
        secondDataSet.className = 'playButton';
        // set image params
        imageData.src = '/cup/images/Desktop/Screen%203/btn_done.png';
        imageData.alt = 'Done';
        secondDataSet.append(imageData);
        secondChild.append(secondDataSet);

        // append children
        parentContainer.append(firstChild, secondChild);

        // build page
        return parentContainer;
    }// end

    // lang module
    langModule() {

        // get current lang code
        let langCode = jQuery('html').attr('lang');

        // module parent container
        let parentContainer = document.createElement('div');
        parentContainer.className = 'languageModuleContainer';
        // set lang code to the lang container
        let langModeTrigger = document.createElement('div');
        langModeTrigger.className = 'langModeTrigger';
        langModeTrigger.append(langCode);
        // set lang module
        let langModuleBody = document.createElement('div');
        langModuleBody.className = 'langModuleBody';

        // set translational menu items
        jQuery(langModuleBody).html(this.translate('langCodes'));

        // build module
        parentContainer.append(langModeTrigger, langModuleBody);

        // set action
        jQuery(langModeTrigger).on({
            click: function() {
                jQuery(langModuleBody).toggle('drop', {direction: 'right'}, 'fast');
            }// end click()
        })// end On{}

        // set module
        this.gamePlayBody.prepend(parentContainer);
    }// end langModule()

    // result page
    resultsPageLogic(UID, lang) {

        // set play button
        let playButton = jQuery(this.returnPageContainer).find('.playButton');

        //
        playButton.on({

            // set results page
            click: function() {

                // set fade effect
                gameLogicSet.returnPageContainer.delay(300).hide();

                // set results
                gameLogicSet.returnPageContainer.html(gameLogicSet.callResults(UID, lang), gameLogicSet.lang).fadeIn('slow');
            }// end click
        })// end On()
    }// end resultsPageLogic()

    // promo page
    regClosed() {

        // set parent container
        let parentContainer = document.createElement('div');
        // set parent container class
        parentContainer.className = 'titlePageContainer';

        // set first child container
        let firstChild = document.createElement('div');
        // set second child container class + data
        firstChild.className = 'promoBoxContainer';
        jQuery(firstChild).html(this.regModeWording);

        // append children
        parentContainer.append(firstChild);

        // build page
        return parentContainer;
    }// end regClose()

    // set results for UID
    callResults(UID, lang) {

        // set ajax
        return jQuery.ajax({
                        url: this.resultsPageFile,
                       type: 'post',
                       data: {
                            ID: UID,
                            lang: lang,
                       },
                      async: false,
               }).responseText;
    }// end callResults()

    // system translate
    // depends on PHP class gameTranslate
    translate(type) {

        // get translated
        return jQuery.ajax({
            url: this.translateUI,
            type: 'post',
            async: false,
            data: {
                lang: this.lang,
                type: type
            }
        }).responseText;
    }// end translate()

    // system options
    // depends on PHP class gameSettings
    options() {

        // get translated
        return jQuery.ajax({
            url: this.gameOptions,
            type: 'post',
            async: false,
        }).responseText;
    }// end options()

    // set user geolocation data
    rulesCurrencyandBrand() {

        // get rules currency + brand containers
        let containers = jQuery(this.rules).find('span#dataRules');

        // set band
        let uriLink = new URL(window.location.href);
        // get current brand
        let brandData = uriLink.searchParams.get('brand');

        // get mobile containers
        let rulesDesctop = jQuery('.gameRulesContainer').html();

        // set mobile rules container
        let mobileRules = jQuery('.rulesBodyMobile');

        // return ruls to mobile version
        mobileRules.html(rulesDesctop);

        // get mobile containers
        let mobileContainers = jQuery('.rulesBodyMobile').find('span#dataRules');

        // cast band
        let brand = brandData !== null
            ? brandData
            : 'TransPerfect';

        // get user currency + amounts
        let stackData = JSON.parse(jQuery.ajax({url: this.currencyAmount, type: 'post', async: false}).responseText);

        // return prizes
        jQuery(containers).each(function(num, object) {

            // desctop
            jQuery(object).text(stackData[num]);
            // mobile
            jQuery(mobileContainers[num]).text(stackData[num]);
        })// end each()

        // set brand to the UI
        jQuery(containers[2]).text(brand);
        // set brand to the mobile UI
        jQuery(mobileContainers[2]).text(brand);
    }// end rulesCurrencyandBrand()
    // endregion
}// end gameLogicClass{}

// set game logic class instance
let gameLogicSet = new gameLogicClass();

// call logic
gameLogicSet.setGameLogic();

// mobile rules parent
var mobileRulesParent = jQuery('.rulesOnMobile');

// set rules trigger
var mobileRulesTrigger = mobileRulesParent.find('.mobileRulesTrigger');

// set close popup button
var closePopup = mobileRulesParent.find('.gameRulsCloseMobileContainer');

// set popup container
var popupContainer = mobileRulesParent.find('.gameRulesContainerMobile');

// set action
mobileRulesTrigger.on({

    // set action
    click: function() {

        // show rules popup
        popupContainer.show('drop', {direction: 'top'}, 'fast');
    }// end click
})// end On()

// set close modal action
closePopup.on({

    // set action
    click: function() {

        // close rules popup
        popupContainer.hide('drop', {direction: 'top'}, 'fast');
    }// end click()
})// end On90
