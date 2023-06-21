
// remove cookie class
class cookieUnset {

    // remove user cookie
    unsetCookie() {

        // remove user ID
        jQuery.removeCookie('EID') === true
            ? location.reload()
            : '';
    }// end unsetCookie()
}// end cookieUnset{}

// set the class instance
let unsetCookie = new cookieUnset();

// call unset method
unsetCookie.unsetCookie();
