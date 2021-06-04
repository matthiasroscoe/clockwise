/**
 * Filters the location index module when clicking the pill buttons
 */

function locationIndexFilter() {
    if ($('.js-loc-index-accordion').length) {
        $('.js-loc-index-accordion').on('click', function(e) {
            e.preventDefault();
    
            const termID = $(this).data('term-id');
    
            $(this).toggleClass('is-active');
            $(this).next().toggleClass('is-active');
        })
    }

    if ($('.js-loc-index-pill').length) {
        $('.js-loc-index-pill').on('click', function(e) {
            e.preventDefault();
            
            const termID = $(this).data('term-id');
    
            // If accordion clicked, close accordion
            if (! $(this).hasClass('is-active')) {
                // Remove active states
                const activeElems = $('.js-loc-index-pill, .js-loc-index-accordion, .js-loc-index-posts');
                activeElems.removeClass('is-active is-first');
                
                // Add active states
                const newActiveElems = $(`.js-loc-index-pill[data-term-id="${termID}"], .js-loc-index-accordion[data-term-id="${termID}"], .js-loc-index-posts[data-term-id="${termID}"]`);
                newActiveElems.addClass('is-active');
            }
        })
    }
}
