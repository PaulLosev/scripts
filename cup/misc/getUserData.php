
<style>
    .gameFormContainer {
        position: relative;
        width: 100%;
        height: auto;
        margin: 3vw auto;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .gameFormBody {
        position: relative;
        width: 45%;
        height: auto;
    }

    #formInput {
        position: relative;
        width: 100%;
        padding: .5vw;
        margin: .3vw 0;
        border: 1px solid rgba(0,0,0,.1);
    }

    .gameFormControlsContainer {
        position: relative;
        width: 100%;
        height: auto;
        margin: 1vw 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .gameFormDotsContainer {
        display: flex;
        justify-content: space-around;
        align-items: center;
        position: relative;
        width: auto;
        height: auto;
        margin: .5vw .5vw;
    }

    .formItemsListing {
        position: relative;
        width: 1.6vw;
        height: 1.6vw;
        padding: .4vw;
        margin: 0 .3vw;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
    }

    .formItemsListing p {
        background: rgba(0,0,0,.1);
        width: 1.5vw;
        height: 1.5vw;
        border-radius: 50%;
        margin: 0;
    }

    .validated {
        background: #1A5276!important;
    }

    .innerActive {
        background: #239B56!important;
    }

    #formSubmit {

    }

    .errorCode {
        border: 1px solid darkred!important;
    }

</style>

<!-- ./ jQuery servers -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- ./ jQuery servers -->

<!-- ./ form logic -->
<div class="gameFormContainer">
    <div class="gameFormBody" repEmail="<?php echo $repEmail; ?>">

        <!--./ inputs return -->
    </div>

    <div class="gameFormControlsContainer">
        <div class="gameFormDotsContainer">

            <!-- ./ dots return -->
        </div>
        <div class="gameFormSubmitButtonContainer">
            <div id="formSubmit"></div>
        </div>
    </div>
</div>
<!-- ./ form logic -->

<!-- ./ game logic class connect -->
<script src="/cup/js/formLogic.js"></script>
<!-- ./ game logic class connect -->

