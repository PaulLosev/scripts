
   jQuery(function() {

        // set container.
        var navigation = $('.promoBlockTrigger');

        // set the edit modal.
        var editModal = $('.editModal');

        // set the quarter winnne modal.
        var quarterWinnerModal = $('.setQuarter');

        // set the data contaner.
        var dataContainer = $('.editModalBody');

        // set the system spinner.
        var systemSpinner = $('.actualSystemSpinner');

        // set the close button.
        var closeButton = $('.closeAllModal');

        // set return value.
        var returnValue = $('.letterDecorationModal');

        // set the go back button.
        var goBack = $('.goBack');

        // set the complete notification container.
        var notificationContainer = $('.notificationBody');

        //
        navigation.on({

            //
            click: function () {

                // set the promo block id.
                var blockId = $(this).attr('data-block-id');

                // set db variator
                var dbconnect = $(this).attr('dbconnect');

                // ajax call
                $.ajax({
                    url: '/phpScripts/setPromoBlockData.php' + dbconnect,
                    type: 'post',
                    data: {
                        promoBlockId: blockId,
                    },

                    // success function
                    success: function (setData) {

                        //
                        returnValue.attr('data-save-id', blockId);

                        // show the edit modal.
                        editModal.fadeIn(100);

                        // set block data.
                        dataContainer.html(setData);

                        // hide the go back button.
                        goBack.fadeOut(50);
                    },

                    beforeSend: function () {

                        // show the system spinner.
                        systemSpinner.fadeIn(100);
                    },

                    complete: function () {

                        // hide the system spinner.
                        systemSpinner.hide();
                    }
                })// end ajax
            }// end click()
        });

        // close all modals
        //
        closeButton.on({

            //
            click: function() {

                // hide the edit modal.
                editModal.hide();

                // hide the quarter winner modal.
                quarterWinnerModal.delay( 300 ).fadeOut(100);

                // show go back button.
                goBack.fadeIn('fast');
            }
        })// end on()
        // endregion close all modals

       /* add random squares method */

       // set top row container.
       var topRow = $('.randomValueInputtop');

       // set left row container.
       var leftRow = $('.randomValueInputleft');

       // set the save button.
       var saveButton = $('.submitData');

       // set the memory arrays and vars.
       var memoryArrayTop = [];
       var memoryArrayLeft = [];
       var totalAllItems = 0;
       // set the array lenght
       var allItems = 20;

       // set the top row anchor.
       var errorContinerTop = $('.errorContainer');

       // set the reset button.
       var resetBtton = $('.resetButtonTop').hide();
       var resetBttonLeft = $('.resetButton').hide();

       // set confirmation module
       var confirmMod = $('.randomNubersSetLockContainer');

       // set confirmation mod ok button
       var confModOk = $('.agreedButton');

       //
       saveButton.on({

           //
           click: function() {

               // reset data.
               memoryArrayTop = [];
               memoryArrayLeft = [];

               // go thru loop to assign the values.
               topRow.each(function() {

                   // set top values.
                   var inputValue = $(this).val();

                   // if no value.
                   if (inputValue === '') {

                       // show the error
                       $(this).addClass('error');

                       // show the validation error.
                       errorContinerTop.text('All requared fields').show();

                       // if an item has a value.
                   } else {

                       // remover error class.
                       $(this).removeClass('error');

                       // push the data into the array.
                       memoryArrayTop.push(inputValue);
                   }// end if
               })// end each()

               // go thru loop to assign the values.
               leftRow.each(function() {

                   // set top values.
                   var inputValue = $(this).val();

                   // if no value.
                   if (inputValue === '') {

                       // show the error
                       $(this).addClass('error');

                       // show the validation error.
                       errorContinerTop.text('All requared fields').show();

                       // if an item has a value.
                   } else {

                       // remover error class.
                       $(this).removeClass('error');

                       // push the data into the array.
                       memoryArrayLeft.push(inputValue);
                   }// end if
               })// end each()

               // set the total array lenght.
               var arraylengthTop = memoryArrayTop.length;
               var arraylengthLeft = memoryArrayLeft.length;

               // calculate the all totl.
               totalAllItems = arraylengthTop + arraylengthLeft;

               // track some data.
               console.log('total all ' + allItems + ' total in TOP ' + arraylengthTop + ' total in LEFT ' + arraylengthLeft);

               // if total in array is 20
               if (totalAllItems === allItems) {

                   // show the validation error.
                   errorContinerTop.hide();

                   // set the saved as true
                   var savedTrue = $(this).attr('data-save');

                   // set db variator
                   var dbconnect = $(this).attr('dbconnect');

                   //
                   $.ajax({
                       url: '/phpScripts/saveTopNumbers.php' + dbconnect,
                       type: 'post',
                       data: {
                           topGrid: memoryArrayTop,
                           leftGrid: memoryArrayLeft,
                           status: savedTrue,
                           db: dbconnect,
                       },

                       success: function(sendData) {

                           // track data return
                           console.log(sendData);

                           // check for true value
                           if (sendData.trim() === 'saved') {

                               // scroll to 800 line.
                               $('html, body').animate({ scrollTop: 0 }, 'slow', function() {

                                   // set the notification body.
                                   notificationContainer.text('SAVED').addClass('greenConfirm').show(0, function() {

                                       // show the confirmation mod
                                       confirmMod.delay(400).show('puff', 300);

                                       // hide reset buttons.
                                       resetBtton.fadeOut('slow');
                                       resetBttonLeft.fadeOut('slow');

                                       // set the timeout for the confiration.
                                       setTimeout(function () {

                                           // hide the confirmation.
                                           notificationContainer.fadeOut('slow');

                                           // set the saved class.
                                           topRow.addClass('locked').fadeIn('slow');
                                           leftRow.addClass('locked').fadeIn('slow');
                                       }, 4000);
                                   });
                               });
                           }// end if()
                       }// end success()
                   })// end Ajax()

                   // track the values.
                   console.log(memoryArrayTop);
                   console.log(memoryArrayLeft);
               }// end if
           }// end click()
       })// end on()

       //
       confModOk.on({

           //
           click: function() {

               // close the confimr mod.
               confirmMod.hide('puff', 300, function() {

                   // refresh the page.
                   location.reload();
               });
           }// end click()
       })// end On()

       //
       resetBtton.on({

           //
           click: function() {

               // reste all values.
               topRow.val('').removeClass('error');

               // hide the validation error.
               errorContinerTop.hide();

               resetBtton.hide();
           }// end click()
       })// end on()

       resetBttonLeft.on({
           //
           click: function() {

               // reste all values.
               leftRow.val('').removeClass('error');

               // hide the validation error.
               errorContinerTop.hide();

               //
               resetBttonLeft.hide();
           }// end click()

       })// end on()

       //
       topRow.on({

           //
           click: function() {

               // show the reset button.
               resetBtton.fadeIn('fast');
           }// end click()
       });

       //
       leftRow.on({

           //
           click: function() {

               // show the reset button.
               resetBttonLeft.fadeIn('fast');
           }// end click()
       });

       /* add random squares method */
       /* set quarter winner method */

       // set the container.
       var theContaner = $('.setWinnerContainer');

       // set each quarter container trigger.
       var onQuarter = theContaner.children('.setTheWinner');

       // set quarter winner modal body.
       var quarterWinner = $('.setQuarter');

       // set the id cotainer on the modal.
       var modalIdContainer = $('input[name=actualContainerId]');

       // module body.
       var setQuarterModalBody = $('.setQuarterModalBody');

       //
       onQuarter.on({

           //
           click: function() {

               // set the quarter id.
               var quarterId = $(this).attr('data-quarter');

               // show the module.
               quarterWinner.delay(700).fadeIn(100);

               // reset id eah time after click.
               modalIdContainer.val(quarterId);

               // set db variator
               var dbconnect = $(this).attr('dbconnect');

               //
               $.ajax({
                   url: '/phpScripts/setQuarterBocks.php' + dbconnect,
                   type: 'post',
                   data: {
                       id: quarterId,
                       db: dbconnect,
                   },

                   success: function(dataTrack) {

                       // set the return containers.
                       setQuarterModalBody.html(dataTrack);
                   },

                   beforeSend: function() {

                       // show the system spinner.
                       systemSpinner.fadeIn(100);
                   },

                   complete: function() {

                       // hide the system spinner.
                       systemSpinner.fadeOut(300);
                   }

               })// end ajax()

               // track some data.
               console.log(quarterId + ' the current quarter id');
           }// end click()
       })// end on()

       /* set quarter winner method */

       // efx
       // set the efx container one.
       var efvContainerOne = $('.totalCircle');

       setInterval(function() {

           efvContainerOne.css({transform: 'scale(1.2)', transition: '.3s'});
           setTimeout(function() {
               efvContainerOne.css({transform: 'scale(1)'});
           }, 500);
       }, 5000);


       // set the breadcrum container.
       var whereAmI = $('.whereAmI');

       setInterval(function(e) {
           whereAmI.shineText({
               speed: 40,
           }).css({transform: 'rotate(-15deg)', transition: '.3s'});

           setTimeout(function() {
               whereAmI.css({transform: 'rotate(-5deg)'});
           }, 100);
       }, 8000);

   });
   // end jQuery region

   /**
    * Method sets and send the data to the php script.
    * Updated an existing promo block.
    */
   function saveBlock() {

       // set the edit modal.
       var editModal = $('.editModal');

       // set the system spinner.
       var systemSpinner = $('.actualSystemSpinner');

       // set the CK returning html.
       var value = CKEDITOR.instances['promoBlock'].getData();

       // set the block id.
       var blockId = $('.letterDecorationModal').attr('data-save-id');

       // set the complete notification container.
       var notificationContainer = $('.notificationBody');

       // set the uri input.
       var uriInput = $('input[name=promoLink]').val();

       // set the go back button.
       var goBack = $('.goBack');

       // set db variator
       var dbconnect = $('.promoBlock').attr('dbconnect');

       //
       $.ajax({
           url: '/phpScripts/savePromoBlock.php' + dbconnect,
          type: 'post',
          data: {
               block: blockId,
                data: value,
            blockUri: uriInput,
          },

          //
          success: function (returnData) {

              // set the error check.
              var errorCheck = returnData;

              // track the erorr status.
              console.log(returnData);

              // if no error.
              if (errorCheck !== 'error') {

                  // hode the modal.
                  editModal.fadeOut(100);

                  // show the confirmation.
                  notificationContainer.text('SAVED').addClass('greenConfirm').show();

                  // show go back button.
                  goBack.fadeIn('fast');

                  // set the timeout for the confiration.
                  setTimeout(function () {

                      // hide the confirmation.
                      notificationContainer.fadeOut(100);
                  }, 2000);

              // if error.
              } else {

                  // show the confirmation.
                  notificationContainer.text('ERROR').addClass('redConfirm').show();
              }// end if
          },

          //
          beforeSend: function() {

              // show the system spinner.
              systemSpinner.fadeIn(100);
          },

          //
          complete: function() {

              // hide the system spinner.
              systemSpinner.hide();
          }// end success()
       })// end ajax()
   }// end saveBlock()

   //
   jQuery(function($) {

       // set the links
       var link = $('a');

       // disable link usage
       link.each(function() {

           // if no attr set
           if ($(this).attr('href') === '') {

               /// remove attribute
               $(this).removeAttr('href');
           }// end if()
       })// end each()
   })// end jQuery()