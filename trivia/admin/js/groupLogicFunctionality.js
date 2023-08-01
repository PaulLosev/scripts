    /**
     * class groupLogicFunctionality
     */
    class groupLogicFunctionality extends projectNavigation {
        // region class methods
        // class constructor
        constructor() {
            super();
            // get group container parent
            this.groupContainerParent = $('.quetionsGroupCategories');
            // group return container
            this.groupBody = this.groupContainerParent.find('.groupsContainerBody');
            // find add group button
            this.addGroup = this.groupContainerParent.find('.addNewGroupToDropdown button');
            // find all group inputs
            this.groups = this.groupContainerParent.find('.questionBody');
            // set path to add group container
            this.addGroupContainer = '/trivia/admin/ajaxCall/addGroup.php';
            // set path to delete group
            this.deleteGruopPath = '/trivia/admin/ajaxCall/deleteGroup.php';
            // set update group pather
            this.updateGroupPath = '/trivia/admin/ajaxCall/updateGroup.php';
            // set category
            this.transmitCategory = 'add group';
            // error code empty
            this.errorCodeEmpty = '*cannot be empty';
            // set delete confrim
            this.deleteConfirm = 'Deleting the group will result in related to the group questions false. ' +
                'You\'ll need to update related questions with a new group. Instead, update the group name. ' +
                'It will be updated to all the group related questions automatically. This action cannot be undone. You want to continue?';
            // set questions category
            this.categoryOption = this.groupContainerParent.attr('category');
        }// end constructor()
        // set add / delete / edit group logic
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
                // get error container
                let errorContainer = $(object).find('.errorCode');
                // validate input
                errorContainer.text(actionOnValue.val() === '' ? groups.errorCodeEmpty : '');
                // set update & add actions
                actionOnValue.on({
                    keyup: function() {
                        console.log('line 49 of groupLogicFunctionality class');
                        errorContainer.text(this.value === '' ? groups.errorCodeEmpty : '');
                        // set dataSet
                        let updateData = new FormData();
                        updateData.append('value', this.value);
                        updateData.append('qid', qid);
                        // call update method
                        let updateConfirm = groups.ajaxCall(updateData, groups.updateGroupPath);
                        console.log(updateConfirm);
                    }// end keyup()
                })// end On()
                // get delete button
                let deleteGroupButton = $(object).find('.deleteCategoryQuestions input');
                // set delete action
                deleteGroupButton.on({
                    click: function() {
                        if (confirm(groups.deleteConfirm) === true) {
                            // refresh the module
                            let dataSet = new FormData();
                            dataSet.append('qid', qid);
                            // delete group from the dd table
                            let deleteGroup = groups.ajaxCall(dataSet, groups.deleteGruopPath);
                            // returned
                            // refresh container
                            let flushContainer = new FormData();
                            flushContainer.append('category', deleteGroup);
                            let returnedData = groups.ajaxCall(flushContainer, groups.containerBuilder);
                            // call defaul retunr conatiner
                            groups.buildContainer(groups.categoryOption, returnedData);
                            // call confirm
                            groups.actionConfirm('deleted');
                        }// end cofirm
                    }// end click()
                })// end On()
            })// end each()
        }// end setGroupLogic()
        // method adds new group name row
        addGroupModule() {
            // set actions
            this.addGroup.on({
                click: function() {
                    console.log('addGroupModule line 49 of groupLogicFunctionality class');
                    // return new container
                    // save the container
                    groups.ajaxCall('', groups.addGroupContainer);
                    // refresh the module
                    let dataSet = new FormData();
                    dataSet.append('category', groups.categoryOption);
                    // returned
                    let returnedData = groups.ajaxCall(dataSet, groups.containerBuilder);
                    // call defaul retunr conatiner
                    groups.buildContainer(groups.categoryOption, returnedData);
                    // call confirm
                    groups.actionConfirm('added');
                }// end click
            })// end On()
        }// end addGroup()
        // endregion
    }// end groupLogicFunctionality{}
    // set the class instance
    let groups = new groupLogicFunctionality();
    // call logic
    groups.setGroupLogic();
