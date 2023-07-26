    /**
     * class groupLogicFunctionality
     */
    class groupLogicFunctionality {
        // region class methods
        // class constructor
        constructor() {
            // get group container parent
            this.groupContainerParent = $('.quetionsGroupCategories');
            // group return container
            this.groupBody = this.groupContainerParent.find('.groupsContainerBody');
            // find add group button
            this.addGroup = this.groupContainerParent.find('.addNewGroupToDropdown button');
            // find all group inputs
            this.groups = this.groupContainerParent.find('.questionBody');
        }// end constructor()
        //
        setGroupLogic(data) {
            // add new group functionality
            this.addGroupModule();
            // run thru all groups
            this.groups.each((num, object) => {
                // get group id
                let qid = $(object).attr('qid');
                // get group current value
                let currentValue = $(object).attr('currentValue');
                // get new value
                let actionOnValue = $(object).find('input[type=text]');
                // set update & add actions
                actionOnValue.on({
                    keyup: function() {
                        console.log(this.value);
                    }// end keyup()
                })// end On()
                // get delete button
                let deleteGroupButton = $(object).find('.deleteCategoryQuestions input');
                // set delete action
                deleteGroupButton.on({
                    click: function() {
                        console.log(qid);
                    }// end click()
                })// end On()
            })// end each()
        }// end setGroupLogic()
        //
        addGroupModule() {
            // set actions
            this.addGroup.on({
                click: function() {
                    groups.groupBody.effect('fade', 'fast', () => {
                        groups.groupBody.prepend('<p>return from backend + new line in the DB</p>');
                    })// end effect()
                }// end click
            })// end On()
        }// end addGroup()
        // endregion
    }// end groupLogicFunctionality{}
    // set the class instance
    let groups = new groupLogicFunctionality();
    // call logic
    groups.setGroupLogic();
