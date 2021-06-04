/**
 * Create random string
 */

function createID(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}


/**
 * Check if browser is IE 11 or worse
 */

function isBrowserIE() {
    var ua = window.navigator.userAgent; // Check the userAgent property of the window.navigator object
    var msie = ua.indexOf('MSIE '); // IE 10 or older
    var trident = ua.indexOf('Trident/'); //IE 11
    
    if (msie > 0 || trident > 0) { // If IE 11 or worse
        return true;
    }
    
    return false;
}