    /**
     * class groupLogicFunctionality
     */
    class groupLogicFunctionality {
        // region class methods
        // class constructor
        constructor() {
            // get group container parent
            this.groupContainerParent = $('.quetionsGroupCategories');
            // find add group button
            this.addGroup = this.groupContainerParent.find('.addNewGroupToDropdown button');
            // find all group inputs
            this.groups = this.groupContainerParent.find('.questionBody');
        }// end constructor()
        //
        setGroupLogic(data) {
            console.log(this.addGroup);
            console.log(this.groups);
        }// end setGroupLogic()
        // endregion
    }// end groupLogicFunctionality{}
    // set the class instance
    let groups = new groupLogicFunctionality();
    // call logic
    groups.setGroupLogic('connect');