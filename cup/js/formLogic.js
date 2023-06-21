
// form logic class
// author: paullosev
class formLogicClass
    extends gameLogicClass {

    // region class methods
    // method sets form logic
    setForm() {

        // set dots to all inputs
        this.setDotsContainers();

        // call for logic
        this.setFormLogic();
    }// end setForm()

    // method build form
    setFormLogic() {

        // key controls method
        this.setKeys();

        // set button logic
        this.nextButton.on({

            // set event
            click: function() {

                // set current input value
                let currentValue = jQuery('#formInput');

                // set form count
                let formInputCount = parseInt(currentValue.attr('count'));

                // set validation + prevent space entries
                currentValue.val().trim() !== ''
                    ? formLogicSet.addItem(formInputCount, currentValue.val())
                    : formLogicSet.showError(currentValue);
            }// end click()
        })// end on()

        // set edit form logic
        this.returnToEdit.on({

            // set edit action
            click: function() {

                // set all filled out inputs
                let formInputCount = parseInt(jQuery('#formInput').attr('count')) - 1;

                // show return button
                formInputCount === 0
                    ? formLogicSet.returnToEdit.hide('fade', 'fast')
                    : false;

                // populate previous input + value
                formLogicSet.stepBack(formInputCount);
            }// end click()
        })// end On()
    }// end setFormItems()

    // set UI HTML
    setDotsContainers() {

        // set dots array
        var dotsArray = [];

        // set first input by default
        jQuery(formLogicSet.returnFormItem).html(formLogicSet.setInputBody(0));

        // unset rep key from array if representative token is in uri
        this.allInputs = this.setRepresentative(this.allInputs);

        // set dots
        jQuery(this.allInputs).each(function() {

            // set dot item
            var dotItem = '<div class="formItemsListing"><p></p></div>\n';

            // set dots containers
            dotsArray.push(dotItem);
        })// end each()

        // return html with dots
        jQuery(this.dotsContainer).html(dotsArray);
    }// end setDots()

    // set keyboard controls
    setKeys() {

        // set key control hint
        formLogicSet.setKeyControlsHint();

        // set events
        document.addEventListener('keydown', (event) => {

            // set current input value
            let input = jQuery('#formInput');

            // Enter as sumit
            if (event.code === 'Tab') {

                // call key control function
                formLogicSet.keyControls(event, '#formSubmit', input);
            } else if (event.code === 'Escape') {

                // set current input count
                let inputCount = input.attr('count');

                // prevent tab on 0
                inputCount > 0
                    // call key control function
                    ? formLogicSet.keyControls(event, '#formEditButton', input)
                    : false;
            }// end if
        })// end addEventListener()
    }// end setKeys()

    // method adds up an iem to the form or class save method
    addItem(num, value) {

        // add active class on the current dot
        jQuery(this.dotsContainer.children()[num]).find('p').addClass('innerActive').effect('fade', 200);

        // validate values in the array
        this.dataSet[num] === ''
            // add value to data array
            ? this.dataSet.push(value)
            // replace value to data array
            : this.dataSet[num] = value;

        // set total of all items
        let totalItems = this.allInputs.length;
        let totalInArray = this.dataSet.length;

        // next / save methods options
        totalInArray !== totalItems
            ? this.setNextInput(num)
            : this.callSaveMethod();
    }// end addItem()

    // step back on the form + set previous value
    stepBack(num) {

        // add active class on the current dot
        jQuery(this.dotsContainer.children()[num]).find('p').removeClass('innerActive').effect('fade', 200);

        // set next input + effect
        jQuery(formLogicSet.returnFormItem).effect('puff', 'fast', function () {
            jQuery(this).html(formLogicSet.setInputEdit(num));
        }).fadeIn('fast');
    }// end step back

    // set only input + value
    setInputEdit(num) {

        // set return validation value is true
        let emailValidationValue = formLogicSet.allInputs[num].field === 'email'
            ? 'valid="true"'
            : '';

        // return item with data
        return '<div class="validationError" ' + emailValidationValue + '></div>\n' +
               '<input type="text"\n' +
                      'name="' + formLogicSet.allInputs[num].field + '"\n' +
                      'placeholder="' + formLogicSet.allInputs[num].name + '"\n' +
                      'count="' + num + '" id="formInput"' +
                      'value="' + formLogicSet.dataSet[num] + '" />\n' +
                      '<script>formLogicSet.setAutoFocus(jQuery("#formInput"))</script>';
    }// end setInputEdit()

    // method sets next item on the form
    setNextInput(num) {

        // set next input + effect
        jQuery(formLogicSet.returnFormItem).effect('puff', 'fast', function () {

            jQuery(this).html(formLogicSet.setInputBody(num + 1));
        }).fadeIn('fast');

        // show return button
        num + 1 !== 0
            ? formLogicSet.returnToEdit.show('fade', 'fast')
            : false;
    }// end setNextInput()

    // set input html with data
    setInputBody(num) {

        // unset representative if representative token in uri
        this.allInputs = this.setRepresentative(this.allInputs);

        // set value if array has it
        let value = this.dataSet[num] !== undefined
            ? 'value="' + this.dataSet[num] + '"'
            : '';

        // validate email
        // return item with data
        return formLogicSet.allInputs[num].field === 'email'
            ? this.emailValidationOption(num, value)
            : '<input type="text"\n' +
                     'name="' + formLogicSet.allInputs[num].field + '"\n' +
                     'placeholder="' + formLogicSet.allInputs[num].name + '"\n' +
                     'count="' + num + '" ' + value + ' id="formInput" />\n' +
                     '<script>formLogicSet.setAutoFocus(jQuery("#formInput"))</script>';
    }// end setInputBody()

    // email validation option
    emailValidationOption(num, value) {

        // set email validation
        return '<div class="validationError"></div>\n' +
            '<input type="text"\n' +
            'name="' + formLogicSet.allInputs[num].field + '"\n' +
            'placeholder="' + formLogicSet.allInputs[num].name + '"\n' +
            'count="' + num + '" ' + value + ' id="formInput"\n' +
            'onkeyup="formLogicSet.validateEmail(this)" />\n' +
            '<script>formLogicSet.setAutoFocus(jQuery("#formInput"))</script>';
    }// end emailValidationOption()

    // unset representative if representative token in uri
    setRepresentative(data) {

        // filer out invite key
        if (this.getRepValue() !== '') {

            // if rep email token is set
            return jQuery(data).filter((element, index) => {

                // filter out invite key
                return index.field !== 'invite'
            })// end filter
        }// end if

        // return updated array
        return data;
    }// end setRepresentative()

    // get rep value form url
    getRepValue() {

        // get absolute url
        let absoluteUrl = new URL(document.location);

        // set rep value
        return absoluteUrl.searchParams.get('email') !== null
             ? absoluteUrl.searchParams.get('email')
             : '';
    }// end getRepValue()

    // get brand
    getBrand() {

        // get absolute url
        let absoluteUrl = new URL(document.location);

        // set rep value
        return absoluteUrl.searchParams.get('brand') !== null
            ? absoluteUrl.searchParams.get('brand')
            : 'TransPerfect';
    }// end getBrand()

    // save method
    callSaveMethod() {

        // set animation
        jQuery(gameLogicSet.returnPageContainer).delay(300).hide();

        // check if rep token is set
        this.getRepValue() !== ''
            ? this.dataSet.push(this.getRepValue())
            : '';

        // push brand value
        this.dataSet.push(this.getBrand());
        this.dataSet.push(this.lang);

        // save user data + set cookie
        this.saveDataSet(this.dataSet, 'save').trim() === 'saved'
            ? jQuery.cookie('EID', this.dataSet[2], {expires : 120})
            : this.saveDataSet(this.dataSet);

        // set promo page
        jQuery(gameLogicSet.returnPageContainer).html(gameLogicSet.promoPage()).fadeIn('fast');

        // call final results page
        this.resultsPageLogic(this.dataSet[2], gameLogicSet.lang);
    }// end callSaveMethod()

    // move data to the backend
    saveDataSet(data, option) {

        // set options
        let givenOption = option === 'save'
            ? this.saveUserLocation
            : this.validateUserEmail

        // set ajax
        return jQuery.ajax({
                        url: givenOption,
                       type: 'post',
                       data: {data},
                      async: false,
               }).responseText;
    }// end saveDataSet()

    // email validation method
    validateEmail(value) {

        // email validation error container
        let emailValidationError = jQuery('.validationError');

        // set value
        let emailValue = jQuery(value).val();

        // email format formula
        let mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

        // check email format first
        if (emailValue.match(mailFormat)) {

            // if valid, hide email format error
            emailValidationError.hide('drop', {direction: 'left'}, 'fast');

            // show submit button
            this.nextButton.show('fade', 100);
            this.returnToEdit.show('fade', 100);

            // add validation attribute
            emailValidationError.attr('valid', 'true');

            // validate email double entries
            let validatedEmail = this.saveDataSet(emailValue,'');

            // check email for double entry
            if (validatedEmail.trim() === 'false') {

                // show error + translation
                emailValidationError.text(
                    JSON.parse(this.translate('emailValidation'))[0].wording
                ).show('drop', {direction: 'left'}, 'fast');

                // hide submit button
                this.nextButton.hide('fade', 100);
                this.returnToEdit.hide('fade', 100);
            } else {

                // show submit button
                this.nextButton.show('fade', 100);
                this.returnToEdit.show('fade', 100);

                emailValidationError.attr('valid', 'true');
            }// end if
        // if email format is not valid
        } else {

            // show email format error + translation
            emailValidationError.text(
                JSON.parse(this.translate('emailValidation'))[1].wording
            ).show('drop', {direction: 'left'}, 'fast');

            // hide
            this.nextButton.hide('fade', 100);
            this.returnToEdit.hide('fade', 100);
        }// end if
    }// end validateEmail()

    // method show error effect
    showError(object) {

        // add error class + shake effect
        jQuery(object).addClass('errorCode').effect('shake', 'slow');

        // reset input
        jQuery(object).val('');
    }// end showError()

    // set autofocus dynamically
    setAutoFocus(object) {

        // set focus
        setTimeout(function() {

            // action
            object.focus();
        }, 100)// end setTimeout()
    }// end setAutoFocus()

    //
    keyControls(event, trigger, input) {

        // prevent default key actions
        event.preventDefault();

        // email validation error container
        let emailValidationError = jQuery('.validationError').attr('valid');

        // sort out email input
        if (input.attr('name') === 'email') {

            // get validation true value
            emailValidationError === 'true'
                ? jQuery(trigger).click()
                : false;
        } else {

            // user Tab click on email validation
            jQuery(trigger).click();
        }// end if
    }// end keyControls()

    // set hint container html + data
    setKeyControlsHint() {

        // set hint html
        let hint = document.createElement('div');

        // set container one
        let contentChildTab = document.createElement('p');

        // set containr two
        let contentChildBackspace = document.createElement('p');

        // add text content
        let tabHint = document.createTextNode(JSON.parse(this.translate('hint'))[0].wording);

        // backspace hint
        let backspaceHint = document.createTextNode(JSON.parse(this.translate('hint'))[1].wording);

        // set hint container one
        contentChildTab.append(tabHint);

        // set hint container two
        contentChildBackspace.append(backspaceHint);

        // add container class
        hint.className = 'gameHintContainer';

        // add content to the parent container
        hint.append(contentChildTab, contentChildBackspace);

        // append hint
        formLogicSet.parentContainer.append(hint);

            // set timeOut()
            setTimeout(function () {
                    // show hind
                    jQuery(hint).show('drop', {direction: 'right'}, 'fast');
                }, 4000,
                //
                setTimeout(function () {
                    // hide hind
                    jQuery(hint).hide('drop', {direction: 'right'}, 'slow');
                }, 10000)
            )// end setTimeout()
    }// end setKeyControlsHint
    // endregion
}// end gameLogic{}

// set game logic class instance
let formLogicSet = new formLogicClass();

// call logic
formLogicSet.setForm();
