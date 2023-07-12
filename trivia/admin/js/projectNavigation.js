    /**
     * class projectNavigation
     */
    class projectNavigation {
        // region class methods
        constructor() {
            // parent container
            this.parentContainer = $('#projectReturnContainer');
            // get navigation return conatiner
            this.navigationReturn = this.parentContainer.find('.dynamicMenuContainer');
            // get main return container
            this.mainReturn = this.parentContainer.find('.returnContainer');
            // return container headlineer
            this.mainReturnHeadline = this.parentContainer.find('.returnContainerHeadline span');
            // navigation bulder scrip file path
            this.navigationBuilder = '/trivia/admin/ajaxCall/buildNavigation.php';
            // add question module call
            this.addQuestionPath = '/trivia/admin/ajaxCall/addQuestion.php'
            // edit question wording
            this.editQuestionWording = 'edit question';
        }// end constructor()
        // start navigation build
        // also workss as a reset mehod
        buildNavModule() {
            // call default navigation
            this.buildDefaultNavigation('default');
            // call defaul retunr conatiner
            this.buildContainer('dashboard');
            // call navigation functionality
            this.navigationFunctionality();
        }// end buildNavModule()
        // method sets navigational functioning
        navigationFunctionality() {
            // get all navigation items
            let menuData = this.navigationReturn.find('li');
            // set first item active
            menuData.first().addClass('navigationActive');
            // set actions
            menuData.each((num, object) => {
                // that data
                let that = $(object);
                // get category
                let category = that.attr('catalog');
                // set actions
                switch (category) {
                    case 'questions':
                        // set actions
                        this.navigationMethodVariator(that, category, object);
                        break;
                    case 'dashboard':
                    case 'users':
                    case 'settings':
                        this.defaulNavigationMethod(that, menuData, category);
                        break;
                }// end switch
            })// end each()
        }// end navigationFunctionality()
        // method sets default navigation functionality
        defaulNavigationMethod(that, menuData, category) {
            // default navigation functionality
            that.on({
                click: function() {
                    // remove active class from each item
                    $(menuData).removeClass('navigationActive');
                    // add active class to this item
                    $(that).addClass('navigationActive');
                    // call defaul retunr conatiner
                    buildNavigation.buildContainer(category, '');
                }// end click()
            })// end On()
        }// end defaulNavigationMethod()
        // methods popuplates menu with data by category value
        navigationMethodVariator(that, category, object) {
            // set action
            that.on({
                click: function () {
                    // build defaul navigation
                    buildNavigation.buildDefaultNavigation(category);
                    // call defaul retunr conatiner
                    buildNavigation.buildContainer(category, '');
                    // get the back button
                    let back = $(buildNavigation.navigationReturn).find('#backButton');
                    // call default navigation
                    back.on({
                        click: function() {
                            // call default navigation
                            buildNavigation.buildNavModule();
                        }// end click()
                    })// end on
                }// end click()
            })// end on()
        }// end navigationMethodVariator()
        // method build default navigation
        buildDefaultNavigation(option) {
            // set method namr
            let category = new FormData();
            // add method
            category.append('method', option);
            // build defaul navigation
            return this.navigationReturn.html(this.ajaxCall(category, this.navigationBuilder));
        }// end buildDefaultNavigation()
        // method build retunr data container
        /**
         * takes: option as a headline
         * takes: data set as data
         * @param option string
         * @param data array
         */
        buildContainer(option, data) {
            console.log('%c' + option + ' :tracing build container method', 'color: pink');
            // console.log(data);
            // set wraper
            let wraper = document.createElement('div');
            // set parent container
            let topContainer = document.createElement('div');
            topContainer.className = 'returnContainerHeadline';
            // set headline
            let headline = document.createElement('span');
            topContainer.append(headline);
            // text node
            let textNode = document.createTextNode(option);
            headline.append(textNode);
            // return container
            let returnDataContainer = document.createElement('div');
            returnDataContainer.className = 'returnDataContainer';
            $(returnDataContainer).html(data);
            // build container
            wraper.append(topContainer, returnDataContainer);
            // build module
            this.mainReturn.html(wraper).effect('fade', 'fast');
        }// end buildContainer()
        // method calls backend for data by eid
        ajaxCall(data, path) {
            // get data by array values
            return $.ajax({
                url: path,
                type: 'post',
                async: false,
                contentType: false,
                processData: false,
                data: data}).responseText;
        }// end ajaxCall()
        // endregion
    }// end projectNavigation{}
    // set the class instance
    let buildNavigation = new projectNavigation();
    // build navigation
    buildNavigation.buildNavModule()
