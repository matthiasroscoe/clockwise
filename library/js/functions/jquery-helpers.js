/**
 * Adds passive event listening to touch scrolling events
 * Lighthouse link for more info: https://developers.google.com/web/updates/2016/06/passive-event-listeners
 */

function jQueryInit() {
    // Passive event listeners
    jQuery.event.special.touchstart = {
        setup: function( _, ns, handle ) {
            this.addEventListener("touchstart", handle, { passive: !ns.includes("noPreventDefault") });
        }
    };
    jQuery.event.special.touchmove = {
        setup: function( _, ns, handle ) {
            this.addEventListener("touchmove", handle, { passive: !ns.includes("noPreventDefault") });
        }
    };
}