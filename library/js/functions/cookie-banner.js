/**
 * Cookie Banner
 */

function initCookieBanner() {
    // If user hasn't accepted cookie, activate banner
	if (getCookie('cookies_accepted') != 'true') {
		$('.c-cookie-banner').addClass('is-active');
    }
    
    // On accept cookies, set cookie and remove banner
	$('.js-cookie-banner-close').on('click', function(e) {
		e.preventDefault();
		$('.c-cookie-banner').removeClass('is-active');
		setCookie('cookies_accepted', 'true', 999);
	})
}


// Cookie helpers
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}