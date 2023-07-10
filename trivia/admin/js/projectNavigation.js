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
            // navigation bulder scrip file path
            this.navigationBuilder = '/trivia/admin/ajaxCall/buildNavigation.php';
        }// end constructor()
        // start navigation build
        // also workss as a reset mehod
        buildNavModule() {
            // default menu option
            // questions menu potion
            // call default navigation
            this.buildDefaultNavigation('default');
            // call navigation functionality
            this.navigationFunctionality();
        }// end buildNavModule()
        // method sets navigational functioning
        navigationFunctionality() {
            // get all navigation items
            let menuData = this.navigationReturn.find('li');
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
                }// end switch
            })// end each()
            // get method name
        }// end navigationFunctionality()
        navigationMethodVariator(that, category, object) {
            // set action
            that.on({
                click: function () {
                    // build defaul navigation
                    buildNavigation.buildDefaultNavigation(category);
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
