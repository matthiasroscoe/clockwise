/**
 * Misc fixes for IE11
 */

ieFixes();
function ieFixes() {
    if (isBrowserIE()) {
        $('body').addClass('browser-is-ie');
    
        // Disable regions module on IE
        $('section.regions').remove();
    }
}